<?php

// This is the common functions to all page
// CmsForNerd 
// Idea from drupal and xampp and some codes from them
// License GNU Public License V2
// Harisfazillah Jamel v 1.1 7 Feb 2006 linuxmalaysia @ gmail dot com
// Harisfazillah Jamel v 1.2 18 November 2007 linuxmalaysia @ gmail dot com
// For http://www.perempuanmelayu.info/
// For small site without database just pure php html xml code
// Remember all page call this and please check the local
// theme or lang overwrite

function pageheader()
{

// Call the content from the content file. Check the file type

global $CONTENT;
global $CSSPATH;


// XHTML define

print("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n");
print("<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"en\" xml:lang=\"en\">");

print("<head>");

// start common tags for CmsForNerd
include ("contents/common-headertag.inc");
// end common tags for CmsForNerd

print("<title>".$CONTENT['title']."</title>");
print("<style type=\"text/css\" media=\"all\">@import \"$CSSPATH\";</style>");
print("<meta content=\"".$CONTENT['author']."\" name=\"author\" />");
print("<meta content=\"".$CONTENT['description']."\" name=\"description\" />");
print("<meta content=\"".$CONTENT['keywords']."\" name=\"keywords\" />");
print("<meta name=\"Abstract\" content=\"".$CONTENT['description']."\" />");
print("<meta name=\"head\" content=\"".$CONTENT['description']."\" />");

print("</head>");


}

function pagecontent()

{

global $CONTENT;
global $DATAFILE;

include ("contents/".$DATAFILE['0']."-body.inc");

// testing not working. let it be.
//print($CONTENT['data']);
//echo "".$CONTENT['data']."";
//unset($CONTENT['data']);
//print("ujian ".$CONTENT['data']."aje");

}

function pagetailer()

{

print("</html>");

}

?>
