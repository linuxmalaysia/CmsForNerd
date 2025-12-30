<?php

declare(strict_types=1);

/**
 * [ENTRY POINT] SOP: Ethical AI Integration
 * Role: Policy Controller for responsible AI usage in the laboratory.
 * Architecture: Pair Logic (ai-sop.php + contents/ai-sop-body.inc)
 * Compliance: PHP 8.4+, PSR-12, RFC 2119
 */

// 1. [PERFORMANCE] Enable GZIP Compression
if (!ob_start("ob_gzhandler")) {
    ob_start();
}

/**
 * 2. [LAB] BOOTSTRAP PHASE
 * We require includes/bootstrap.php to initialize $themeName and $cssPath.
 * This fixes the Undefined variable and TypeError errors in the original code.
 */
require_once __DIR__ . '/includes/bootstrap.php';

// 3. [SEO] Enhanced Metadata for Policy & Ethics Discovery
$content = [
    'title'          => "SOP: Ethical AI Integration | CMSForNerd Laboratory",
    'author'         => "CMSForNerd Team & Google Gemini",
    'description'    => "Standard Operating Procedure for responsible AI usage in the developer's laboratory.",
    'keywords'       => "AI Ethics, SOP, Responsible AI, PHP 8.4 Laboratory, Academic Integrity",
    'schemaType'     => "CreativeWork",
    'datePublished'  => "2025-12-27",
    'version'        => "2025-01"
];

// 4. [LAB] ROUTING LOGIC
$pageName = pathinfo(basename(__FILE__), PATHINFO_FILENAME);

/**
 * 5. [MODERN PHP] Initialize Context Object
 * Using Named Arguments to replace the old $CONTENT array logic.
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
    die("Fatal Error: Theme engine missing for AI SOP.");
}

ob_end_flush();
