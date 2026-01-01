<!-- 
FILE PURPOSE: Theme Upper Layout
This file defines the upper structure of the page layout:
1. Opens the main #container div.
2. Includes the #top (header) and navigation sidebars (#leftnav, #rightnav).
3. Opens the #content div where the main page logic will output data.
NOTE: Several <div> tags opened here are closed in 'bodyfooter.tpl'.
-->

<!-- CSP added for extra security as requested -->
<meta http-equiv="Content-Security-Policy" content="default-src 'self' 'unsafe-inline' 'unsafe-eval' https://challenges.cloudflare.com https://*.ipinfo.io https://www.google.com https://fonts.googleapis.com; img-src 'self' data: https: https://www.google.com https://groups.google.com https://www.rorweb.com; font-src 'self' https: data: https://fonts.gstatic.com;">


<!-- This div end at bodyfooter.tpl -->
<div id="container">

<!-- This is to called the banner at the top of the page -->
<div id="top">
<?php include "themes/{$ctx->themeName}/header.tpl"; ?>
</div>

<!-- This is to called the left side of the page -->
<div id="leftnav">

<?php include("contents/left-side.inc"); ?>

</div>

<!-- This is to called the right side of the page -->
<div id="rightnav">

<?php include "contents/right-side.inc"; ?>

</div>


<!-- The start of content function the div need to be here for it to work -->

<!-- This div end at bodyfooter.tpl -->
<div id="content">

<div class="content-body">


<!-- end of file bodytop.tpl -->

