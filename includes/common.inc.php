<?php

declare(strict_types=1);

// [SEO/HTML5] pageheader() builds the REQUIRED top part of every HTML document.
function pageheader(CmsForNerd\CmsContext $ctx)
{
    // [SEO] The DOCTYPE tells the browser we MUST use modern HTML5.
    print("<!DOCTYPE html>\n");
    print("<html lang=\"en\">");
    print("<head>");

    // [STRUCTURE] common-headertag.inc MUST be included for CSP and Meta tags.
    include "contents/common-headertag.inc";

    // [SEO] Page titles SHOULD be descriptive and dynamic.
    print("<title>" . $ctx->content['title'] . "</title>");

    // [THEME] Stylesheets SHOULD be imported via the configured cssPath.
    print("<style type=\"text/css\" media=\"all\">@import \"$ctx->cssPath\";</style>");

    // [SECURITY] Turnstile script MUST be loaded to protect forms.
    print('<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>');

    print("</head>");
}

// [LOGIC] pagecontent() is the REQUIRED function that decides which body file to load.
function pagecontent(CmsForNerd\CmsContext $ctx)
{
    // [DYNAMIC LOADING] It is RECOMMENDED to use this "Pair Logic" for content.
    include "contents/" . $ctx->dataFile['0'] . "-body.inc";
}

// [STRUCTURE] pagetailer() MUST be used to close the HTML document.
function pagetailer(CmsForNerd\CmsContext $ctx)
{
    print("</html>");
}
