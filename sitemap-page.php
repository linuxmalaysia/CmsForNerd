<?php

declare(strict_types=1);

/**
 * CmsForNerd - Sitemap Page
 * Purpose: Scans content and displays the site structure.
 * Rebuilt for PHP 8.4 Standards.
 */

// 1. [PERFORMANCE] Enable GZIP compression
if (!ob_start("ob_gzhandler")) {
    ob_start();
}

/**
 * 2. [LAB] BOOTSTRAP PHASE
 * This core file initializes the Autoloader and global variables
 * like $themeName, $cssPath, and $dataFile.
 */
require_once __DIR__ . '/includes/bootstrap.php';

// 3. [SEO] Page Metadata
$content = [
    'title'       => "Sitemap For CmsForNerd",
    'author'      => "Harisfazillah Jamel",
    'description' => "HTML Sitemap for CmsForNerd - A lightweight, flat-file content management software.",
    'keywords'    => "CmsForNerd, CMS, Sitemap, PHP 8.4, HTML5",
];

/**
 * 4. [SECURITY] Session Management
 * Modern check for session expiration.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['valid_session']) && $_SESSION['valid_session'] === true) {
    $elapsed_time = time() - ($_SESSION['session_start_time'] ?? time());
    $session_timeout = (int)ini_get('session.gc_maxlifetime');
    
    if ($elapsed_time > $session_timeout) {
        session_destroy();
        header('Location: index.php');
        exit;
    }
}

/**
 * 5. [MODERN PHP] CmsContext Object
 * scriptName uses pathinfo to match the "sitemap-page-body.inc" naming convention.
 */
$ctx = new \CmsForNerd\CmsContext(
    content:    $content,
    themeName:  $themeName,
    cssPath:    $cssPath,
    dataFile:   $dataFile,
    scriptName: pathinfo(basename(__FILE__), PATHINFO_FILENAME)
);

/**
 * 6. [SECURITY] Cloudflare Turnstile integration.
 */
if (file_exists(__DIR__ . '/includes/turnstile.php')) {
    require_once __DIR__ . '/includes/turnstile.php';
}

/**
 * 7. [RENDER] Theme Execution
 */
$pagerPath = __DIR__ . "/themes/{$ctx->themeName}/pager.php";

if (file_exists($pagerPath)) {
    include_once $pagerPath;
    pager($ctx);
}

// 8. [PERFORMANCE] Flush output.
ob_end_flush();
