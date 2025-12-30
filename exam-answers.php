<?php

declare(strict_types=1);

/**
 * [ENTRY POINT] Official Answer Key: Final Exam
 * Role: Instructor Resource / Grading Key.
 * Architecture: Pair Logic (exam-answers.php + contents/exam-answers-body.inc)
 * Compliance: PHP 8.4+, PSR-12, RFC 2119
 */

// 1. [PERFORMANCE] Enable GZIP Compression
if (!ob_start("ob_gzhandler")) {
    ob_start();
}

/**
 * 2. [LAB] BOOTSTRAP PHASE
 * We load includes/bootstrap.php to initialize $themeName and $cssPath.
 * This fixes the Fatal Errors regarding null arguments in CmsContext.
 */
require_once __DIR__ . '/includes/bootstrap.php';

// 3. [SEO/AI] Instructor-Level Metadata
$content = [
    'title'          => "Official Answer Key: Final Exam | CMSForNerd v3.3",
    'author'         => "CMSForNerd Team & Google Gemini",
    'description'    => "Instructor grading rubric and official logic solutions for the CMSForNerd v3.3 Final Exam.",
    'keywords'       => "Answer Key, Grading Rubric, PHP 8.4 Hooks, Security Audit, PSR-12",
    'robots'         => "noindex, nofollow", // Keep exam answers out of public search engines
    'schemaType'     => "EducationalOccupationalCredential"
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
    die("Fatal Error: Theme engine missing for Answer Key.");
}

ob_end_flush();
