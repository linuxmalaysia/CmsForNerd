<?php

declare(strict_types=1);

/**
 * [EDUCATIONAL] Lab Worksheet: Module 1 - Modern PHP 8.4+ Architecture.
 * Purpose: Master Constructor Promotion, Property Hooks, and Asymmetric Visibility.
 * Architecture: Pair Logic (lab-module1.php + contents/lab-module1-body.inc)
 */

// 1. [PERFORMANCE] Enable GZIP
if (!ob_start("ob_gzhandler")) {
    ob_start();
}

/**
 * 2. [LAB] BOOTSTRAP PHASE
 * Loads autoloader and global variables ($themeName, $cssPath).
 * This solves the "Undefined variable" and "TypeError" issues.
 */
require_once __DIR__ . '/includes/bootstrap.php';

// 3. [SEO] Student Module Metadata
$content = [
    'title'       => "Lab Worksheet: Module 1 - CmsForNerd v3.3",
    'author'      => "CMSForNerd Team & Google Gemini",
    'description' => "Student Lab Worksheet: Master Constructor Promotion and Property Hooks in PHP 8.4.",
    'keywords'    => "Architecture Lab, PHP 8.4+, Property Hooks, Constructor Promotion",
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
    die("Fatal Error: Theme pager not found for Module 1.");
}

ob_end_flush();
