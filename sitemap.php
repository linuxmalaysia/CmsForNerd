<?php

declare(strict_types=1);

/**
 * ==========================================================================
 * FILE: /sitemap.php
 * ROLE: XML Sitemap Generator (v3.4 Laboratory Baseline)
 * ==========================================================================
 * [EDUCATION: BASELINE SYNC]
 * This file mirrors template.php architecture:
 * 1. [PERFORMANCE] GZIP buffering (ob_gzhandler)
 * 2. [BOOTSTRAP] Unified core loading
 * 3. [CONTEXT] Factory-based state management
 * 4. [LOGIC] Automated "Pair Logic" scanning for SEO
 * ==========================================================================
 */

// 1. [PERFORMANCE] Enable GZIP and Output Buffering
// Compressing XML sitemaps is vital as they can grow very large.
if (!ob_start("ob_gzhandler")) {
    ob_start();
}

/**
 * 2. [LAB] BOOTSTRAP PHASE
 * Rule #6: Always include bootstrap.php for PSR-12 and Strict Types.
 */
require_once __DIR__ . '/includes/bootstrap.php';

/**
 * 3. [SEO/AI] Page Metadata
 * We treat the Sitemap itself as a Lab Specimen.
 */
$content = [
    'title'       => "Sitemap | CmsForNerd v3.4",
    'author'      => "Harisfazillah Jamel",
    'description' => "Automated XML Sitemap for PHP 8.4 Laboratory.",
    'schemaType'  => "WebSite"
];

// Determine our identity
$pageName = 'sitemap';
$content['data'] = $pageName;

/**
 * 4. [MODERN PHP] CmsContext Initialization (Factory Method)
 * Rule #7: Using the factory prevents ArgumentCountError in v3.4.
 */
$ctx = createCmsContext(
    content: $content, 
    pageName: $pageName
);

$baseUrl = rtrim($ctx->baseUrl, '/') . '/';

/**
 * 5. [RENDER] XML Construction
 * Instead of a theme pager, we output application/xml directly.
 */
header("Content-Type: application/xml; charset=utf-8");

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

// 5a. [SEO] Homepage (The Architectural Root)
echo "  <url>" . PHP_EOL;
echo "    <loc>{$baseUrl}index.php</loc>" . PHP_EOL;
echo "    <priority>1.0</priority>" . PHP_EOL;
echo "  </url>" . PHP_EOL;

/**
 * 5b. [LAB] PAIR LOGIC SCANNER & MODIFICATION CHECK
 * We scan for contents/*-body.inc and verify their Master controllers.
 */
$contentFiles = glob(__DIR__ . "/contents/*-body.inc");

foreach ($contentFiles as $bodyFile) {
    $slug = basename($bodyFile, "-body.inc");

    // Skip special files as per Rule #8
    $exclude = ['index', 'sitemap', 'empty', '403', '404'];
    if (in_array($slug, $exclude)) {
        continue;
    }

    $controllerFile = __DIR__ . "/" . $slug . ".php";

    // Only index if both the Master (.php) and Slave (-body.inc) exist
    if (file_exists($controllerFile)) {
        
        /**
         * [EDUCATION: DATE COMPARISON]
         * To give Google/Bing the most accurate data, we check both files.
         * If a student edits the UI (-body.inc) OR the logic (.php),
         * we pick the most recent timestamp using max().
         */
        $timeMaster = filemtime($controllerFile);
        $timeSlave  = filemtime($bodyFile);
        $lastMod    = date("c", max($timeMaster, $timeSlave)); // "c" = ISO 8601
        
        echo "  <url>" . PHP_EOL;
        echo "    <loc>{$baseUrl}{$slug}.php</loc>" . PHP_EOL;
        echo "    <lastmod>{$lastMod}</lastmod>" . PHP_EOL;
        echo "    <priority>0.8</priority>" . PHP_EOL;
        echo "  </url>" . PHP_EOL;
    }
}

echo '</urlset>';

// Flush the buffer to the browser.
ob_end_flush();
exit;
