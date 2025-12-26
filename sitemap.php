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
// http://cmsfornerd.harisfazillah.info/
// For small site without database just pure php html xml code
// Remember all page copy this and please check the local
// theme or lang overwrite

// The only thing need to change is the Title

// The contents of the page will be in contents/
// and with name ???-body.inc

ob_start("ob_gzhandler");

// Check for session timeout and close session on other pages (within the PHP code)

// Option 1: Using session_gc_maxlifetime (uncomment if using this approach)
// if (!isset($_SESSION['valid_session']) || $_SESSION['valid_session'] !== true) {
  // Session timed out or doesn't exist, redirect to login
//   header('Location: index.php');
//   exit;
// }

// Option 2: Using session expiration time (uncomment if using this approach)
if (isset($_SESSION['valid_session']) && $_SESSION['valid_session'] === true) {
  $elapsed_time = time() - $_SESSION['session_start_time'];
  $session_timeout = 1800; // 30 minutes
  
  if ($elapsed_time > $session_timeout) {
    // Session timed out, destroy it and redirect
    session_destroy();
    header('Location: index.php');
    exit;
  }
}


$CONTENT['title']="Sitemap For CmsForNerd A Content Management Software For Nerd";
$CONTENT['author']="Wanita";
$CONTENT['description']="Sitemap for CmsForNerd a content management software (CMS) for nerd.";
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


include("includes/global-control.inc.php");
require_once("includes/CmsContext.php");
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

include("themes/$THEMENAME/pager.php");

//function define in theme diretory theme.php
//to change theme.php for page layout

// Security: Cloudflare Turnstile Check
require_once('includes/turnstile.php');

pager($ctx);

ob_end_flush();

?>
