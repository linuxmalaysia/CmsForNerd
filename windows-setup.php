<?php

declare(strict_types=1);

/**
 * CmsForNerd v3.5 - Page Controller (windows-setup.php)
 * * ROLE: Technical walkthrough for local development environment setup.
 * This file is synchronized with the master template.php logic to ensure
 * total architectural consistency across the entire CMS.
 *
 * @package     linuxmalaysia/cmsfornerd
 * @author      Harisfazillah Jamel <linuxmalaysia@songketmail.org>
 * @copyright   2005 - 2026 Harisfazillah Jamel
 * @license     GPL-3.0-or-later
 */

// 1. [PERFORMANCE] Enable GZIP and Output Buffering
if (!ob_start("ob_gzhandler")) {
    ob_start();
}

/**
 * 2. [LAB] BOOTSTRAP PHASE
 */
require_once __DIR__ . '/includes/bootstrap.php';

/**
 * 3. [SEO/AI] Page Metadata
 */
$content = [
    'title'       => "Windows 11 Setup Guide: PHP 8.4+ & 9 Ready | CMSForNerd v3.5",
    'author'      => "CMSForNerd Team & Google Gemini",
    'description' => "Step-by-step guide to setting up Laravel Herd, Git, and Antigravity for PHP 8.4 development on Windows 11.",
    'keywords'    => "Windows 11, PHP 8.4, PHP 9, Laravel Herd, Git for Windows, Antigravity Terminal, Composer",
    'schemaType'  => "HowTo"
];

/**
 * 4. [LAB] ROUTING & SANITIZATION
 */
$rawPage = match (true) {
    !empty($_SERVER['QUERY_STRING']) => (string) $_SERVER['QUERY_STRING'],
    default                          => pathinfo(basename(__FILE__), PATHINFO_FILENAME)
};

/**
 * [SECURITY] Path Traversal Prevention
 */
$isValid = \CmsForNerd\SecurityUtils::isValidPageName($rawPage);
$page = $isValid ? $rawPage : 'index';
$pageName = pathinfo($page, PATHINFO_FILENAME);

$content['data'] = $pageName;

/**
 * 5. [MODERN PHP] CmsContext Initialization (Factory Method)
 */
$ctx = createCmsContext(
    content: $content,
    pageName: $pageName
);

/**
 * 6. [SECURITY] Session & Bot Hardening
 */
if (file_exists(__DIR__ . '/includes/turnstile.php')) {
    require_once __DIR__ . '/includes/turnstile.php';
}

/**
 * [LAB] BOT DETECTION
 */
if (file_exists(__DIR__ . '/includes/is_bot.php')) {
    require_once __DIR__ . '/includes/is_bot.php';
    if (is_bot()) {
        header('Content-Type: text/plain; charset=utf-8');
        echo "CmsForNerd v3.5 - Laboratory Text Mode\n";
        echo "Sitemap: " . ($config['sitemap_url'] ?? '/sitemap.php');
        exit;
    }
}

/**
 * 7. [RENDER] Theme Dispatcher
 */
$pagerPath = __DIR__ . "/themes/{$ctx->themeName}/pager.php";
if (file_exists($pagerPath)) {
    require_once $pagerPath;
    pager($ctx);
} else {
    header('HTTP/1.1 500 Internal Server Error');
    echo "Fatal Error: Theme engine missing in /themes/{$ctx->themeName}/";
}

ob_end_flush();
