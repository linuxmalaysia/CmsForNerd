<?php

declare(strict_types=1);

namespace CmsForNerd;

/**
 * CmsForNerd - Global Control Center
 * * This file handles security bootstrapping and environment configuration.
 * It follows PSR-12 standards by separating declarations from execution.
 */

/**
 * [SECURITY] boot_security
 * * Handles technical file protection and prevents direct access to includes.
 */
function boot_security(): void
{
    $currentPath = $_SERVER['SCRIPT_NAME'] ?? '';
    $currentFile = basename($currentPath);

    // Identify sensitive or technical file extensions/paths
    $isTechnical = str_ends_with($currentFile, '.inc') ||
                    str_contains($currentPath, '/includes/') ||
                    str_contains($currentPath, '/vendor/') ||
                    str_contains($currentFile, '.php-old');

    if ($isTechnical) {
        header("X-Robots-Tag: noindex, nofollow, noarchive, nosnippet", true);
    }

    // Prevent direct browser execution of this specific file
    if ($currentFile === 'global-control.inc.php') {
        http_response_code(403);
        die("Direct access forbidden.");
    }
}

/**
 * [LOGIC] get_runtime_config
 * * Aggregates theme settings, pathing, and SEO metadata.
 * It provides a local scope for theme.php to inherit.
 * * @return array The configuration map for the CMS.
 */
function get_runtime_config(): array
{
    // 1. Define theme name (used by theme.php via include scope)
    $themeName = "CmsForNerd";

    // 2. Initialize CSSPATH variable to be captured from theme.php
    $CSSPATH = null;

    // 3. Include theme-specific configuration
    // theme.php will have access to $themeName and can set $CSSPATH
    $themePath = __DIR__ . "/../themes/$themeName/theme.php";
    if (file_exists($themePath)) {
        include_once $themePath;
    }

    // 4. Dynamic URL detection (Cross-platform/Server safe)
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";

    return [
        'THEMENAME'   => $themeName,
        // Priority: Use $CSSPATH from theme.php if set, otherwise default to theme folder
        'CSSPATH'     => $CSSPATH ?? "themes/$themeName/css/",
        'sitemap_url' => "$protocol://$host/sitemap.php"
    ];
}
