<?php

declare(strict_types=1);

// [LOGIC] Configuration File - This centralizes your site's settings.
// These RECOMMENDED settings MUST be adjusted for your specific production environment.

// [THEME] Set the active theme folder name.
$THEMENAME = "CmsForNerd";

// [STRUCTURE] Theme settings MUST be included here.
include "themes/$THEMENAME/theme.php";

// [SEO] Configuration for your sitemap URL. This MUST be a full URL.
$CONFIG['sitemap_url'] = 'https://www.linuxmalaysia.com/sitemap.php';

