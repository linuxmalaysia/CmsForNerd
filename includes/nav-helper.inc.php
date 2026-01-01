<?php

declare(strict_types=1);

/**
 * CMSForNerd Auto-Sitemap Generator
 * Scans root for public pages and excludes system files.
 */

if (!function_exists('get_site_pages')) {
    /**
     * @return array<string, string> Key is the filename, Value is the Pretty Label.
     */
    function get_site_pages(): array
    {
        $pages = [];
        $exclude = [
            'template.php',
            'index.php',
            'audit-semantics.php',
            'sitemap-page.php',
            'sitemap.php'
        ];

        // [SECURITY] Scan the root directory. scandir() returns false on failure.
        $files = scandir(__DIR__ . '/../');

        // [LAB v3.4] Level 8 check: Ensure $files is an array before processing.
        if (!is_array($files)) {
            return [];
        }

        foreach ($files as $file) {
            // Use the corrected constant: PATHINFO_EXTENSION
            if (pathinfo($file, PATHINFO_EXTENSION) === 'php' && !in_array($file, $exclude, true)) {
                $name = pathinfo($file, PATHINFO_FILENAME);

                // Convert filename to a pretty label (e.g., 'about-us' to 'About Us')
                $pages[$file] = ucfirst(str_replace(['-', '_'], ' ', $name));
            }
        }
        return $pages;
    }
}