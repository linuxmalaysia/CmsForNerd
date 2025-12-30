<?php

declare(strict_types=1);

/**
 * [ENTRY POINT] Installation Guide
 * Purpose: Technical instructions for deploying the CMSForNerd v3.3 core.
 * Architecture: Pair Logic (installation.php + contents/installation-body.inc)
 * Compliance: PHP 8.4+, PSR-12, RFC 2119
 */

// 1. [PERFORMANCE] Enable GZIP Compression
if (!ob_start("ob_gzhandler")) {
    ob_start();
}

/**
 * 2. [LAB] BOOTSTRAP PHASE
 * Loading includes/bootstrap.php ensures $themeName and $cssPath are 
 * initialized globally, preventing Fatal Errors in the context object.
 */
require_once __DIR__ . '/includes/bootstrap.php';

// 3. [SEO/AI] Deployment Metadata
$content = [
    'title'       => "Installation Guide | CMSForNerd v3.3 Laboratory",
    'author'      => "CMSForNerd Team & Google Gemini",
    'description' => "Official deployment steps for CMSForNerd v3.3. Learn how to install the flat-file core on modern PHP 8.4 environments.",
    'keywords'    => "Installation, Deployment, PHP 8.4, Composer, Git, Flat-file CMS Setup",
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
    die("Fatal Error: Theme engine missing for Installation Guide.");
}

ob_end_flush();
