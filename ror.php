<?php

declare(strict_types=1);

// [ROR START]
echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;

/**
 * ==========================================================================
 * FILE: /ror.php
 * ROLE: Dynamic ROR Sitemap Generator (v3.5)
 * DESCRIPTION: Provides a Resources of a Resource (ROR) map for educational 
 * semantic exploration.
 * ==========================================================================
 */

// 1. [SECURITY] Output Buffer Hardening
while (ob_get_level()) {
    ob_end_clean();
}

// 2. [EDUCATION] Auto-URL Detection
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$host     = $_SERVER['HTTP_HOST'] ?? 'localhost';
// Sanitize host to prevent HTTP Host Header attacks / injection
$host     = preg_replace('/[^a-zA-Z0-9\-.:]/', '', $host);
$dirPath  = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$baseUrl  = rtrim($protocol . $host . $dirPath, '/') . '/';

// Helper function to escape XML output
$esc = fn(string $val): string => htmlspecialchars($val, ENT_XML1 | ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

// 3. [SECURITY] Hardened Headers
header("Content-Type: application/xml; charset=utf-8");
header("X-Content-Type-Options: nosniff");

// 4. [ROR START]
echo '<rss version="2.0" xmlns:ror="http://www.rorweb.com/0.1/">' . PHP_EOL;
echo '  <channel>' . PHP_EOL;
echo '    <title>ROR Sitemap for CMSForNerd Laboratory v3.5</title>' . PHP_EOL;
echo '    <link>' . $esc($baseUrl . 'index.php') . '</link>' . PHP_EOL;

// 5. [ITEM SCAN]
$fragmentDir = __DIR__ . '/contents/';

if (is_dir($fragmentDir)) {
    $rawFragments = glob($fragmentDir . '*-body.inc');
    $fragments = is_array($rawFragments) ? $rawFragments : [];

    foreach ($fragments as $file) {
        $slug = str_replace('-body.inc', '', basename($file));
        
        $exclude = ['index', 'sitemap', 'empty', '403', '404', 'header', 'footer'];
        if (in_array($slug, $exclude, true)) {
            continue;
        }

        $masterFile = __DIR__ . '/' . $slug . '.php';

        if (file_exists($masterFile)) {
            $title = ucfirst(str_replace('-', ' ', $slug));

            echo '    <item>' . PHP_EOL;
            echo '      <link>' . $esc($baseUrl . $slug . '.php') . '</link>' . PHP_EOL;
            echo '      <title>' . $esc($title) . '</title>' . PHP_EOL;
            echo '      <ror:type>resource</ror:type>' . PHP_EOL;
            echo '      <ror:updated>' . date('Y-m-d', (int) filemtime($file)) . '</ror:updated>' . PHP_EOL;
            echo '    </item>' . PHP_EOL;
        }
    }
}

echo '  </channel>' . PHP_EOL;
echo '</rss>';

exit;
