<?php

declare(strict_types=1);

/**
 * [ENTRY POINT] Windows 11 Setup Guide
 * Purpose: Technical walkthrough for local development environment setup.
 * Architecture: Pair Logic (windows-setup.php + contents/windows-setup-body.inc)
 * Compliance: PHP 8.4+, PSR-12, RFC 2119
 */

// 1. [PERFORMANCE] Enable GZIP Compression
if (!ob_start("ob_gzhandler")) {
    ob_start();
}

/**
 * 2. [LAB] BOOTSTRAP PHASE
 * Loading bootstrap.php ensures $themeName and $cssPath are defined,
 * preventing Fatal Errors during CmsContext instantiation.
 */
require_once __DIR__ . '/includes/bootstrap.php';

// 3. [SEO/AI] Setup Metadata
$content = [
    'title'       => "Windows 11 Setup Guide: PHP 8.4+ & 9 Ready | CMSForNerd",
    'author'      => "CMSForNerd Team & Google Gemini",
    'description' => "Step-by-step guide to setting up Laravel Herd, Git, and Antigravity for PHP 8.4 development on Windows 11.",
    'keywords'    => "Windows 11, PHP 8.4, PHP 9, Laravel Herd, Git for Windows, Antigravity Terminal, Composer",
    'schemaType'  => "HowTo"
];

// 4. [LAB] ROUTING LOGIC
$pageName = pathinfo(basename(__FILE__), PATHINFO_FILENAME);

/**
 * 5. [MODERN PHP] Initialize Context Object
 */
$ctx = new \CmsForNerd\CmsContext(
    content:    $content,
    themeName:  $themeName,
    cssPath:    $cssPath,
    dataFile:   $dataFile,
    scriptName: $pageName
);

// 6. [SECURITY] Cloudflare Turnstile Check
if (file_exists(__DIR__ . '/includes/turnstile.php')) {
    require_once __DIR__ . '/includes/turnstile.php';
}

/**
 * 7. [RENDER] Theme Execution
 */
$pagerPath = __DIR__ . "/themes/{$ctx->themeName}/pager.php";

if (file_exists($pagerPath)) {
    require_once $pagerPath;
    pager($ctx);
} else {
    http_response_code(500);
    die("Fatal Error: Theme engine missing for Windows Setup.");
}

ob_end_flush();
