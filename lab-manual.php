<?php

declare(strict_types=1);

/**
 * [EDUCATIONAL] Lab Manual - CMSForNerd v3.3
 * Purpose: Central hub for the laboratory curriculum.
 * Architecture: Pair Logic (lab-manual.php + contents/lab-manual-body.inc)
 */

// 1. [PERFORMANCE] GZIP Compression
if (!ob_start("ob_gzhandler")) {
    ob_start();
}

/**
 * 2. [LAB] BOOTSTRAP PHASE
 * Initializes the environment, Autoloader, and global variables.
 * Fixes the previous $THEMENAME and $CSSPATH undefined errors.
 */
require_once __DIR__ . '/includes/bootstrap.php';

// 3. [SEO] Page Metadata
$content = [
    'title'       => "The Lab Manual: PHP 8.4+ & PHP 9 Readiness - CmsForNerd v3.3",
    'author'      => "Harisfazillah Jamel & Gemini",
    'description' => "Welcome to the v3.3 educational suite. A transparent laboratory for learning modern PHP architecture.",
    'keywords'    => "Lab Manual, PHP 8.4, Education, Architecture, Security, TDD, PSR-12",
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

// 6. [SECURITY] Standard Security Checks
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
    die("Fatal Error: Theme engine not found.");
}

ob_end_flush();
