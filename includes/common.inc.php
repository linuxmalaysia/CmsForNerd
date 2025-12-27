<?php

declare(strict_types=1);

// [SEO/HTML5] pageheader() builds the REQUIRED top part of every HTML document.
function pageheader(CmsForNerd\CmsContext $ctx): void
{
    // [SEO/AI] Determine Schema.org type based on page content
    // Defaults to 'WebPage', but can be overridden by setting $CONTENT['schemaType']
    $schemaType = $ctx->content['schemaType'] ?? 'WebPage';
    
    // [SEO/AI] Determine language (default: English)
    $pageLang = $ctx->content['lang'] ?? 'en';
    
    // [SEO] The DOCTYPE tells the browser we MUST use modern HTML5.
    print("<!DOCTYPE html>\n");
    
    // [RFC 2119] MUST: The HTML tag MUST include itemscope and itemtype (Microdata for AI)
    print('<html lang="' . htmlspecialchars($pageLang, ENT_QUOTES, 'UTF-8') . '" ');
    print('itemscope itemtype="https://schema.org/');
    print(htmlspecialchars($schemaType, ENT_QUOTES, 'UTF-8') . '">' . "\n");
    
    print("<head>\n");

    // [STRUCTURE] common-headertag.inc MUST be included for CSP and Meta tags.
    include "contents/common-headertag.inc";

    // [SEO] Page titles SHOULD be descriptive and dynamic.
    $title = htmlspecialchars($ctx->content['title'] ?? 'CMSForNerd', ENT_QUOTES, 'UTF-8');
    print("<title>{$title}</title>");

    // [THEME] Stylesheets SHOULD be imported via the configured cssPath.
    print("<style type=\"text/css\" media=\"all\">@import \"{$ctx->cssPath}\";</style>");

    // [SECURITY] Turnstile script MUST be loaded to protect forms.
    $nonce = htmlspecialchars($ctx->cspNonce, ENT_QUOTES, 'UTF-8');
    $script = '<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" ';
    $script .= 'async defer nonce="' . $nonce . '"></script>';
    print($script);

    print("</head>\n");
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
