<?php

/**
 * [ENTRY POINT] CSP Nonce Implementation Guide
 * This page provides comprehensive documentation on implementing Content Security Policy nonces.
 * REQUIRED: Pair Logic with contents/csp-nonce-guide-body.inc.
 */

declare(strict_types=1);

ob_start("ob_gzhandler");
require_once __DIR__ . '/vendor/autoload.php';

$CONTENT['title'] = "CSP Nonce Implementation Guide | CMSForNerd Security";
$CONTENT['author'] = "CMSForNerd Security Team";
$CONTENT['description'] = "Complete guide to implementing Content Security Policy nonces for XSS protection in PHP 8.4.";
$CONTENT['keywords'] = "CSP, nonce, XSS, security, PHP 8.4, Content Security Policy";

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

