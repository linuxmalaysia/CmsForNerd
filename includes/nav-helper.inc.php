<?php

declare(strict_types=1);

/**
 * CMSForNerd Auto-Sitemap Generator
 * Scans root for public pages and excludes system files.
 */

if (!function_exists('get_site_pages')) {
    function get_site_pages(): array
    {
        $pages = [];
        // Added sitemap-page.php to the exclusion list
        $exclude = [
            'template.php',
            'index.php',
            'audit-semantics.php',
            'sitemap-page.php',
            'sitemap.php'
        ];

        // Scan the root directory
        $files = scandir(__DIR__ . '/../');

        foreach ($files as $file) {
            // Use the corrected constant: PATHINFO_EXTENSION
            if (pathinfo($file, PATHINFO_EXTENSION) === 'php' && !in_array($file, $exclude)) {
                $name = pathinfo($file, PATHINFO_FILENAME);

                // Convert filename to a pretty label (e.g., 'about-us' to 'About Us')
                $pages[$file] = ucfirst(str_replace(['-', '_'], ' ', $name));
            }
        }
        return $pages;
    }
}
