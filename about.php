<?php

declare(strict_types=1); // [LAB] Enforces strict data typing for PHP 8.4.

/**
 * CmsForNerd - About Page
 * [LAB] Module 1: Demonstrating the Front Controller pattern and Context Injection.
 */

// [PERFORMANCE] Output buffering with GZIP compression.
if (!ob_start("ob_gzhandler")) {
    ob_start();
}

/**
 * [LAB] BOOTSTRAP PHASE
 * Loads the Autoloader, Security, and Configuration.
 */
require_once __DIR__ . '/includes/bootstrap.php';

// Example Copilot-friendly prompts (preserved for students):
// TODO-COPILOT: "Create a simple about page that includes the contents/about-body.inc
// file and uses the site's header and footer partials. Keep markup semantic."
// TODO-COPILOT: "Add a unit test that asserts the about page includes the phrase
// 'CmsForNerd' and that the contents/about-body.inc file exists."

/**
 * [SEO] Page-specific metadata.
 */
$content = [
    'title'       => "About CmsForNerd",
    'author'      => "Harisfazillah Jamel",
    'description' => "Learn about the architecture and history of the CmsForNerd project.",
    'keywords'    => "About, Architecture, PHP 8.4, Flat-file CMS",
];

/**
 * [LAB] DATA MAPPING
 * Determine the filename for content lookup (e.g., 'about').
 */
$pageName        = pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME);
$content['data'] = $pageName;

/**
 * [MODERN PHP] CmsContext Object
 * [LAB] We pass the state to the theme via this object instead of global variables.
 */
$ctx = new \CmsForNerd\CmsContext(
    content:    $content,
    themeName:  $themeName,
    cssPath:    $cssPath,
    dataFile:   $dataFile,
    scriptName: $pageName
);

/**
 * [SECURITY] Session Initialization
 */
session_start();

/**
 * [STRUCTURE] Theme Controller
 * Instead of calling pageheader() and pagetailer() manually, 
 * we delegate the entire rendering to the theme's pager.
 */
$pagerPath = __DIR__ . "/themes/{$ctx->themeName}/pager.php";
if (file_exists($pagerPath)) {
    include_once $pagerPath;
}

/**
 * [RENDER] Page Generation
 * The theme will automatically include 'contents/about-body.inc' 
 * based on the 'scriptName' provided in the context.
 */
if (function_exists('pager')) {
    pager($ctx);
}

// [PERFORMANCE] Flush output.
ob_end_flush();
