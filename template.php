<?php

declare(strict_types=1);

// [BOILERPLATE] template.php - The base foundation for all Nerd-Stack pages.
//
// HOW TO USE:
// 1. Copy this file to a new name (e.g., about.php).
// 2. Create a corresponding content file (e.g., contents/about-body.inc).
// 3. Customize the metadata in the $CONTENT array below.
//
// RFC 2119: You MUST NOT modify the core logic here unless you are a "Theme Engineer".

ob_start("ob_gzhandler");
require_once __DIR__ . '/vendor/autoload.php';

$CONTENT['title']="Template Page For CmsForNerd";
$CONTENT['author']="CMSForNerd";
$CONTENT['description']="This is a template page for CmsForNerd. A Content Management Software like no others.";
$CONTENT['keywords']="CmsForNerd, CMS, PHP, CSS, Malaysia, HTML";

// Ini untuk kalau masukkan ikut web browser
//$CONTENT['data']=basename($_SERVER['QUERY_STRING']);

//We read the script name

$CONTENT['data']=basename($_SERVER['SCRIPT_NAME']);


$DATAFILE = explode(".",$CONTENT['data']);


// Just in case
if (empty($CONTENT['data'])) {
$CONTENT['data']="empty";
}


include("includes/global-control.inc.php");
include("includes/common.inc.php");

// Initialize Context
$ctx = new CmsForNerd\CmsContext(
    content: $CONTENT,
    themeName: $THEMENAME,
    cssPath: $CSSPATH,
    dataFile: $DATAFILE,
    scriptName: $CONTENT['data']
);

// Define all the function needed call from theme

include "themes/{$ctx->themeName}/pager.php";

//function define in theme diretory theme.php
//to change theme.php for page layout

// Security: Cloudflare Turnstile Check
require_once('includes/turnstile.php');

pager($ctx);

ob_end_flush();

?>

