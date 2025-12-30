<?php

declare(strict_types=1);

/**
 * [ENTRY POINT] Modernization History
 * Role: Chronological log of the CMSForNerd v3.1 - v3.3 evolution.
 * Architecture: Pair Logic (history.php + contents/history-body.inc)
 */

// 1. [PERFORMANCE] Output Buffering
if (!ob_start("ob_gzhandler")) {
    ob_start();
}

/**
 * 2. [LAB] BOOTSTRAP PHASE
 * Ensures $themeName and $cssPath are initialized for the context.
 */
require_once __DIR__ . '/includes/bootstrap.php';

// 3. [SEO/AI] History Metadata
$content = [
    'title'       => "Modernization History | CMSForNerd v3.3 Evolution",
    'author'      => "CMSForNerd Team & Google Gemini",
    'description' => "Tracking the journey of CMSForNerd from a 2005 legacy core to a 2025 PHP 8.4 powerhouse.",
    'keywords'    => "Changelog, PHP 8.4, PHP 9 Readiness, Architecture, History, Open Source",
    'schemaType'  => "ArchiveComponent"
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
}

ob_end_flush();
