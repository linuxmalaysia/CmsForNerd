<?php

declare(strict_types=1);

/**
 * CmsForNerd - Centralized Bootstrap (Laboratory Engine v3.3)
 *
 * This file handles the transition from pure declarations to execution logic.
 * It is the core of the Module 1 and Module 4 Laboratory exercises.
 *
 * Compliance: PHP 8.4+, PSR-12, Hybrid Structure
 */

// 1. [LAB] Load the Composer Autoloader
// This handles PSR-4 loading for CmsForNerd classes in both includes/ and src/
require_once dirname(__DIR__) . '/vendor/autoload.php';

// 2. [LAB] Load Function Declarations
// PSR-1 compliance: These files SHOULD contain functions, no "side effects".
require_once __DIR__ . '/global-control.inc.php';
require_once __DIR__ . '/common.inc.php';

/**
 * 3. [LAB] Initialization Phase
 * Execution of namespaced security and configuration functions.
 */
\CmsForNerd\boot_security();
$config = \CmsForNerd\get_runtime_config();

/**
 * 4. [LAB] Variable Extraction & Fallbacks
 * Module 4 Exercise: The Null Coalescing Operator (??)
 * This ensures that even if the theme config fails, the CMS has default values.
 */
$themeName  = $config['THEMENAME']   ?? 'CmsForNerd';
$cssPath    = $config['CSSPATH']     ?? "themes/{$themeName}/css/";
$sitemapUrl = $config['sitemap_url'] ?? 'sitemap.php';

/**
 * 5. [LAB] Routing Preparation
 * Extracts the filename for use in the CmsContext object.
 */
$scriptName = basename($_SERVER['SCRIPT_NAME']);
$dataFile   = explode(".", $scriptName);

/**
 * 6. [LAB] Hybrid Namespace Verification
 * We check if our new CmsContext is available via the autoloader.
 */
if (!class_exists('\\CmsForNerd\\CmsContext')) {
    error_log("Critical: CmsContext class not found. Check src/ and composer.json.");
}
