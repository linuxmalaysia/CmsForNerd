<?php

declare(strict_types=1);

// [PEFORMANCE] output buffering (ob_gzhandler) RECOMMENDED to compress pages.
ob_start("ob_gzhandler");

// [MODERN PHP] Composer Autoloader - REQUIRED for modern dependency management.
require_once __DIR__ . '/vendor/autoload.php';

$CONTENT['title'] = "Installation Of CmsForNerd A Content Management Software For Nerd";
$CONTENT['author'] = "CMSForNerd";
$CONTENT['description'] = "Installation guide for CmsForNerd a content management software (CMS) for nerd.";
$CONTENT['keywords'] = "CmsForNerd, CMS, HTML, PHP";

// [ROUTING] determine which file to load
$CONTENT['data'] = basename($_SERVER['SCRIPT_NAME']);
$DATAFILE = explode(".", $CONTENT['data']);

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

// [STRUCTURE] Load the theme's controller
include "themes/{$ctx->themeName}/pager.php";

// [SECURITY] Cloudflare Turnstile - Bot protection MUST be verified for POST requests.
require_once 'includes/turnstile.php';

// [RENDER] Main entry point MUST call pager().
pager($ctx);

// [PERFORMANCE] Release the buffer
ob_end_flush();

