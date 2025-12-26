<?php
declare(strict_types=1);

/**
 * Sitemap Generator Helper
 * Scans the root directory for public PHP pages.
 */

function get_site_pages(): array
{
    $pages = [];
    $exclude = ['xml-sitemap.php', 'sitemap.xml.php']; // Don't list the sitemap files themselves

    // Scan for all .php files in the root
    $files = glob(__DIR__ . '/../' . '*.php');

    foreach ($files as $file) {
        $filename = basename($file);
        
        // Skip hidden files, includes, or known system files if necessary
        // In this flat CMS, we assume all root .php files are pages unless excluded
        if (in_array($filename, $exclude) || str_starts_with($filename, '.')) {
            continue;
        }

        // Basic "Last Modified" time from file system
        $lastMod = filemtime($file);
        
        // Pretty Title (Capitalized filename without extension)
        $title = ucfirst(str_replace(['.php', '-'], ['', ' '], $filename));

        $pages[] = [
            'file' => $filename,
            'url' => htmlspecialchars($filename), // Relative URL
            'lastmod' => date('Y-m-d', $lastMod),
            'title' => $title
        ];
    }
    
    return $pages;
}
?>
