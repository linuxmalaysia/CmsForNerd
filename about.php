<?php

declare(strict_types=1);

// Minimal example page demonstrating the "Pair Logic" pattern.
ob_start("ob_gzhandler");
require_once __DIR__ . '/vendor/autoload.php';

$CONTENT['title'] = "About CMSForNerd";
$CONTENT['author'] = "CMSForNerd Team";
$CONTENT['description'] = "About page example for the CMSForNerd documentation.";

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

require_once 'includes/turnstile.php';

pager($ctx);

ob_end_flush();

