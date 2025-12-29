<?php

declare(strict_types=1);

/**
 * [EDUCATIONAL] Final Exam: The Break-Fix Challenge.
 * Purpose: Certification phase. Students must repair 5 deliberate architectural flaws.
 * Architecture: Pair Logic (final-exam.php + contents/final-exam-body.inc)
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
    'title'       => "Final Exam: Break-Fix Challenge - CMSForNerd v3.3",
    'author'      => "CMSForNerd Team & Google Gemini",
    'description' => "Final Certification Exam. Repair 5 deliberate errors to prove mastery of PHP 8.4+, PSR-12, and TDD.",
    'keywords'    => "Final Exam, PHP 8.4, Break-Fix, Security Audit, PSR-12, PHP Certification",
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
    die("Fatal Error: Theme engine missing for Final Exam.");
}

ob_end_flush();
