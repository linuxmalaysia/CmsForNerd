<?php

declare(strict_types=1);

/**
 * [ENTRY POINT] CSP Nonce Implementation Guide
 * Purpose: Documentation for XSS protection using cryptographically secure nonces.
 * Architecture: Pair Logic (csp-nonce-guide.php + contents/csp-nonce-guide-body.inc)
 * Compliance: PHP 8.4+, PSR-12, RFC 2119
 */

// 1. [PERFORMANCE] Enable GZIP Compression
if (!ob_start("ob_gzhandler")) {
    ob_start();
}

/**
 * 2. [LAB] BOOTSTRAP PHASE
 * Fixes the Undefined variable $THEMENAME and $CSSPATH errors by properly
 * loading the laboratory's global state from bootstrap.php.
 */
require_once __DIR__ . '/includes/bootstrap.php';

// 3. [SEO/AI] Expanded Security Metadata
$content = [
    'title'       => "CSP Nonce Implementation Guide | CMSForNerd Security",
    'author'      => "CMSForNerd Security Team",
    'description' => "Comprehensive guide to implementing Content Security Policy nonces for XSS protection in PHP 8.4.",
    'keywords'    => "CSP, nonce, XSS, security, PHP 8.4, Content Security Policy, SecurityUtils",
    'schemaType'  => "TechArticle",
    'category'    => "Cybersecurity Laboratory"
];

// 4. [LAB] ROUTING LOGIC
$pageName = pathinfo(basename(__FILE__), PATHINFO_FILENAME);

/**
 * 5. [MODERN PHP] Initialize Context Object
 * Includes $cspNonce generation via SecurityUtils (called within CmsContext).
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
    die("Fatal Error: Theme engine missing for Security Guide.");
}

ob_end_flush();
