<?php

/**
 * [SECURITY] SecurityUtils - v3.5 Laboratory Standard.
 * * This class provides defensive programming utilities to protect the CMS core.
 * It combines path validation, XSS prevention, and CSP nonce generation.
 * * Compliance: PHP 8.4+, PSR-12, PHPStan Level 8.
 */

declare(strict_types=1);

namespace CmsForNerd;

final class SecurityUtils
{
    /**
     * [SECURITY] isValidPageName() prevents "Directory Traversal" attacks.
     * All requested page names MUST be validated before use in file paths.
     * * @param string $page The raw page name from QUERY_STRING.
     * @return bool Returns true if the name contains only allowed characters.
     */
    public static function isValidPageName(string $page): bool
    {
        // [PHP 8.4] Optimized regex for alphanumeric, dashes, and underscores.
        return (bool) preg_match('/^[a-zA-Z0-9_\-]+$/', $page);
    }

    /**
     * [SECURITY] Sanitize the page parameter.
     * Requirement: Remove any character that is NOT alphanumeric, dash, or underscore.
     * * [LAB v3.4] Added explicit casting to resolve PHPStan 'string|null' variance.
     * * @param string $pageName
     * @return string
     */
    public static function sanitizePageName(string $pageName): string
    {
        // preg_replace can return string, array, or null.
        // We force a string return to satisfy strict type declarations.
        $sanitized = preg_replace('/[^a-zA-Z0-9_\-]/', '', $pageName);
        return (string) ($sanitized ?? '');
    }

    /**
     * [SECURITY] Escape HTML to prevent Cross-Site Scripting (XSS).
     * ENT_QUOTES | ENT_SUBSTITUTE ensures high-level protection for UTF-8.
     * * @param string $content The raw string to be displayed.
     * @return string The escaped safe-for-browser string.
     */
    public static function escapeHtml(string $content): string
    {
        return htmlspecialchars($content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    /**
     * [SECURITY] Get safe sanitized base URL to prevent Host Header injection / XSS.
     * @return string The safe Base URL with a trailing slash.
     */
    public static function getSafeBaseUrl(): string
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
        $host     = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $host     = preg_replace('/[^a-zA-Z0-9\-.:]/', '', $host);

        $scriptPath = $_SERVER['SCRIPT_NAME'] ?? '';
        $dirPath  = str_replace('\\', '/', dirname($scriptPath));

        return rtrim($protocol . $host . $dirPath, '/') . '/';
    }

    /**
     * [SECURITY] Scan contents directory and discover valid paired pages.
     * Centralized to prevent SonarCloud Code Duplication.
     *
     * @param string $fragmentDir Absolute path to contents directory.
     * @param string $rootDir Absolute path to project root directory.
     * @return array<int, array{slug: string, title: string, mtime: int, filemtime: int}>
     */
    public static function discoverPages(string $fragmentDir, string $rootDir): array
    {
        $pages = [];

        if (is_dir($fragmentDir)) {
            $rawFragments = glob($fragmentDir . '*-body.inc');
            $fragments = is_array($rawFragments) ? $rawFragments : [];

            foreach ($fragments as $file) {
                $slug = str_replace('-body.inc', '', basename($file));

                // Exclusion list
                $exclude = ['index', 'sitemap', 'empty', '403', '404', 'header', 'footer'];
                if (in_array($slug, $exclude, true)) {
                    continue;
                }

                $masterFile = $rootDir . '/' . $slug . '.php';

                if (file_exists($masterFile)) {
                    $mTime = max(filemtime($masterFile), filemtime($file));
                    $title = ucfirst(str_replace('-', ' ', $slug));

                    $pages[] = [
                        'slug'      => $slug,
                        'title'     => $title,
                        'mtime'     => (int) $mTime,
                        'filemtime' => (int) filemtime($file),
                    ];
                }
            }
        }

        return $pages;
    }

    /**
     * [SECURITY] Generate a Content Security Policy (CSP) Nonce.
     * MUST be used for inline scripts to comply with v3.3+ safety protocols.
     * * @return string A base64 encoded random 16-byte string.
     */
    public static function generateNonce(): string
    {
        return base64_encode(random_bytes(16));
    }

    /**
     * [SECURITY] Resolve and validate the page name from the request.
     * Prevents Path Traversal while providing a clean routing mechanism.
     *
     * @param string $defaultFallback The fallback page name if no query string is provided.
     * @param string $invalidFallback The fallback page name if the resolved page name is invalid.
     * @return string The validated and sanitized page name.
     */
    public static function resolvePageName(string $defaultFallback, string $invalidFallback = 'index'): string
    {
        $rawPage = match (true) {
            !empty($_SERVER['QUERY_STRING']) => (string) $_SERVER['QUERY_STRING'],
            default                          => $defaultFallback
        };

        $isValid = self::isValidPageName($rawPage);
        $page = $isValid ? $rawPage : $invalidFallback;

        return pathinfo($page, PATHINFO_FILENAME);
    }
}
