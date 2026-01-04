<?php

/**
 * ==========================================================================
 * FILE: themes/CmsForNerd/pager.php
 * ROLE: The "Master Pair" / Layout Controller (Dual-View Edition)
 * VERSION: 3.5.8 (Interactive Sidebar & Tap Fix)
 * ==========================================================================
 */

declare(strict_types=1);

/**
 * [STRUCTURE] The main entry point for the theme.
 * @param CmsForNerd\CmsContext $ctx - The immutable context object.
 */
function pager(CmsForNerd\CmsContext $ctx): void
{
    $viewMode = $_GET['view'] ?? 'standard';

    if ($viewMode === 'amp') {
        renderAmpLayout($ctx);
    } else {
        renderStandardLayout($ctx);
    }
}

/**
 * [LABORATORY METHOD] renderStandardLayout
 */
function renderStandardLayout(CmsForNerd\CmsContext $ctx): void
{
    pageheader($ctx);
    print("<body>");
    include "themes/{$ctx->themeName}/bodytop.tpl";
    pagecontent($ctx);
    include "themes/{$ctx->themeName}/bodyfooter.tpl";
    print("</body>");
    pagetailer($ctx);
}

/**
 * [LABORATORY METHOD] renderAmpLayout
 */
function renderAmpLayout(CmsForNerd\CmsContext $ctx): void
{
    $actualFile = basename($_SERVER['SCRIPT_NAME'], '.php');
    
    if ($ctx->scriptName !== $actualFile) {
        $ctx = new \CmsForNerd\CmsContext(
            content:    $ctx->content,
            themeName:  $ctx->themeName,
            cssPath:    $ctx->cssPath,
            dataFile:   $ctx->dataFile,
            scriptName: $actualFile,
            cspNonce:   $ctx->cspNonce
        );
    }

    ?>
    <!doctype html>
    <html ⚡ lang="en">
    <head>
        <?php pageheader_amp($ctx); ?>
        <style amp-custom>
            /* Critical fix for Sidebar interaction */
            amp-sidebar { z-index: 99999 !important; }
            .hamburger-btn { 
                background: none; 
                border: none; 
                font-size: 1.8rem; 
                cursor: pointer; 
                padding: 10px; 
                margin-right: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #8e44ad;
            }
        </style>
    </head>
    <body>
        <?php include "themes/{$ctx->themeName}/amp-sidebar.tpl"; ?>

        <header class="amp-header" style="background:#f8f9fa; padding:10px 15px; border-bottom:1px solid #ddd; display: flex; align-items: center;">
            
            <button class="hamburger-btn" 
                    on="tap:sidebar.toggle" 
                    role="button" 
                    tabindex="0" 
                    aria-label="Open Navigation">☰</button>
            
            <a href="index.php?view=amp" style="text-decoration:none; color:#8e44ad; font-weight:bold; flex-grow: 1;">
               🏠 Laboratory Home
            </a>
            
            <span style="font-family:monospace; font-size:0.7rem; color:#666;">
               [ AMP ]
            </span>
        </header>

        <main style="padding:20px;">
            <?php 
            ob_start();
            pagecontent($ctx);
            $rawHtml = (string) ob_get_clean();
            
            // Transform images for AMP
            $cleanHtml = str_replace(
                '<img', 
                '<amp-img width="600" height="400" layout="responsive"', 
                $rawHtml
            ); 
            
            // Remove illegal body styles
            $cleanHtml = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', '', $cleanHtml);

            echo $cleanHtml; 
            ?>
        </main>

        <footer style="text-align:center; padding:30px; border-top:1px solid #eee; font-size:0.8rem; color:#888;">
            <p>&copy; <?= date('Y') ?> CmsForNerd v3.5 Laboratory</p>
            <p><a href="<?= htmlspecialchars($ctx->scriptName) ?>.php">Switch to Standard Desktop View</a></p>
        </footer>
    </body>
    </html>
    <?php
}
