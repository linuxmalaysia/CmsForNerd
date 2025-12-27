<?php
/**
 * Dynamic XML Sitemap Generator for CmsForNerd
 * Generated for v3.1 2025
 */

// [SEO] A Sitemap helps search engines like Google discover all your pages automatically.
// In a flat-file CMS, we generate this XML dynamically by scanning the file system.

require_once __DIR__ . '/vendor/autoload.php';
use CmsForNerd\CmsContext;

$ctx = new CmsContext();

// [ROUTING] Build the absolute URL. Sitemaps REQUIRE full URLs (e.g., https://example.com/page.php).
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$path = dirname($_SERVER['PHP_SELF']);
$baseUrl = "$protocol://$host" . rtrim($path, '/\\') . '/';

// [SEO] Sitemaps must be served with the correct "Content-Type" (application/xml) so Google understands it's a map.
header("Content-Type: application/xml; charset=utf-8");

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

// [SEO] Homepage usually gets the highest priority (1.0).
echo "<url><loc>{$baseUrl}</loc><priority>1.0</priority></url>";

// [AUTOMATION] glob() scans the /contents folder for all valid body files.
// This means every time you create a new file, it's automatically added to the sitemap!
$files = glob("contents/*-body.inc");

foreach ($files as $file) {
    // Extract the page name (e.g., "about" from "about-body.inc").
    $filename = basename($file, "-body.inc");

    // Skip technical pages that shouldn't be indexed separately.
    if ($filename === 'index' || $filename === 'sitemap') continue;

    // [SEO] filemtime() tells Google when you last updated this page.
    $lastMod = date("Y-m-d", filemtime($file));
    
    echo "<url>";
    echo "<loc>{$baseUrl}{$filename}.php</loc>";
    echo "<lastmod>{$lastMod}</lastmod>";
    echo "<priority>0.8</priority>";
    echo "</url>";
}

echo '</urlset>';
