<?php

declare(strict_types=1);

/**
 * [EDUCATIONAL] Student Welcome Kit - CMSForNerd v3.3
 * Purpose: Essential reference guide for lab students.
 * Architecture: Pair Logic (welcome-kit.php + contents/welcome-kit-body.inc)
 */

// 1. [PERFORMANCE] GZIP Compression
if (!ob_start("ob_gzhandler")) {
    ob_start();
}

/**
 * 2. [LAB] BOOTSTRAP PHASE
 * Loads Autoloader, Global Config, and initializes 
 * $themeName, $cssPath, and $dataFile variables.
 */
require_once __DIR__ . '/includes/bootstrap.php';

// 3. [SEO] Metadata - Student Kit Specific
$content = [
    'title'       => "Student Welcome Kit: Essential Cheat Sheet - CMSForNerd v3.3",
    'author'      => "CMSForNerd Team & Google Gemini",
    'description' => "The one-stop reference guide for every student entering the CmsForNerd v3.3 Laboratory.",
    'keywords'    => "Welcome Kit, Cheat Sheet, Student Guide, PHP 8.4+, RFC 2119, PSR-12, Security",
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

// 6. [SECURITY] Cloudflare Turnstile & Session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (file_exists(__DIR__ . '/includes/turnstile.php')) {
    require_once __DIR__ . '/includes/turnstile.php';
}

/**
 * 7. [RENDER] Theme Execution
 * Loads the pager() from the active theme folder.
 */
$pagerPath = __DIR__ . "/themes/{$ctx->themeName}/pager.php";

if (file_exists($pagerPath)) {
    include_once $pagerPath;
    pager($ctx);
} else {
    die("Fatal Error: Theme pager missing for welcome-kit.");
}

// 8. [PERFORMANCE] Output flush
ob_end_flush();
