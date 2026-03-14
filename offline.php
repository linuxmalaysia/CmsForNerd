<?php

/**
 * ==============================================================================
 * FILE: offline.php
 * ROLE: PWA Offline Fallback Page
 * ==============================================================================
 */

declare(strict_types=1);

// Bypass normal bootstrapping as this page must be served purely from the Service Worker cache
// We hardcode the HTML to ensure it relies on absolutely nothing but cached CSS

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Offline | CMSForNerd</title>
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#0d6efd">
    <style type="text/css" media="all">
        @import "/themes/CmsForNerd/style.css";
        .offline-container {
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
            padding: 20px;
            border: 2px dashed #999;
            border-radius: 10px;
            background-color: #f8f9fa;
        }
        .offline-icon {
            font-size: 4rem;
            color: #ccc;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="offline-container">
        <div class="offline-icon">📡❌</div>
        <h1>You're Offline</h1>
        <p>The <strong>CMSForNerd Laboratory</strong> requires an active internet connection to evaluate dynamic PHP tasks.</p>
        <p>Please check your network and try again.</p>
        
        <button onclick="window.location.reload();" style="padding: 10px 20px; font-size: 1rem; cursor: pointer; background-color: #0d6efd; color: white; border: none; border-radius: 5px; margin-top:20px;">
            Retry Connection
        </button>
    </div>
</body>
</html>
