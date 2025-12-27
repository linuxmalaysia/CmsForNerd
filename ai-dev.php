<?php

/**
 * [ENTRY POINT] AI-Assisted Development Guide
 * This page teaches students how to use Gemini and Antigravity for CMS development.
 * REQUIRED: Pair Logic with contents/ai-dev-body.inc.
 */

declare(strict_types=1);

ob_start("ob_gzhandler");
require_once __DIR__ . '/vendor/autoload.php';

$CONTENT['title'] = "AI-Assisted Development | CMSForNerd laboratory";
$CONTENT['author'] = "CMSForNerd Team & Google Gemini";
$CONTENT['description'] = "Master the synergy between Google Gemini AI and Google Antigravity to build, refactor, and modernize your CMS.";

$CONTENT['data'] = basename($_SERVER['SCRIPT_NAME']);
$DATAFILE = explode(".", $CONTENT['data']);

require_once 'includes/global-control.inc.php';
require_once 'includes/common.inc.php';

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

