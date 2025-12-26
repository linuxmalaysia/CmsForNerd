<?php

// This is the common functions to all page
// CmsForNerd 
// Idea from drupal and xampp and some codes from them
// License GNU Public License V2
// Harisfazillah Jamel v 1.1 7 Feb 2006 linuxmalaysia @ gmail dot com
// Harisfazillah Jamel v 1.2 18 November 2007 linuxmalaysia @ gmail dot com
// Harisfazillah Jamel v 3.1 27 Dec 2025
// With the help of Google Gemini
// For https://www.linuxmalaysia.com
// For small site without database just pure php html xml code
// Remember all page call this and please check the local
// theme or lang overwrite

// Call the content from the content object. Check the file type

function pageheader(CmsForNerd\CmsContext $ctx)
{



// XHTML define

print("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n");
print("<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"en\" xml:lang=\"en\">");

print("<head>");

// start common tags for CmsForNerd
include ("contents/common-headertag.inc");
// end common tags for CmsForNerd

print("<title>".$ctx->content['title']."</title>");
print("<style type=\"text/css\" media=\"all\">@import \"$ctx->cssPath\";</style>");
print("<meta content=\"".$ctx->content['author']."\" name=\"author\" />");
print("<meta content=\"".$ctx->content['description']."\" name=\"description\" />");
print("<meta content=\"".$ctx->content['keywords']."\" name=\"keywords\" />");
print("<meta name=\"Abstract\" content=\"".$ctx->content['description']."\" />");
print("<meta name=\"head\" content=\"".$ctx->content['description']."\" />");

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
