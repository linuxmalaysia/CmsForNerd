<?php

declare(strict_types=1);

/**
 * [ENTRY POINT] Hall of Fame
 * Purpose: Recognizes ethical security researchers and laboratory contributors.
 * Architecture: Pair Logic (hall-of-fame.php + contents/hall-of-fame-body.inc)
 * Compliance: PHP 8.4+, PSR-12, RFC 2119
 */

// 1. [PERFORMANCE] Enable GZIP Compression
if (!ob_start("ob_gzhandler")) {
    ob_start();
}

/**
 * 2. [LAB] BOOTSTRAP PHASE
 * Loading bootstrap.php defines $themeName and $cssPath, fixing the 
 * previous Fatal Errors in the CmsContext constructor.
 */
require_once __DIR__ . '/includes/bootstrap.php';

// 3. [SEO/AI] Recognition Metadata
$content = [
    'title'       => "Nerd Hall of Fame | CMSForNerd Recognition",
    'author'      => "CMSForNerd Team & Google Gemini",
    'description' => "Celebrating the researchers and students who have helped secure and modernize the CMSForNerd Laboratory.",
    'keywords'    => "Hall of Fame, Contributors, Ethical Disclosure, PHP 8.4, Security Recognition",
    'schemaType'  => "SpecialAnnouncement"
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
    die("Fatal Error: Theme engine missing for Hall of Fame.");
}

ob_end_flush();
