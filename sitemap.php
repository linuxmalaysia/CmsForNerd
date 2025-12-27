<?php

declare(strict_types=1);

// [SEO] A Sitemap MUST be used to help search engines discover all your pages.
// In a flat-file CMS, we generated this XML dynamically by scanning the file system.

require_once __DIR__ . '/vendor/autoload.php';
use CmsForNerd\CmsContext;

$ctx = new CmsContext();

// [SEO] Sitemaps REQUIRE full URLs (e.g., https://example.com/page.php).
// The baseUrl is automatically detected by the CmsContext.
$baseUrl = $ctx->baseUrl;

// [SEO] Sitemaps MUST be served with the correct "Content-Type" (application/xml).
header("Content-Type: application/xml; charset=utf-8");

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

// [SEO] Homepage SHOULD get the highest priority (1.0).
echo "<url><loc>{$baseUrl}</loc><priority>1.0</priority></url>";

// [AUTOMATION] It is RECOMMENDED to use glob() to scan for new content automatically.
$files = glob("contents/*-body.inc");

foreach ($files as $file) {
    // Extract the page name (e.g., "about" from "about-body.inc").
    $filename = basename($file, "-body.inc");

    // Skip technical pages that SHOULD NOT be indexed separately.
    if ($filename === 'index' || $filename === 'sitemap') {
        continue;
    }

    // [SEO] Google RECOMMENDS providing 'lastmod' dates.
    $lastMod = date("Y-m-d", filemtime($file));
    
    echo "<url>";
    echo "<loc>{$baseUrl}{$filename}.php</loc>";
    echo "<lastmod>{$lastMod}</lastmod>";
    echo "<priority>0.8</priority>";
    echo "</url>";
}

echo '</urlset>';

