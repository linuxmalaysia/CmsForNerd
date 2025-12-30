<?php

declare(strict_types=1);

/**
 * [ENTRY POINT] About CMSForNerd
 * Role: Mission statement and project philosophy.
 * Architecture: Pair Logic (about.php + contents/about-body.inc)
 */

// 1. [PERFORMANCE] Enable GZIP Compression
if (!ob_start("ob_gzhandler")) {
    ob_start();
}

/**
 * 2. [LAB] BOOTSTRAP PHASE
 * Loading bootstrap.php ensures the v3.3 runtime is active.
 */
require_once __DIR__ . '/includes/bootstrap.php';

// 3. [SEO/AI] Metadata
$content = [
    'title'       => "About CMSForNerd | The Human-AI Project",
    'author'      => "CMSForNerd Team & Google Gemini",
    'description' => "Discover the philosophy behind CMSForNerd: A project dedicated to educational empowerment through radical simplicity.",
    'keywords'    => "Open Source, Philosophy, PHP 8.4, Education, LinuxMalaysia, Google Gemini",
    'schemaType'  => "AboutPage"
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
}

ob_end_flush();
