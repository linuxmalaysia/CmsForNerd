<?php
declare(strict_types=1);

/**
 * [SEO] v3.1 XML Sitemap Generator
 * Merges original CmsContext baseUrl with automated content scanning.
 */

require_once __DIR__ . '/vendor/autoload.php';
use CmsForNerd\CmsContext;

// Initialize context to get the detected baseUrl automatically
$ctx = new CmsContext();
$baseUrl = rtrim($ctx->baseUrl, '/') . '/';

// [SEO] Sitemaps MUST be served with the correct "Content-Type"
header("Content-Type: application/xml; charset=utf-8");

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

// 1. [SEO] Homepage MUST get the highest priority (1.0).
echo "  <url>" . PHP_EOL;
echo "    <loc>{$baseUrl}index.php</loc>" . PHP_EOL;
echo "    <priority>1.0</priority>" . PHP_EOL;
echo "  </url>" . PHP_EOL;

// 2. [AUTOMATION] Scan 'contents/' for *-body.inc files to find valid pages.
$files = glob("contents/*-body.inc");

foreach ($files as $file) {
    // Extract the page name (e.g., "about" from "about-body.inc").
    $filename = basename($file, "-body.inc");

    // Skip pages that SHOULD NOT be indexed separately.
    $exclude = ['index', 'sitemap', 'empty'];
    if (in_array($filename, $exclude)) {
        continue;
    }

    // Verify the corresponding .php file exists in root before indexing
    if (file_exists($filename . ".php")) {
        $lastMod = date("Y-m-d", filemtime($file));
        
        echo "  <url>" . PHP_EOL;
        echo "    <loc>{$baseUrl}{$filename}.php</loc>" . PHP_EOL;
        echo "    <lastmod>{$lastMod}</lastmod>" . PHP_EOL;
        echo "    <priority>0.8</priority>" . PHP_EOL;
        echo "  </url>" . PHP_EOL;
    }
}

echo '</urlset>';
