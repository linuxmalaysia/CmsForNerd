<?php

declare(strict_types=1);

// [EDUCATIONAL] Lab Worksheet: Module 4 - Automated Testing with PHPUnit 11.
// It follows the "Pair Logic" system: Entry point is lab-module4.php, body is contents/lab-module4-body.inc.

ob_start("ob_gzhandler");
require_once __DIR__ . '/vendor/autoload.php';

$CONTENT['title'] = "Lab Worksheet: Module 4 - CmsForNerd v3.1";
$CONTENT['author'] = "CMSForNerd Team & Google Gemini";
$CONTENT['description'] = "Student Lab Worksheet for Module 4: Automated Testing with PHPUnit 11. Master Arrange-Act-Assert and TDD fundamentals.";
$CONTENT['keywords'] = "Testing Lab, Module 4, PHPUnit, TDD, AAA Pattern, Security Testing";

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

