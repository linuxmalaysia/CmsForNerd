<?php

declare(strict_types=1);

// [EDUCATIONAL] Student Welcome Kit: The Essential "Cheat Sheet".
// It follows the "Pair Logic" system: Entry point is welcome-kit.php, body is contents/welcome-kit-body.inc.

ob_start("ob_gzhandler");
require_once __DIR__ . '/vendor/autoload.php';

$CONTENT['title'] = "Student Welcome Kit: Essential Cheat Sheet - CMSForNerd v3.1";
$CONTENT['author'] = "CMSForNerd Team & Google Gemini";
$CONTENT['description'] = "The one-stop reference guide for every student entering the CmsForNerd v3.1 Laboratory.";
$CONTENT['keywords'] = "Welcome Kit, Cheat Sheet, Student Guide, PHP 8.4+, RFC 2119, PSR-12, Security";

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

