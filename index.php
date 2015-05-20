<?php

// This is the script that give the file name without extension .php
// and pass it to others.


// CmsForNerd 
// Idea from drupal and xampp and some codes from them
// License GNU Public License V2
// Harisfazillah Jamel v 1.1 7 Feb 2006 linuxmalaysia @ gmail dot com
// Harisfazillah Jamel v 1.2 18 November 2007 linuxmalaysia @ gmail dot com
// For http://cmsfornerd.perempuanmelayu.info/
// http://cmsfornerd.harisfazillah.info/
// For small site without database just pure php html xml code
// Remember all page copy this and please check the local
// theme or lang overwrite

// The only thing need to change is the Title

// The contents of the page will be in contents/
// and with name ???-body.inc

ob_start("ob_gzhandler");

$CONTENT['title']="CmsForNerd A Content Management Software For Nerd";
$CONTENT['author']="Wanita";
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


include("includes/global-control.inc.php");
include("includes/common.inc.php");

// Define all the function needed call from theme

include("themes/$THEMENAME/pager.php");

//function define in theme diretory theme.php
//to change theme.php for page layout

pager();

ob_end_flush();

?>