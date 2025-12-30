<?php

declare(strict_types=1);

/**
 * [ENTRY POINT] AI-Assisted Development Guide
 * Purpose: Teaches the "Architect vs. Agent" synergy using Gemini and Antigravity.
 * Architecture: Pair Logic (ai-dev.php + contents/ai-dev-body.inc)
 */

// 1. [PERFORMANCE] Enable GZIP
if (!ob_start("ob_gzhandler")) {
    ob_start();
}

/**
 * 2. [LAB] BOOTSTRAP PHASE
 * Fixes: $THEMENAME and $CSSPATH undefined errors.
 */
require_once __DIR__ . '/includes/bootstrap.php';

// 3. [SEO] AI Development Metadata
$content = [
    'title'       => "AI-Assisted Development | CMSForNerd v3.3",
    'author'      => "CMSForNerd Team & Google Gemini",
    'description' => "Master the synergy between Google Gemini AI and Google Antigravity to build, refactor, and modernize your CMS.",
    'keywords'    => "AI Development, Google Gemini, Google Antigravity, Agentic Workflow, PHP 8.4 AI",
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
    die("Fatal Error: Theme engine missing for AI Dev Guide.");
}

ob_end_flush();
