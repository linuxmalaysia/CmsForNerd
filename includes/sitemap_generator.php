<?php

/**
 * ==========================================================================
 * FILE: includes/sitemap_generator.php
 * ROLE: Sitemap Generator Helper (Educational Edition)
 * ==========================================================================
 * TRAINING NOTE: This script uses "Pair Logic." It scans the 'contents' 
 * folder for body fragments and verifies a matching .php file exists.
 */

declare(strict_types=1);

/**
 * @return array<int, array{file: string, url: string, lastmod: string, title: string}>
 */
function get_detailed_site_pages(): array
{
    $pages = [];

    // [PATH DISCOVERY] Get the absolute path to the project root
    // We use realpath to resolve any strange Windows/Herd path issues
    $rootDir = realpath(__DIR__ . '/../');
    $fragmentDir = $rootDir . DIRECTORY_SEPARATOR . 'contents' . DIRECTORY_SEPARATOR;

    // Safety check: If directory doesn't exist, stop here
    if (!$rootDir || !is_dir($fragmentDir)) {
        return [];
    }

    // [FILE DISCOVERY] Find all body fragments
    $fragments = glob($fragmentDir . '*-body.inc');

    if ($fragments === false || empty($fragments)) {
        return [];
    }

    foreach ($fragments as $file) {
        // Extract the slug (e.g., 'lab-manual')
        $slug = str_replace('-body.inc', '', basename($file));

        // [SECURITY] Skip system files
        $exclude = ['index', 'sitemap', 'empty', '403', '404', 'header', 'footer', 'sitemap-page'];
        if (in_array($slug, $exclude, true)) {
            continue;
        }

        // Check if the Master Controller exists
        $masterFile = $rootDir . DIRECTORY_SEPARATOR . $slug . '.php';

        if (file_exists($masterFile)) {
            // Get latest modification date
            $mTime = max((int)filemtime($masterFile), (int)filemtime($file));
            
            $pages[] = [
                'file'    => "$slug.php",
                'url'     => "$slug.php",
                'lastmod' => date('Y-m-d', $mTime),
                'title'   => ucfirst(str_replace(['-', '_'], ' ', $slug))
            ];
        }
    }

    return $pages;
}
