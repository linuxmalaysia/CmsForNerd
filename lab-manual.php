<?php

declare(strict_types=1);

// [EDUCATIONAL] Lab Manual - This page serves as a transparent laboratory for developers.
// It follows the "Pair Logic" system: Entry point is lab-manual.php, body is contents/lab-manual-body.inc.

ob_start("ob_gzhandler");
require_once __DIR__ . '/vendor/autoload.php';

$CONTENT['title'] = "The Developer’s Lab Manual: CMSForNerd v3.1";
$CONTENT['author'] = "CMSForNerd Team & Google Gemini";
$CONTENT['description'] = "Welcome to the v3.1 educational suite. This CMS is designed to be a transparent laboratory for learning modern PHP 8.4.";
$CONTENT['keywords'] = "Lab Manual, PHP 8.4, Education, Architecture, Security, TDD, PSR-12";

$CONTENT['data'] = basename($_SERVER['SCRIPT_NAME']);
$DATAFILE = explode(".", $CONTENT['data']);

include "includes/global-control.inc.php";
include "includes/common.inc.php";

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
