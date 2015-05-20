<?php

// This is the global control to all page
// CmsForNerd 
// Idea from drupal and xampp and some codes from them
// License GNU Public License V2
// Harisfazillah Jamel v 1.1 7 Feb 2006 linuxmalaysia @ gmail dot com
// Harisfazillah Jamel v 1.2 18 November 2007 linuxmalaysia @ gmail dot com
// For http://www.perempuanmelayu.info/
// For small site without database just pure php html xml code
// Remember all page call this and please check the local
// theme or lang overwrite

// lang selection
// To translate just copy into another file
// and then change below to read it.

include("lang/en.lang");

// Global themes selection
// To change theme just copy into another file
// and then change below to read it.
//$THEMENAME="blog";

$THEMENAME="CmsForNerd";

include("themes/$THEMENAME/theme.php");

?>
