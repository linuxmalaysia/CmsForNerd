<?php

declare(strict_types=1);

// [STRUCTURE] The pager() function MUST define the layout hierarchy.
function pager(CmsForNerd\CmsContext $ctx)
{
    // 1. [REQUIRED] Build the <head> (Titles, Meta tags, CSS).
    pageheader($ctx);

    // 2. [REQUIRED] Open the <body> tag.
    print("<body>");

    // 3. [RECOMMENDED] Load the top part of the theme (Logo, Top Navigation).
    include "themes/{$ctx->themeName}/bodytop.tpl";

    // 4. [REQUIRED] Load the unique content for this specific page.
    pagecontent($ctx);

    // 5. [RECOMMENDED] Load the bottom part of the theme (Footer, Copyright).
    include "themes/{$ctx->themeName}/bodyfooter.tpl";

    // 6. [REQUIRED] Close the <body> tag.
    print("</body>");

    // 7. [REQUIRED] Close the <html> tag and clear buffers.
    pagetailer($ctx);
}
