<?php

declare(strict_types=1);

// [EDUCATIONAL] Lab Graduation Page: Certificate of Completion.
// It follows the "Pair Logic" system: Entry point is graduation.php, body is contents/graduation-body.inc.

ob_start("ob_gzhandler");
require_once __DIR__ . '/vendor/autoload.php';

$CONTENT['title'] = "Graduation: PHP 8.4+ & PHP 9 Modernization - CmsForNerd v3.1";
$CONTENT['author'] = "CMSForNerd Team & Google Gemini";
$CONTENT['description'] = "Celebrate your success! Verify your mastery of PHP 8.4 Architecture, Security, Standards, and Testing.";
$CONTENT['keywords'] = "Graduation, Certificate, PHP 8.4, Modernization, Mastery, CmsForNerd";

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

