<?php

/**
 * ==========================================================================
 * FILE: themes/CmsForNerd/pager.php
 * ROLE: The "Master Pair" / Layout Controller
 * ==========================================================================
 * * EDUCATIONAL NOTE:
 * In CMSForNerd's "Pair Logic", this function acts as the chassis of the car.
 * It provides the structure (Head, Body, Footer), while the individual
 * page scripts (the "Slave Pair") provide the engine and interior (Content).
 *
 * This separation ensures that security policies (CSP) and global assets
 * (CSS/JS) are managed in ONE place, rather than scattered across 100 files.
 */

declare(strict_types=1);

// PHP 8.4 Best Practice: Enforce strict type checking.

// [STRUCTURE] The pager() function MUST define the layout hierarchy.
// @param CmsContext $ctx - The immutable context object containing current state.
function pager(CmsForNerd\CmsContext $ctx)
{
    // 1. [HEAD CONSTRUCTION]
    // This function (defined in core) generates the <head> block,
    // including <title>, <meta> tags, and the <link> to our style.css.
    pageheader($ctx);

    // 2. [BODY START]
    // We explicitly open the body tag here.
    print("<body>");

    // 3. [LAYOUT INITIALIZATION]
    // We include 'bodytop.tpl'. In our 3-column architecture, this file
    // is responsible for opening the main #container div and setting up
    // the Header, Left Nav, and Right Nav areas.
    // NOTE: It leaves the #content div OPEN for injection.
    include "themes/{$ctx->themeName}/bodytop.tpl";

    // 4. [CONTENT INJECTION]
    // This is the critical "Pair Logic" moment.
    // pagecontent() calls the specific page logic (e.g., contents/index-body.inc).
    // The output of that file flows directly into the open #content div.
    pagecontent($ctx);

    // 5. [LAYOUT CLOSURE]
    // We include 'bodyfooter.tpl'. This file is responsible for
    // closing the #content div, closing the #container div, and
    // rendering the footer.
    include "themes/{$ctx->themeName}/bodyfooter.tpl";

    // 6. [BODY END]
    print("</body>");

    // 7. [CLEANUP]
    // Closes <html> and flushes output buffers.
    pagetailer($ctx);
}
