<?php
declare(strict_types=1);

/**
 * 1. SECURITY: Stealth Bot Defense
 * Uses X-Robots-Tag to hide technical files from search engines.
 */
$current_path = $_SERVER['SCRIPT_NAME'] ?? '';
$current_file = basename($current_path);

// Automated pattern matching for technical/private files
$is_technical = str_ends_with($current_file, '.inc') || 
                str_contains($current_path, '/includes/') || 
                str_contains($current_path, '/vendor/') ||
                str_contains($current_file, '.php-old');

if ($is_technical) {
    header("X-Robots-Tag: noindex, nofollow, noarchive, nosnippet", true);
}

// Prevent direct browser access to this configuration file
if ($current_file === 'global-control.inc.php') {
    http_response_code(403);
    die("Direct access forbidden.");
}

/**
 * 2. LOGIC: Site Configuration
 * These settings are now environment-aware.
 */

// [THEME] Set the active theme folder name.
$THEMENAME = "CmsForNerd";

// [STRUCTURE] Load theme settings.
$theme_path = __DIR__ . "/../themes/$THEMENAME/theme.php";
if (file_exists($theme_path)) {
    include_once $theme_path;
}

/**
 * 3. SEO: Dynamic Base URL Detection
 * This ensures the sitemap works on any domain without manual editing.
 */
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
$base_url = "$protocol://$host";

// [SEO] Configuration for your sitemap URL.
$CONFIG['sitemap_url'] = $base_url . '/sitemap.php';
