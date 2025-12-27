<?php

declare(strict_types=1);

// [PEFORMANCE] output buffering (ob_gzhandler) RECOMMENDED to compress pages.
ob_start("ob_gzhandler");

// [MODERN PHP] Composer Autoloader - REQUIRED for modern dependency management.
require_once __DIR__ . '/vendor/autoload.php';

// [SEO] Metadata - These help search engines understand what your site is about.
$CONTENT['title'] = "CmsForNerd A Content Management Software For Nerd";
$CONTENT['author'] = "LinuxMalaysia";
$CONTENT['description'] = "CmsForNerd is a content management software (CMS) for nerd.";
$CONTENT['keywords'] = "CmsForNerd, CMS, HTML, PHP";

// [ROUTING] determine which file to load
$CONTENT['data'] = basename($_SERVER['SCRIPT_NAME']);
$DATAFILE = explode(".", $CONTENT['data']);

// [SECURITY] Input Sanitization - MUST be performed to prevent Directory Traversal attacks.
$rawPage = match (true) {
    !empty($_SERVER['QUERY_STRING']) => $_SERVER['QUERY_STRING'],
    default => basename($_SERVER['SCRIPT_NAME'])
};

// [SECURITY] Page names MUST be validated strictly.
$page = CmsForNerd\SecurityUtils::isValidPageName($rawPage)
    ? $rawPage
    : 'index';

// Remove extension if present to simplify internal lookups
$page = pathinfo($page, PATHINFO_FILENAME);
$CONTENT['data'] = $page;

// [STRUCTURE] Include global settings and core functions
include "includes/global-control.inc.php";
include "includes/common.inc.php";

// [MODERN PHP] CmsContext - State management MUST use this object.
$ctx = new CmsForNerd\CmsContext(
    content: $CONTENT,
    themeName: $THEMENAME,
    cssPath: $CSSPATH,
    dataFile: $DATAFILE,
    scriptName: $CONTENT['data']
);

// [SECURITY] Session Management - RECOMMENDED to set a reasonable timeout.
ini_set('session.gc_maxlifetime', '1800'); // 30 minutes
session_start();
$_SESSION['session_start_time'] = time();
$_SESSION['valid_session'] = true;

// [STRUCTURE] Load the theme's controller
include "themes/{$ctx->themeName}/pager.php";

// [SECURITY/SEO] Bot Detection - SHOULD be used to optimize indexing.
require_once 'includes/is_bot.php';

if (is_bot()) {
    header('Content-Type: text/plain');
    echo "Welcome bot! This is a optimized text view for indexing.\n";
    echo "Sitemap: https://www.linuxmalaysia.com/sitemap.php\n";
    exit;
}

// [SECURITY] Cloudflare Turnstile - Bot protection MUST be verified for POST requests.
require_once 'includes/turnstile.php';

// [RENDER] Main entry point MUST call pager().
pager($ctx);

// [LOGIC] Optional logout handling
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

// [PERFORMANCE] Release the buffer
ob_end_flush();

