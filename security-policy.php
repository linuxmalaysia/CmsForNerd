<?php

/**
 * [ENTRY POINT] Security Policy
 * This page defines the formal vulnerability disclosure protocol for the CMS.
 * REQUIRED: Pair Logic with contents/security-policy-body.inc.
 */

declare(strict_types=1);

ob_start("ob_gzhandler");
require_once __DIR__ . '/vendor/autoload.php';

$CONTENT['title'] = "Security Policy & Disclosure | CMSForNerd Laboratory";
$CONTENT['author'] = "CMSForNerd Team & Google Gemini";
$CONTENT['description'] = "The human-readable security policy for responsible disclosure and ethical vulnerability reporting.";

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

