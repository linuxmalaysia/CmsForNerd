<?php

declare(strict_types=1);

/**
 * [EDUCATIONAL] Lab Worksheet: Module 4 - Automated Testing with PHPUnit 11.
 * Purpose: Master the Arrange-Act-Assert (AAA) pattern and TDD fundamentals.
 * Architecture: Pair Logic (lab-module4.php + contents/lab-module4-body.inc)
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
    'title'       => "Lab Worksheet: Module 4 - CmsForNerd v3.3",
    'author'      => "CMSForNerd Team & Google Gemini",
    'description' => "Student Lab Worksheet for Module 4: Automated Testing with PHPUnit 11. Master the AAA pattern.",
    'keywords'    => "Testing Lab, Module 4, PHPUnit 11, TDD, AAA Pattern, Security Testing",
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
    die("Fatal Error: Theme engine missing for Testing Module 4.");
}

ob_end_flush();
