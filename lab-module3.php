<?php

declare(strict_types=1);

/**
 * [EDUCATIONAL] Lab Worksheet: Module 3 - Defensive Engineering & Path Traversal.
 * Purpose: Master Defense-in-Depth, CSP nonces, and input hardening.
 * Architecture: Pair Logic (lab-module3.php + contents/lab-module3-body.inc)
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

// 3. [SEO] Student Module Metadata
$content = [
    'title'       => "Lab Worksheet: Module 3 - CmsForNerd v3.3",
    'author'      => "CMSForNerd Team & Google Gemini",
    'description' => "Module 3: Defensive Engineering. Learn Path Traversal defense, CSP Nonces, and Bot Protection.",
    'keywords'    => "Security Lab, Path Traversal, CSP Nonce, PHP 8.4, Cyber Security",
];

// 4. [LAB] ROUTING LOGIC
$pageName = pathinfo(basename(__FILE__), PATHINFO_FILENAME);

// 5. [MODERN PHP] Initialize Context Object
// Note: $cspNonce is automatically generated inside the CmsContext constructor
$ctx = new \CmsForNerd\CmsContext(
    content:    $content,
    themeName:  $themeName,
    cssPath:    $cssPath,
    dataFile:   $dataFile,
    scriptName: $pageName
);

// 6. [SECURITY] Cloudflare Turnstile Verification
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
    die("Fatal Error: Theme engine missing for Security Module 3.");
}

ob_end_flush();
