<?php

declare(strict_types=1);

/**
 * CmsForNerd - Centralized Bootstrap (Laboratory Engine v3.5)
 * Compliance: PHP 8.4+, PSR-12, PHPStan Level 8
 * * SECURITY NOTE: This file manages error suppression and path abstraction
 * to prevent Information Disclosure (CWE-200).
 */

// 1. [LAB] ERROR MANAGEMENT & PATH PROTECTION
// In Laboratory mode, we hide absolute system paths from the browser.
ini_set('display_errors', '0');
ini_set('log_errors', '1');
error_reporting(E_ALL);

// 2. [LAB] Load the Composer Autoloader
// dirname(__DIR__) is used to locate the root safely.
require_once dirname(__DIR__) . '/vendor/autoload.php';

// 3. [LAB] Load Function Declarations
require_once __DIR__ . '/global-control.inc.php';
require_once __DIR__ . '/common.inc.php';

/**
 * 4. [LAB] SECURITY & NONCE GENERATION
 * Generates a unique 128-bit cryptographically strong nonce for CSP.
 */
$nonce = bin2hex(random_bytes(16));

/**
 * 5. [LAB] GLOBAL CONTEXT FACTORY
 * Encapsulates CmsContext creation. This prevents "Undefined Variable" notices
 * and ensures immutable state management throughout the page lifecycle.
 *
 * @param array<string, mixed> $content
 * @param string $pageName
 * @return \CmsForNerd\CmsContext
 */
function createCmsContext(array $content, string $pageName): \CmsForNerd\CmsContext
{
    global $themeName, $cssPath, $dataFile, $nonce;

    // Use null-coalescing to ensure no uninitialized property access
    return new \CmsForNerd\CmsContext(
        content:    $content,
        themeName:  $themeName ?? 'default',
        cssPath:    $cssPath ?? 'themes/default/css/',
        dataFile:   $dataFile ?? ['index'],
        scriptName: $pageName,
        cspNonce:   $nonce
    );
}

// 6. [LAB] SET SECURITY HEADERS
// Enforce Content Security Policy using the generated Nonce.
header("Content-Security-Policy: script-src 'self' 'nonce-$nonce';");
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");

// 7. [LAB] Initialization Phase
\CmsForNerd\boot_security();
$config = \CmsForNerd\get_runtime_config();

// 8. [LAB] Variable Extraction & Fallbacks
$themeName  = (string) ($config['THEMENAME']   ?? 'CmsForNerd');
$cssPath    = (string) ($config['CSSPATH']     ?? "themes/{$themeName}/css/");
$sitemapUrl = (string) ($config['sitemap_url'] ?? 'sitemap.php');

// 9. [LAB] Routing Preparation
$scriptName = basename($_SERVER['SCRIPT_NAME']);
$dataFile   = explode(".", $scriptName);

// 10. [LAB] CLASS VERIFICATION
if (!class_exists('\\CmsForNerd\\CmsContext')) {
    // Log logical error without revealing physical disk path to the user
    error_log("Critical: CmsContext class not found in " . __FILE__);
    die("Laboratory Engine Error: Core components missing. Check vendor/ folder.");
}
