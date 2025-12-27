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

// [SEO/HTML5] pageheader() builds the top part of every HTML document.
function pageheader(CmsForNerd\CmsContext $ctx)
{
    // [SEO] The DOCTYPE tells the browser we are using modern HTML5.
    print("<!DOCTYPE html>\n");
    print("<html lang=\"en\">");
    print("<head>");

    // [STRUCTURE] common-headertag.inc contains our CSP and Meta tags (SEO/Security).
    include ("contents/common-headertag.inc");

    // [SEO] Dynamically set the page title from our content state.
    print("<title>".$ctx->content['title']."</title>");

    // [THEME] Import the stylesheet chosen in global-control.inc.php.
    print("<style type=\"text/css\" media=\"all\">@import \"$ctx->cssPath\";</style>");

    // [SECURITY] Turnstile script is needed on every page to protect forms from bots.
    print('<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>');

    print("</head>");
}

// [LOGIC] pagecontent() is the heart of the CMS. It decides which body file to load.
function pagecontent(CmsForNerd\CmsContext $ctx)
{
    // [DYNAMIC LOADING] This line combines the filename with "-body.inc".
    // Example: If the user is on index.php, it loads "contents/index-body.inc".
    // This allows you to add pages just by creating new files in /contents.
    include ("contents/".$ctx->dataFile['0']."-body.inc");

// testing not working. let it be.
//print($CONTENT['data']);
//echo "".$CONTENT['data']."";
//unset($CONTENT['data']);
//print("ujian ".$CONTENT['data']."aje");

}

// [STRUCTURE] pagetailer() closes the HTML document.
function pagetailer(CmsForNerd\CmsContext $ctx)
{
    print("</html>");
}

?>
