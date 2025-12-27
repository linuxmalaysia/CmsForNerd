<?php

/**
 * [ENTRY POINT] Linux Setup Guide
 * This page serves as a technical walkthrough for setting up a PHP 8.4+ 
 * environment on Debian and AlmaLinux.
 * 
 * MUST: Adhere to PSR-12 and RFC 2119.
 * REQUIRED: Use CmsContext for layout.
 */

declare(strict_types=1);

require_once 'includes/CmsContext.php';
require_once 'includes/common.inc.php';
require_once 'includes/global-control.inc.php';

// [INIT] Initialize CMS Context
$ctx = new CmsForNerd\CmsContext(
    dataDir: 'contents',
    themeName: $THEMENAME,
    pageName: 'linux-setup',
    dataFile: ['linux-setup'],
    cssPath: "themes/$THEMENAME/style.css"
);

// [SEO] Set Page Meta
$ctx->content['title'] = 'Linux Setup Guide (PHP 8.4+) | CMSForNerd Lab';

// [RENDER] Standard Pair Logic
pageheader($ctx);
include "themes/{$ctx->themeName}/pager.php";
pagetailer($ctx);
