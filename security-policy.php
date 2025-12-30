<?php

declare(strict_types=1);

/**
 * [ENTRY POINT] Security Policy
 * Purpose: Defines the formal vulnerability disclosure protocol.
 * Architecture: Pair Logic (security-policy.php + contents/security-policy-body.inc)
 * Compliance: PHP 8.4+, PSR-12, RFC 2119
 */

// 1. [PERFORMANCE] Enable GZIP Compression
if (!ob_start("ob_gzhandler")) {
    ob_start();
}

/**
 * 2. [LAB] BOOTSTRAP PHASE
 * Loading includes/bootstrap.php ensures $themeName and $cssPath are defined
 * globally, preventing the previous "Undefined Variable" Fatal Errors.
 */
require_once __DIR__ . '/includes/bootstrap.php';

// 3. [SEO/AI] Enhanced Security Metadata
$content = [
    'title'          => "Security Policy & Disclosure | CMSForNerd Laboratory",
    'author'         => "CMSForNerd Team & Google Gemini",
    'description'    => "The formal security policy for responsible disclosure and ethical vulnerability reporting in the CMSForNerd project.",
    'keywords'       => "Security Policy, Responsible Disclosure, VDP, Vulnerability Reporting, PHP 8.4 Security",
    'schemaType'     => "WebPage",
    'specialty'      => "Cybersecurity Compliance",
    'dateModified'   => "2025-12-30"
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
    die("Fatal Error: Theme engine missing for Security Policy.");
}

ob_end_flush();
