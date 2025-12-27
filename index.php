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

ob_start("ob_gzhandler");
require_once __DIR__ . '/vendor/autoload.php';

$CONTENT['title']="CmsForNerd A Content Management Software For Nerd";
$CONTENT['author']="LinuxMalaysia";
$CONTENT['description']="CmsForNerd is a content management software (CMS) for nerd.";
$CONTENT['keywords']="CmsForNerd, CMS, HTML, PHP";

// Ini untuk kalau masukkan ikut web browser
//$CONTENT['data']=basename($_SERVER['QUERY_STRING']);

//We read the script name

$CONTENT['data']=basename($_SERVER['SCRIPT_NAME']);


$DATAFILE = explode(".",$CONTENT['data']);


// Just in case
if (empty($CONTENT['data'])) {
$CONTENT['data']="empty";
}

// Security Hardening (PHP 8.4)
// Determine the raw page request
$rawPage = match(true) {
    !empty($_SERVER['QUERY_STRING']) => $_SERVER['QUERY_STRING'],
    default => basename($_SERVER['SCRIPT_NAME'])
};

// Sanitize: Allow only alphanumeric, hyphen, underscore
$page = CmsForNerd\SecurityUtils::isValidPageName($rawPage) 
    ? $rawPage 
    : 'index.php'; // Fallback to safe default

// Remove extension if present for consistent processing
$page = pathinfo($page, PATHINFO_FILENAME);

$CONTENT['data'] = $page;

include("includes/global-control.inc.php");
include("includes/common.inc.php");

// Initialize Context
$ctx = new CmsForNerd\CmsContext(
    content: $CONTENT,
    themeName: $THEMENAME,
    cssPath: $CSSPATH, // Defined in theme.php via global-control
    dataFile: $DATAFILE,
    scriptName: $CONTENT['data']
);

// Start the session with a timeout of 30 minutes (in seconds)
ini_set('session.gc_maxlifetime', '1800');
session_start();

// Set the session creation time (optional for approach 2)
$_SESSION['session_start_time'] = time(); // Uncomment for approach 2

// Set a session variable to indicate a valid session
$_SESSION['valid_session'] = true;


// Define all the function needed call from theme

include "themes/{$ctx->themeName}/pager.php";

//function define in theme diretory theme.php
//to change theme.php for page layout

// Include the function to detect bots (assuming it's a valid file)
require_once('includes/is_bot.php');

// Check if the request is from a bot using the included function
if (is_bot()) {
  // Set content type as plain text for bots
  header('Content-Type: text/plain');
  
  echo "This is a page specifically for search engine crawlers.\n";
  
  // Additional information for indexing (e.g., sitemap URL)
  echo "Sitemap: https://www.linuxmalaysia.com/xml-sitemap.php\n";
  
  // Log bot visit (assuming you have a logging mechanism)
  // ... (code to log visit details)
 // need to exit
 exit;
}

// Security: Cloudflare Turnstile Check (For POST requests)
require_once('includes/turnstile.php');

pager($ctx);

// Check if the user submitted a logout request (optional)
if (isset($_GET['logout'])) {
  // User requested logout, destroy session and redirect
  session_destroy();
  header('Location: index.php');
  exit;
}

ob_end_flush();

?>
