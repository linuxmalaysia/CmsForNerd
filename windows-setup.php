<?php

declare(strict_types=1);

// [EDUCATIONAL] Windows 11 Setup Guide: The Future-Proof Toolchain.
// It follows the "Pair Logic" system: Entry point is windows-setup.php, body is contents/windows-setup-body.inc.

ob_start("ob_gzhandler");
require_once __DIR__ . '/vendor/autoload.php';

$CONTENT['title'] = "Windows 11 Setup Guide: PHP 8.4+ & PHP 9 Ready - CMSForNerd v3.1";
$CONTENT['author'] = "CMSForNerd Team & Google Gemini";
$CONTENT['description'] = "Learn how to set up a professional, future-proof PHP 8.4 development environment on Windows 11 for CMSForNerd.";
$CONTENT['keywords'] = "Windows 11, Setup Guide, PHP 8.4, PHP 9, Laravel Herd, Git, Antigravity, Composer";

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
