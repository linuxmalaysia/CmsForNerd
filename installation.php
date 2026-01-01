<?php

declare(strict_types=1);

/**
 * [ENTRY POINT] Installation Guide - v3.4 Laboratory Standard
 * Purpose: Technical instructions for deploying the CMSForNerd core.
 * Architecture: Factory Pattern + Context Injection
 * Compliance: PHP 8.4+, PSR-12, PHPStan Level 8
 */

// 1. [PERFORMANCE] Enable GZIP Compression for technical documentation
if (!ob_start("ob_gzhandler")) {
    ob_start();
}

/**
 * 2. [LAB] BOOTSTRAP PHASE
 * Loading includes/bootstrap.php initializes the environment, generates 
 * the security nonce, and prepares the runtime configuration.
 */
require_once __DIR__ . '/includes/bootstrap.php';

// 3. [SEO/AI] Deployment Metadata
/** @var array<string, string> $content */
$content = [
    'title'       => "Installation Guide | CMSForNerd v3.4 Laboratory",
    'author'      => "CMSForNerd Team & Gemini AI",
    'description' => "Official deployment steps for CMSForNerd v3.4. Learn how to install the flat-file core on modern PHP 8.4 environments.",
    'keywords'    => "Installation, Deployment, PHP 8.4, Composer, Git, Flat-file CMS Setup",
    'schemaType'  => "HowTo"
];

// 4. [LAB] ROUTING LOGIC
// We normalize the page name to ensure the engine loads 'installation-body.inc'
$pageName = pathinfo(basename(__FILE__), PATHINFO_FILENAME);

/**
 * 5. [MODERN PHP] Context Factory Injection
 * Instead of manual instantiation, we use the factory from bootstrap.php.
 * This ensures all global state (CSS, DataFiles, Nonces) is injected correctly.
 */
$ctx = createCmsContext($content, $pageName);

// 6. [SECURITY] Cloudflare Turnstile Check
// Optional security layer for installation forms or validation
if (file_exists(__DIR__ . '/includes/turnstile.php')) {
    require_once __DIR__ . '/includes/turnstile.php';
}

/**
 * 7. [RENDER] Theme Execution
 * The $ctx object is passed to the pager function, following the "Zero-Global" 
 * philosophy of the v3.4 Laboratory.
 */
$pagerPath = __DIR__ . "/themes/{$ctx->themeName}/pager.php";

if (file_exists($pagerPath)) {
    require_once $pagerPath;
    
    // PHPStan Level 8: We check if the function exists before calling
    if (function_exists('pager')) {
        pager($ctx);
    } else {
        http_response_code(500);
        die("Fatal Error: Theme engine 'pager' function not found.");
    }
} else {
    http_response_code(500);
    die("Fatal Error: Theme engine missing for Installation Guide.");
}

// Flush the GZIP buffer to the browser
if (ob_get_level() > 0) {
    ob_end_flush();
}
