<?php

declare(strict_types=1);

/**
 * [BOILERPLATE] template.php - Nerd-Stack v3.3 Foundation
 *
 * HOW TO USE:
 * 1. Copy this file to a new name (e.g., search.php).
 * 2. Create a content file inside contents/ (e.g., contents/search-body.inc).
 * 3. In the .inc file, ONLY write the HTML that goes inside the <body> tag.
 *
 * Compliance: PHP 8.4+, PSR-12, Hybrid Arch.
 */

// 1. [PERFORMANCE] Enable GZIP compression
if (!ob_start("ob_gzhandler")) {
    ob_start();
}

/**
 * 2. [LAB] BOOTSTRAP PHASE
 * Initializes the Autoloader and Global Configuration.
 */
require_once __DIR__ . '/includes/bootstrap.php';

// 3. [SEO] Metadata - Customize these for every new page.
$content = [
    'title'       => "New Page | CmsForNerd",
    'author'      => "Harisfazillah Jamel",
    'description' => "Content page using the -body.inc partial system.",
    'keywords'    => "CmsForNerd, PHP 8.4, Static CMS, Nerd-Stack",
];

/**
 * 4. [LAB] ROUTING LOGIC (Body-Partial Rule)
 * Rule: If file is 'search.php', $pageName becomes 'search-body'.
 * The theme engine will then load 'contents/search-body.inc'.
 */
$baseName = pathinfo(basename(__FILE__), PATHINFO_FILENAME);
$pageName = "{$baseName}-body";
$content['data'] = $pageName;

// 5. [SECURITY] Session & Bot Hardening
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (file_exists(__DIR__ . '/includes/turnstile.php')) {
    require_once __DIR__ . '/includes/turnstile.php';
}

/**
 * 6. [MODERN PHP] Initialize Context Object (from src/CmsContext.php)
 */
$ctx = new \CmsForNerd\CmsContext(
    content:    $content,
    themeName:  $themeName,
    cssPath:    $cssPath,
    dataFile:   $dataFile,
    scriptName: $pageName
);

/**
 * 7. [RENDER] Theme Execution
 */
$pagerPath = __DIR__ . "/themes/{$ctx->themeName}/pager.php";

if (file_exists($pagerPath)) {
    require_once $pagerPath;
    pager($ctx);
} else {
    header('HTTP/1.1 500 Internal Server Error');
    echo "Fatal Error: Theme engine (pager.php) missing.";
}

// 8. [PERFORMANCE] Send output to browser
ob_end_flush();
