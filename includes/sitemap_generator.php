<?php

declare(strict_types=1);

/**
 * Sitemap Generator Helper
 * * Scans the root directory for public PHP pages and generates metadata.
 * [LAB v3.4] Updated with strict return type shapes and defensive
 * handling for system functions (glob, filemtime).
 */

/**
 * @return array<int, array{file: string, url: string, lastmod: string, title: string}>
 */
function get_site_pages(): array
{
    /** @var array<int, array{file: string, url: string, lastmod: string, title: string}> $pages */
    $pages = [];
    $fragmentDir = __DIR__ . '/../contents/';
    
    // [SECURITY] Verification of directory existence
    if (!is_dir($fragmentDir)) {
        return [];
    }

    /**
     * [ARCHITECTURE] PAIR LOGIC SCAN
     * Instead of scanning for every PHP file, we scan the 'contents/' directory
     * for Slave Fragments and verify their Master Controllers (.php) exist.
     */
    $fragments = glob($fragmentDir . '*-body.inc');
    
    if ($fragments === false) {
        return [];
    }

    foreach ($fragments as $file) {
        $slug = str_replace('-body.inc', '', basename($file));

        /**
         * [SECURITY] RULE #8 COMPLIANCE
         * Skip internal system fragments and error pages.
         */
        $exclude = ['index', 'sitemap', 'empty', '403', '404', 'header', 'footer'];
        if (in_array($slug, $exclude, true)) {
            continue;
        }

        $masterFile = __DIR__ . '/../' . $slug . '.php';

        if (file_exists($masterFile)) {
            $mTime = max(filemtime($masterFile), filemtime($file));
            $lastModTimestamp = ($mTime === false) ? time() : $mTime;

            // Pretty Title (Capitalized filename, replacing dashes with spaces)
            $title = ucfirst(str_replace('-', ' ', $slug));

            $pages[] = [
                'file'    => "$slug.php",
                'url'     => htmlspecialchars("$slug.php", ENT_QUOTES, 'UTF-8'),
                'lastmod' => date('Y-m-d', $lastModTimestamp),
                'title'   => $title
            ];
        }
    }

    return $pages;
}
