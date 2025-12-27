<?php

// This is the common functions to all page
// CmsForNerd 
// Idea from drupal and xampp and some codes from them
// License GNU Public License V2
// Harisfazillah Jamel v 1.1 7 Feb 2006 linuxmalaysia @ gmail dot com
// Harisfazillah Jamel v 1.2 18 November 2007 linuxmalaysia @ gmail dot com
// Harisfazillah Jamel v 3.1 27 Dec 2025
// With the help of Google Gemini
//
// FILE PURPOSE:
// Core Display Functions. This file:
// 1. Defines pageheader(), pagecontent(), and pagetailer().
// 2. Generates the standard <head> HTML tags.
// 3. Loads the dynamic content based on the CmsContext.
// For https://www.linuxmalaysia.com
// For small site without database just pure php html xml code
// Remember all page call this and please check the local
// theme or lang overwrite

// Call the content from the content object. Check the file type

function pageheader(CmsForNerd\CmsContext $ctx)
{



// HTML5 define
print("<!DOCTYPE html>\n");
print("<html lang=\"en\">");

print("<head>");

// start common tags for CmsForNerd
include ("contents/common-headertag.inc");
// end common tags for CmsForNerd

print("<title>".$ctx->content['title']."</title>");
print("<style type=\"text/css\" media=\"all\">@import \"$ctx->cssPath\";</style>");

// Cloudflare Turnstile Script
print('<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>');

print("</head>");


}

function pagecontent(CmsForNerd\CmsContext $ctx)

{

include ("contents/".$ctx->dataFile['0']."-body.inc");

// testing not working. let it be.
//print($CONTENT['data']);
//echo "".$CONTENT['data']."";
//unset($CONTENT['data']);
//print("ujian ".$CONTENT['data']."aje");

}

function pagetailer(CmsForNerd\CmsContext $ctx)

{

print("</html>");

}

?>
