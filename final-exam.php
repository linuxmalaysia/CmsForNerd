<?php

declare(strict_types=1);

// [EDUCATIONAL] Final Exam: The Break-Fix Challenge.
// It follows the "Pair Logic" system: Entry point is final-exam.php, body is contents/final-exam-body.inc.

ob_start("ob_gzhandler");
require_once __DIR__ . '/vendor/autoload.php';

$CONTENT['title'] = "Final Exam: Break-Fix Challenge - CMSForNerd v3.1";
$CONTENT['author'] = "CMSForNerd Team & Google Gemini";
$CONTENT['description'] = "The Final Certification Exam for CMSForNerd v3.1. Repair 5 deliberate errors to prove your mastery of modern PHP.";
$CONTENT['keywords'] = "Final Exam, Certification, PHP 8.4+, Break-Fix, Security, PSR-12, TDD";

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
