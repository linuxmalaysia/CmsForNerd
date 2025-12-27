<?php

declare(strict_types=1);

// [EDUCATIONAL] Final Exam Answer Key: Instructor Resource.
// It follows the "Pair Logic" system: Entry point is exam-answers.php, body is contents/exam-answers-body.inc.

ob_start("ob_gzhandler");
require_once __DIR__ . '/vendor/autoload.php';

$CONTENT['title'] = "Official Answer Key: Final Exam - CMSForNerd v3.1";
$CONTENT['author'] = "CMSForNerd Team & Google Gemini";
$CONTENT['description'] = "The Official Answer Key and Grading Rubric for the CMSForNerd v3.1 Final Exam.";
$CONTENT['keywords'] = "Answer Key, Final Exam, Instructor Resource, PHP 8.4+, Grading Rubric";

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
