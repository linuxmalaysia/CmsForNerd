<?php

declare(strict_types=1);

// [EDUCATIONAL] Lab Worksheet: Module 3 - Defensive Engineering & Path Traversal.
// It follows the "Pair Logic" system: Entry point is lab-module3.php, body is contents/lab-module3-body.inc.

ob_start("ob_gzhandler");
require_once __DIR__ . '/vendor/autoload.php';

$CONTENT['title'] = "Lab Worksheet: Module 3 - CmsForNerd v3.1";
$CONTENT['author'] = "CMSForNerd Team & Google Gemini";
$CONTENT['description'] = "Student Lab Worksheet for Module 3: Defensive Engineering & Path Traversal. Master allowlist-based sanitization and security testing.";
$CONTENT['keywords'] = "Security Lab, Module 3, Path Traversal, LFI, Sanitization, PHP 8.4";

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
