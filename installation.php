<?php

declare(strict_types=1);

/**
 * CmsForNerd - Installation Page
 * This file serves as the setup guide and environment check.
 */

// 1. [PERFORMANCE] Output buffering with GZIP compression.
if (!ob_start("ob_gzhandler")) {
    ob_start();
}

/**
 * 2. [LAB] BOOTSTRAP PHASE
 * This replaces 'vendor/autoload.php' and manual includes.
 * It initializes $themeName, $cssPath, and $dataFile correctly.
 */
require_once __DIR__ . '/includes/bootstrap.php';

// 3. [SEO] Page Metadata
$content = [
    'title'       => "Installation of CmsForNerd",
    'author'      => "Harisfazillah Jamel",
    'description' => "Installation guide for CmsForNerd - a flat-file CMS for learning PHP 8.4.",
    'keywords'    => "CmsForNerd, CMS, Installation, PHP 8.4, Guide",
];

/**
 * 4. [MODERN PHP] CmsContext Object
 * We use the variables provided by bootstrap.php ($themeName, $cssPath, $dataFile).
 */
$ctx = new \CmsForNerd\CmsContext(
    content:    $content,
    themeName:  $themeName,
    cssPath:    $cssPath,
    dataFile:   $dataFile,
    scriptName: pathinfo(basename(__FILE__), PATHINFO_FILENAME)
);

/**
 * 5. [SECURITY] Cloudflare Turnstile integration.
 */
if (file_exists(__DIR__ . '/includes/turnstile.php')) {
    require_once __DIR__ . '/includes/turnstile.php';
}

/**
 * 6. [RENDER] Main entry point.
 * Load the theme's pager and execute.
 */
session_start();
$pagerPath = __DIR__ . "/themes/{$ctx->themeName}/pager.php";

if (file_exists($pagerPath)) {
    include_once $pagerPath;
    pager($ctx);
}

// 7. [PERFORMANCE] Flush output.
ob_end_flush();
