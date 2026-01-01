<?php

declare(strict_types=1);

/**
 * CmsForNerd - Centralized Bootstrap (Laboratory Engine v3.4)
 * Compliance: PHP 8.4+, PSR-12, PHPStan Level 8
 */

// 1. [LAB] Load the Composer Autoloader
require_once dirname(__DIR__) . '/vendor/autoload.php';

// 2. [LAB] Load Function Declarations
require_once __DIR__ . '/global-control.inc.php';
require_once __DIR__ . '/common.inc.php';

/**
 * 3. [LAB] SECURITY & NONCE GENERATION
 */
$nonce = bin2hex(random_bytes(16));

/**
 * 4. [LAB] GLOBAL CONTEXT FACTORY
 * This function encapsulates the creation of the CmsContext object.
 * It solves the "Undefined Variable" issue by pulling globals into the object scope.
 * * @param array<string, mixed> $content  Added specific array types for Level 8
 * @param string $pageName
 * @return \CmsForNerd\CmsContext
 */
function createCmsContext(array $content, string $pageName): \CmsForNerd\CmsContext {
    global $themeName, $cssPath, $dataFile, $nonce;

    return new \CmsForNerd\CmsContext(
        content:    $content,
        themeName:  $themeName,
        cssPath:    $cssPath,
        dataFile:   $dataFile,
        scriptName: $pageName,
        cspNonce:   $nonce
    );
}

// Set CSP Header
header("Content-Security-Policy: script-src 'self' 'nonce-$nonce';");

// 5. [LAB] Initialization Phase
\CmsForNerd\boot_security();
$config = \CmsForNerd\get_runtime_config();

// 6. [LAB] Variable Extraction & Fallbacks
$themeName  = (string) ($config['THEMENAME']   ?? 'CmsForNerd');
$cssPath    = (string) ($config['CSSPATH']     ?? "themes/{$themeName}/css/");
$sitemapUrl = (string) ($config['sitemap_url'] ?? 'sitemap.php');

// 7. [LAB] Routing Preparation
$scriptName = basename($_SERVER['SCRIPT_NAME']);
$dataFile   = explode(".", $scriptName);

if (!class_exists('\\CmsForNerd\\CmsContext')) {
    error_log("Critical: CmsContext class not found.");
}
