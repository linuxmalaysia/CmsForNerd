<?php

/**
 * [ENTRY POINT] Linux Setup Guide
 * This page serves as a technical walkthrough for setting up a PHP 8.4+ 
 * environment on Debian and AlmaLinux.
 * 
 * MUST: Adhere to PSR-12 and RFC 2119.
 * REQUIRED: Use CmsContext for layout.
 */

ob_start("ob_gzhandler");
require_once __DIR__ . '/vendor/autoload.php';

$CONTENT['title'] = 'Linux Setup Guide (PHP 8.4+) | CMSForNerd Lab';
$CONTENT['author'] = "CMSForNerd Team & Google Gemini";
$CONTENT['description'] = "Ensuring PHP 8.4+ Compatibility on Debian, Ubuntu LTS & AlmaLinux.";
$CONTENT['data'] = basename($_SERVER['SCRIPT_NAME']);
$DATAFILE = explode(".", $CONTENT['data']);

require_once 'includes/global-control.inc.php';
require_once 'includes/common.inc.php';

// [INIT] Initialize CMS Context
$ctx = new CmsForNerd\CmsContext(
    content: $CONTENT,
    themeName: $THEMENAME,
    cssPath: $CSSPATH,
    dataFile: $DATAFILE,
    scriptName: $CONTENT['data']
);

include "themes/{$ctx->themeName}/pager.php";

// Security: Cloudflare Turnstile Check
require_once 'includes/turnstile.php';

pager($ctx);

ob_end_flush();

