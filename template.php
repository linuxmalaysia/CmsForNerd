<?php

declare(strict_types=1);

/**
 * [BOILERPLATE] template.php - The base foundation for all Nerd-Stack pages.
 * * HOW TO USE:
 * 1. Copy this file to a new name (e.g., about.php).
 * 2. Create a corresponding content file (e.g., contents/about-body.inc).
 * 3. Customize the metadata in the $content array below.
 */

// 1. [PERFORMANCE] Enable GZIP compression
if (!ob_start("ob_gzhandler")) {
    ob_start();
}

/**
 * 2. [LAB] BOOTSTRAP PHASE
 * This core file initializes the Autoloader, Global Config, 
 * and extracts $themeName and $cssPath for us.
 */
require_once __DIR__ . '/includes/bootstrap.php';

// 3. [SEO] Metadata - Customize these for every new page.
$content = [
    'title'       => "Template Page For CmsForNerd",
    'author'      => "CMSForNerd",
    'description' => "This is a template page for CmsForNerd. A Content Management Software like no others.",
    'keywords'    => "CmsForNerd, CMS, PHP, CSS, Malaysia, HTML",
];

/**
 * 4. [LAB] ROUTING LOGIC
 * Extracts the filename without extension to match the content partial.
 */
$pageName = pathinfo(basename(__FILE__), PATHINFO_FILENAME);

// 5. [MODERN PHP] Initialize Context Object
$ctx = new \CmsForNerd\CmsContext(
    content:    $content,
    themeName:  $themeName,
    cssPath:    $cssPath,
    dataFile:   $dataFile, // Provided by bootstrap.php
    scriptName: $pageName
);

// 6. [SECURITY] Cloudflare Turnstile & Session
session_start();
if (file_exists(__DIR__ . '/includes/turnstile.php')) {
    require_once __DIR__ . '/includes/turnstile.php';
}

/**
 * 7. [RENDER] Theme Execution
 * Loads the pager() function from the active theme.
 */
$pagerPath = __DIR__ . "/themes/{$ctx->themeName}/pager.php";

if (file_exists($pagerPath)) {
    include_once $pagerPath;
    pager($ctx);
}

// 8. [PERFORMANCE] Send output to browser
ob_end_flush();
