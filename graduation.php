<?php

declare(strict_types=1);

/**
 * [EDUCATIONAL] Lab Graduation Page: Certificate of Completion.
 * Purpose: Celebrate student success and provide a verifiable certificate.
 * Architecture: Pair Logic (graduation.php + contents/graduation-body.inc)
 */

// 1. [PERFORMANCE] Enable GZIP
if (!ob_start("ob_gzhandler")) {
    ob_start();
}

/**
 * 2. [LAB] BOOTSTRAP PHASE
 * Initializes constants and the autoloader. 
 * Fixes: $THEMENAME and $CSSPATH undefined errors.
 */
require_once __DIR__ . '/includes/bootstrap.php';

// 3. [SEO] Graduation Metadata
$content = [
    'title'       => "Graduation: PHP 8.4+ Mastery - CmsForNerd v3.3",
    'author'      => "CMSForNerd Team & Google Gemini",
    'description' => "Official Certificate of Completion for the CmsForNerd Modernization Curriculum.",
    'keywords'    => "Graduation, Certificate, PHP 8.4, Modern PHP, Software Engineering",
];

// 4. [LAB] ROUTING LOGIC
$pageName = pathinfo(basename(__FILE__), PATHINFO_FILENAME);

// 5. [MODERN PHP] Initialize Context Object
$ctx = new \CmsForNerd\CmsContext(
    content:    $content,
    themeName:  $themeName,
    cssPath:    $cssPath,
    dataFile:   $dataFile,
    scriptName: $pageName
);

// 6. [SECURITY] Cloudflare Turnstile Check
// We keep this to ensure only "human" students can generate the certificate
if (file_exists(__DIR__ . '/includes/turnstile.php')) {
    require_once __DIR__ . '/includes/turnstile.php';
}

/**
 * 7. [RENDER] Theme Execution
 */
$pagerPath = __DIR__ . "/themes/{$ctx->themeName}/pager.php";

if (file_exists($pagerPath)) {
    include_once $pagerPath;
    pager($ctx);
} else {
    // Fail-safe for graduation
    die("Fatal Error: Theme engine missing. Graduation aborted.");
}

ob_end_flush();
