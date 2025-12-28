<?php
declare(strict_types=1);

/**
 * CMSForNerd Auto-Sitemap Generator
 * Scans root for public pages and excludes system files.
 */
function get_site_pages(): array {
    $pages = [];
    $exclude = ['template.php', 'index.php', 'audit-semantics.php'];

    // Scan the root directory
    $files = scandir(__DIR__ . '/../');

    foreach ($files as $file) {
        // CORRECTED CONSTANT: PATHINFO_EXTENSION
        if (pathinfo($file, PATHINFO_EXTENSION) === 'php' && !in_array($file, $exclude)) {
            $name = pathinfo($file, PATHINFO_FILENAME);
            $pages[$file] = ucfirst(str_replace(['-', '_'], ' ', $name));
        }
    }
    return $pages;
}
