<?php
declare(strict_types=1);

/**
 * FILE: /sitemap.php
 * ROLE: Standalone XML Sitemap Generator
 * SECURITY: Self-contained, no external dependencies.
 */

// 1. [DEBUG] Enable error reporting to break the 500 Error wall
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// 2. [BASE URL] Auto-detect the base URL of the laboratory
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
// Clean the request URI to get the directory path
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$baseUrl = rtrim($protocol . $host . $scriptDir, '/') . '/';

// 3. [CLEANUP] Clear all buffers to ensure clean XML output
while (ob_get_level()) {
    ob_end_clean();
}

// 4. [HEADERS] Set content type for XML
header("Content-Type: application/xml; charset=utf-8");

// 5. [XML START] Begin output
echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

// 6. [HOME] Add the main entry point
echo "  <url>" . PHP_EOL;
echo "    <loc>{$baseUrl}index.php</loc>" . PHP_EOL;
echo "    <priority>1.0</priority>" . PHP_EOL;
echo "  </url>" . PHP_EOL;

// 7. [SCAN] Look for content fragments in the 'contents/' folder
$fragmentDir = __DIR__ . '/contents/';

if (is_dir($fragmentDir)) {
    $files = glob($fragmentDir . '*-body.inc');

    foreach ($files as $file) {
        // Extract slug (e.g., 'about' from 'about-body.inc')
        $slug = str_replace('-body.inc', '', basename($file));

        // Skip non-public or internal fragments
        $exclude = ['index', 'sitemap', 'empty', '403', '404'];
        if (in_array($slug, $exclude)) {
            continue;
        }

        // Verify that a corresponding Master Controller (.php) exists in root
        $masterFile = __DIR__ . '/' . $slug . '.php';

        if (file_exists($masterFile)) {
            // Get the most recent modification time between logic and content
            $mTime = max(filemtime($masterFile), filemtime($file));
            $lastMod = date("c", $mTime); // ISO 8601 format

            echo "  <url>" . PHP_EOL;
            echo "    <loc>{$baseUrl}{$slug}.php</loc>" . PHP_EOL;
            echo "    <lastmod>{$lastMod}</lastmod>" . PHP_EOL;
            echo "    <priority>0.8</priority>" . PHP_EOL;
            echo "  </url>" . PHP_EOL;
        }
    }
}

// 8. [XML END] Close the set
echo '</urlset>';
exit;
