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
    $exclude = ['xml-sitemap.php', 'sitemap.xml.php', 'index.php'];

    // Scan for all .php files in the root directory
    $files = glob(__DIR__ . '/../' . '*.php');

    // [SECURITY] glob() returns FALSE on error. Level 8 requires handling this.
    if ($files === false) {
        return [];
    }

    foreach ($files as $file) {
        $filename = basename($file);

        // Skip hidden files, system files, or the excluded list
        if (in_array($filename, $exclude, true) || str_starts_with($filename, '.')) {
            continue;
        }

        /** * [SECURITY] filemtime() returns FALSE on failure. 
         * We fallback to the current time to satisfy the 'int' requirement of date().
         */
        $mtimeResult = filemtime($file);
        $lastModTimestamp = ($mtimeResult === false) ? time() : $mtimeResult;

        // Pretty Title (Capitalized filename without extension, replacing dashes with spaces)
        $title = ucfirst(str_replace(['.php', '-'], ['', ' '], $filename));

        $pages[] = [
            'file'    => $filename,
            'url'     => htmlspecialchars($filename, ENT_QUOTES, 'UTF-8'),
            'lastmod' => date('Y-m-d', $lastModTimestamp),
            'title'   => $title
        ];
    }

    return $pages;
}
