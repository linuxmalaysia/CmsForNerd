<?php

declare(strict_types=1);

/**
 * [ENTRY POINT] Linux Setup Guide
 * Role: Technical walkthrough for PHP 8.4+ environment deployment.
 * Architecture: Pair Logic (linux-setup.php + contents/linux-setup-body.inc)
 * Compliance: PHP 8.4+, PSR-12, RFC 2119
 */

// 1. [PERFORMANCE] Enable GZIP Compression
if (!ob_start("ob_gzhandler")) {
    ob_start();
}

/**
 * 2. [LAB] BOOTSTRAP PHASE
 * We require includes/bootstrap.php to initialize $themeName and $cssPath.
 * This resolves the Fatal Error caused by null arguments in the CmsContext.
 */
require_once __DIR__ . '/includes/bootstrap.php';

// 3. [SEO/AI] Setup Metadata
$content = [
    'title'       => "Linux Setup Guide (PHP 8.4+) | CMSForNerd Lab",
    'author'      => "CMSForNerd Team & Google Gemini",
    'description' => "Official laboratory guide for ensuring PHP 8.4+ compatibility on Debian, Ubuntu LTS, and AlmaLinux.",
    'keywords'    => "Linux Setup, PHP 8.4, Debian, AlmaLinux, Remi Repository, Ondřej Surý, Web Server Config",
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
    die("Fatal Error: Theme engine missing for Linux Setup.");
}

ob_end_flush();
