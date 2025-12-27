<?php

/**
 * [ENTRY POINT] SOP: Ethical AI Integration
 * This page provides the Standard Operating Procedure for responsible AI usage in the laboratory.
 * REQUIRED: Pair Logic with contents/ai-sop-body.inc.
 */

declare(strict_types=1);

ob_start("ob_gzhandler");
require_once __DIR__ . '/vendor/autoload.php';

$CONTENT['title'] = "SOP: Ethical AI Integration | CMSForNerd Laboratory";
$CONTENT['author'] = "CMSForNerd Team & Google Gemini";
$CONTENT['description'] = "Standard Operating Procedure for responsible AI usage in the developer's laboratory.";

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
