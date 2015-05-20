<?php

// This is the page control that show page
// Remember it must in the theme directory
// Check the global control and this file
// is include in every PHP start page.

// The hardcode layout is here.
// Any layout change please do it here. It will
// impact the whole global layout

// at least this three functions and body tag
// print("<body>");
// pageheader();
// pagebody();
// pagetailer();
// print("</body>");

// CmsForNerd 
// Idea from drupal and xampp and some codes from them
// License GNU Public License V2
// Harisfazillah Jamel v 1.1 7 Feb 2006 linuxmalaysia @ gmail dot com
// Harisfazillah Jamel v 1.2 18 November 2007 linuxmalaysia @ gmail dot com
// For http://www.perempuanmelayu.info/
// For small site without database just pure php html xml code
// Remember this include in start page and please check the local
// $THEMENAME declare in includes/global-control.inc.php

// Tipswanita blog template

function pager()

{

global $THEMENAME;

pageheader(); //must have

// Just an example for more option in body tag
// print("<body onload=\"javascript:hasIE_hideAndShow();\">"); //must have

print("<body>"); //must have

include("themes/$THEMENAME/bodytop.tpl");


pagecontent(); //must have


include("themes/$THEMENAME/bodyfooter.tpl");

print("</body>"); //must have

pagetailer(); // must have

}
