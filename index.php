<?php

// This is the script that give the file name without extension .php
// and pass it to others.


// CmsForNerd 
// Idea from drupal and xampp and some codes from them
// License GNU Public License V2
// Harisfazillah Jamel v 1.1 7 Feb 2006 linuxmalaysia @ gmail dot com
// Harisfazillah Jamel v 1.2 18 November 2007 linuxmalaysia @ gmail dot com
// Harisfazillah Jamel v 2.0 22 April 2023
// Harisfazillah Jamel v 2.1 10 mac 2024
// Harisfazillah Jamel v 3.1 27 Dec 2025
// With the help of Google Gemini
//
// FILE PURPOSE:
// Main Entry Point. This file:
// 1. Sanitizes user input (directory traversal protection).
// 2. Initializes the CmsContext state object.
// 3. Routes the request to the correct content file.
// 4. Initiates the theme rendering system via pager().
// For small site without database just pure php html xml code
// Remember all page copy this and please check the local
// theme or lang overwrite

// The only thing need to change is the Title

// The contents of the page will be in contents/
// and with name ???-body.inc

// [PEFORMANCE] output buffering (ob_gzhandler) compresses your page for faster loading.
// It also prevents "headers already sent" errors when calling session_start() or header().
ob_start("ob_gzhandler");

// [MODERN PHP] Composer Autoloader - Automatically loads our classes from /includes
require_once __DIR__ . '/vendor/autoload.php';

// [SEO] Metadata - These help search engines understand what your site is about.
$CONTENT['title']="CmsForNerd A Content Management Software For Nerd";
$CONTENT['author']="LinuxMalaysia";
$CONTENT['description']="CmsForNerd is a content management software (CMS) for nerd.";
$CONTENT['keywords']="CmsForNerd, CMS, HTML, PHP";

// [ROUTING] determine which file to load
$CONTENT['data']=basename($_SERVER['SCRIPT_NAME']);
$DATAFILE = explode(".",$CONTENT['data']);

// [SECURITY] Input Sanitization (PHP 8.4 Match Expression)
// We only allow safe characters to prevent Directory Traversal attacks.
$rawPage = match(true) {
    !empty($_SERVER['QUERY_STRING']) => $_SERVER['QUERY_STRING'], // User-provided query
    default => basename($_SERVER['SCRIPT_NAME']) // Fallback to current script
};

// [SECURITY] We use a dedicated SecurityUtils class to validate names strictly.
$page = CmsForNerd\SecurityUtils::isValidPageName($rawPage) 
    ? $rawPage 
    : 'index'; // If unsafe, force back to index

// Remove extension if present to simplify internal lookups
$page = pathinfo($page, PATHINFO_FILENAME);
$CONTENT['data'] = $page;

// [STRUCTURE] Include global settings and core functions
include("includes/global-control.inc.php");
include("includes/common.inc.php");

// [MODERN PHP] CmsContext - An object-oriented way to pass site state.
// This replaces old 'global $variables' which are harder to track.
$ctx = new CmsForNerd\CmsContext(
    content: $CONTENT,
    themeName: $THEMENAME,
    cssPath: $CSSPATH,
    dataFile: $DATAFILE,
    scriptName: $CONTENT['data']
);

// [SECURITY] Session Management - Protects against session hijacking with a timeout.
ini_set('session.gc_maxlifetime', '1800'); // 30 minutes
session_start();
$_SESSION['session_start_time'] = time();
$_SESSION['valid_session'] = true;

// [STRUCTURE] Load the theme's controller
include "themes/{$ctx->themeName}/pager.php";

// [SECURITY/SEO] Bot Detection
// We handle bots differently to save resources or provide specific indexing signals.
require_once('includes/is_bot.php');

if (is_bot()) {
  header('Content-Type: text/plain');
  echo "Welcome bot! This is a optimized text view for indexing.\n";
  echo "Sitemap: https://www.linuxmalaysia.com/sitemap.php\n";
  exit;
}

// [SECURITY] Cloudflare Turnstile - Invisible bot protection for forms
require_once('includes/turnstile.php');

// [RENDER] The main function that builds your page!
pager($ctx);

// [LOGIC] Optional logout handling
if (isset($_GET['logout'])) {
  session_destroy();
  header('Location: index.php');
  exit;
}

// [PERFORMANCE] Release the buffer and send content to the browser
ob_end_flush();

?>
