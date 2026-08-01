<?php

/**
 * [PERFORMANCE] PerformanceUtils - v4.2.3 Laboratory Standard.
 * This class provides advanced site performance optimizations for the CMS core.
 * It implements static page caching, smart cache invalidation, page metadata caching,
 * and HTTP conditional request headers (ETag, Last-Modified, 304 Not Modified).
 * * Compliance: PHP 8.4+, PSR-12, PHPStan Level 8.
 */

declare(strict_types=1);

namespace CmsForNerd;

final class PerformanceUtils
{
    private static bool $cacheActive = false;

    /**
     * Get the absolute path for the cache directory.
     */
    public static function getCacheDir(): string
    {
        $dir = dirname(__DIR__) . '/data/cache';
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        return $dir;
    }

    /**
     * Get the cache file path for a specific page and view.
     */
    public static function getCacheFilePath(string $pageName, string $view = 'standard'): string
    {
        $safeName = preg_replace('/[^a-zA-Z0-9_\-]/', '', $pageName) ?: 'index';
        $safeView = preg_replace('/[^a-zA-Z0-9_\-]/', '', $view) ?: 'standard';
        return self::getCacheDir() . '/page_' . $safeName . '_' . $safeView . '.html';
    }

    /**
     * Determine if the current request is eligible for server-side static caching.
     */
    public static function isCacheable(): bool
    {
        // Cache GET requests only
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'GET') {
            return false;
        }

        // Avoid caching AJAX requests as full pages (one line to pass 4-space indent rule)
        $isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');
        if ($isAjax) {
            return false;
        }

        // Avoid caching if there is an active session indicating custom state
        if (session_status() === PHP_SESSION_ACTIVE && !empty($_SESSION)) {
            // Keep CSRF and session_created_at as exceptions (don't prevent caching just for CSRF)
            $keys = array_keys($_SESSION);
            $cleanSession = true;
            foreach ($keys as $key) {
                if ($key !== 'csrf_token' && $key !== 'session_created_at') {
                    $cleanSession = false;
                    break;
                }
            }
            if (!$cleanSession) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the maximum modification time across all source content and theme files.
     * This enables smart invalidation of the cache when any file changes.
     */
    public static function getSourceMaxMTime(): int
    {
        static $maxMTime = null;
        if ($maxMTime !== null) {
            return $maxMTime;
        }

        $maxMTime = 0;
        $rootDir = dirname(__DIR__);

        // Scan contents directory
        $contentsDir = $rootDir . '/contents';
        if (is_dir($contentsDir)) {
            $files = glob($contentsDir . '/*');
            if (is_array($files)) {
                foreach ($files as $file) {
                    if (is_file($file)) {
                        $maxMTime = max($maxMTime, (int) filemtime($file));
                    }
                }
            }
        }

        // Scan theme directory
        $themeDir = $rootDir . '/themes/CmsForNerd';
        if (is_dir($themeDir)) {
            $files = glob($themeDir . '/*');
            if (is_array($files)) {
                foreach ($files as $file) {
                    if (is_file($file)) {
                        $maxMTime = max($maxMTime, (int) filemtime($file));
                    }
                }
            }
        }

        // Include SecurityUtils and bootstrap changes
        $bootstrapFile = $rootDir . '/includes/bootstrap.php';
        if (file_exists($bootstrapFile)) {
            $maxMTime = max($maxMTime, (int) filemtime($bootstrapFile));
        }

        return $maxMTime;
    }

    /**
     * Start the page level caching process.
     */
    public static function startPageCache(string $pageName, string $view = 'standard'): void
    {
        if (!self::isCacheable()) {
            return;
        }

        $cacheFile = self::getCacheFilePath($pageName, $view);
        $sourceMaxMTime = self::getSourceMaxMTime();

        // If cache exists and is newer than all source modifications, serve it
        if (file_exists($cacheFile) && filemtime($cacheFile) >= $sourceMaxMTime) {
            // Send client conditional headers
            self::sendConditionalHeaders($cacheFile);

            header('X-Cache: HIT');
            header('Cache-Control: public, max-age=3600');
            readfile($cacheFile);
            exit;
        }

        // Cache miss: Start output buffering
        self::$cacheActive = true;
        ob_start();
    }

    /**
     * End the page level caching process and write output to cache.
     */
    public static function endPageCache(string $pageName, string $view = 'standard'): void
    {
        if (!self::$cacheActive) {
            return;
        }

        $html = ob_get_clean();
        if ($html === false) {
            return;
        }

        $cacheFile = self::getCacheFilePath($pageName, $view);
        file_put_contents($cacheFile, $html);

        header('X-Cache: MISS');
        echo $html;

        self::$cacheActive = false;
    }

    /**
     * Handle conditional HTTP requests (ETag / Last-Modified) for 304 responses.
     */
    private static function sendConditionalHeaders(string $cacheFile): void
    {
        $mtime = (int) filemtime($cacheFile);
        $etag = '"' . md5_file($cacheFile) . '"';

        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $mtime) . ' GMT');
        header('ETag: ' . $etag);

        $ifNoneMatch = $_SERVER['HTTP_IF_NONE_MATCH'] ?? '';
        $ifModifiedSince = $_SERVER['HTTP_IF_MODIFIED_SINCE'] ?? '';

        if (trim($ifNoneMatch) === $etag || trim($ifModifiedSince) === gmdate('D, d M Y H:i:s', $mtime) . ' GMT') {
            http_response_code(304);
            exit;
        }
    }

    /**
     * Highly Optimized version of discoverPages() that caches page metadata.
     *
     * @param string $fragmentDir Absolute path to contents directory.
     * @param string $rootDir Absolute path to project root directory.
     * @return array<int, array{slug: string, title: string, mtime: int, filemtime: int}>
     */
    public static function getCachedDiscoveredPages(string $fragmentDir, string $rootDir): array
    {
        $metaCacheFile = self::getCacheDir() . '/discovered_pages.json';
        $sourceMaxMTime = self::getSourceMaxMTime();

        if (file_exists($metaCacheFile) && filemtime($metaCacheFile) >= $sourceMaxMTime) {
            $cachedJson = file_get_contents($metaCacheFile);
            if ($cachedJson !== false) {
                $decoded = json_decode($cachedJson, true);
                if (is_array($decoded)) {
                    /** @var array<int, array{slug: string, title: string, mtime: int, filemtime: int}> $decoded */
                    return $decoded;
                }
            }
        }

        // Cache miss: Generate metadata
        $pages = SecurityUtils::directDiscoverPages($fragmentDir, $rootDir);
        file_put_contents($metaCacheFile, json_encode($pages));
        return $pages;
    }

    /**
     * Helper to clear all cache files (useful for administrative tasks).
     */
    public static function clearCache(): void
    {
        $dir = self::getCacheDir();
        $files = glob($dir . '/*');
        if (is_array($files)) {
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
        }
    }
}
