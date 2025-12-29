<?php

declare(strict_types=1);

/**
 * [EDUCATIONAL] Lab Worksheet: Module 5 - Test Coverage and Quality Assurance.
 * Purpose: Master Code Coverage visualization, Xdebug integration, and CRAP index analysis.
 * Architecture: Pair Logic (lab-module5.php + contents/lab-module5-body.inc)
 */

// 1. [PERFORMANCE] Enable GZIP
if (!ob_start("ob_gzhandler")) {
    ob_start();
}

/**
 * 2. [LAB] BOOTSTRAP PHASE
 * Fixes: $THEMENAME and $CSSPATH undefined errors.
 * Ensures the autoloader is active for CmsContext.
 */
require_once __DIR__ . '/includes/bootstrap.php';

// 3. [SEO] Student Module Metadata
$content = [
    'title'       => "Lab Worksheet: Module 5 - CmsForNerd v3.3",
    'author'      => "CMSForNerd Team & Google Gemini",
    'description' => "Module 5: Test Coverage and QA. Learn to visualize the safety net of your application using HTML reports.",
    'keywords'    => "Coverage Lab, PHPUnit, Xdebug, CRAP Index, PHP 9 Ready, QA",
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
    die("Fatal Error: Theme engine missing for QA Module 5.");
}

ob_end_flush();
