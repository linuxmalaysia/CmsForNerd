<?php

// This is the global control to all page
// CmsForNerd 
// Idea from drupal and xampp and some codes from them
// License GNU Public License V2
// Harisfazillah Jamel v 1.1 7 Feb 2006 linuxmalaysia @ gmail dot com
// Harisfazillah Jamel v 1.2 18 November 2007 linuxmalaysia @ gmail dot com
// Harisfazillah Jamel v 1.3 10 Mac 2024 Linuxmalaysia @ gmail dot com
// Harisfazillah Jamel v 3.1 27 Dec 2025
// With the help of Google Gemini
//
// FILE PURPOSE:
// Global Configuration. This file:
// 1. Sets site-wide settings (Default Theme, Language).
// 2. Defines the top-level variables used to bootstrap the system.
// For https://www.linuxmalaysia.com
// For small site without database just pure php html xml code
// Remember all page call this and please check the local
// theme or lang overwrite




// [LOGIC] Configuration File - This centralizes your site's settings.
// This is where you change the look and feel of your entire site.

// [THEME] Set the active theme folder name.
$THEMENAME="CmsForNerd";

// [STRUCTURE] Include the theme's specific settings (like CSS paths).
include("themes/$THEMENAME/theme.php");

// [SEO] Configuration for your sitemap URL. This is used by bot detectors.
$CONFIG['sitemap_url'] = 'https://www.linuxmalaysia.com/sitemap.php';

?>
