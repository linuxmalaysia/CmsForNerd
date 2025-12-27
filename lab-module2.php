<?php

declare(strict_types=1);

// [EDUCATIONAL] Lab Worksheet: Module 2 - PSR-12 and the Art of Clean Code.
// It follows the "Pair Logic" system: Entry point is lab-module2.php, body is contents/lab-module2-body.inc.

ob_start("ob_gzhandler");
require_once __DIR__ . '/vendor/autoload.php';

$CONTENT['title'] = "Lab Worksheet: Module 2 - CmsForNerd v3.1";
$CONTENT['author'] = "CMSForNerd Team & Google Gemini";
$CONTENT['description'] = "Student Lab Worksheet for Module 2: PSR-12 and the Art of Clean Code. Master automated style audits and manual recognition of messy code.";
$CONTENT['keywords'] = "Clean Code, Module 2, PSR-12, Linting, PHPCBF, PHPCS, Standards";

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

