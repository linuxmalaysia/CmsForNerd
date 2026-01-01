<?php

declare(strict_types=1);

/**
 * CmsForNerd v3.4 - Front Controller
 *
 * All requests flow through this central routing engine to ensure security,
 * configuration, and environment setup are consistent across the laboratory.
 *
 * @package      linuxmalaysia/cmsfornerd
 * @author       Harisfazillah Jamel <linuxmalaysia@songketmail.org>
 * @copyright    2005 - 2025 Harisfazillah Jamel
 * @license      GPL-3.0-or-later
 * @link         https://www.linuxmalaysia.com/
 */

// 1. [PERFORMANCE] Enable GZIP and Output Buffering
if (!ob_start("ob_gzhandler")) {
    ob_start();
}

/**
 * 2. [LAB] BOOTSTRAP PHASE
 * Initializes the Autoloader, Environment, and Global Configuration.
 */
require_once __DIR__ . '/includes/bootstrap.php';

// 3. [SEO/AI] Default Landing Metadata
$content = [
    'title'       => "CmsForNerd v3.4 | The Developer’s Laboratory",
    'author'      => "Harisfazillah Jamel",
    'description' => "A lightweight flat-file CMS modernized for PHP 8.4+ and PHP 9 readiness.",
    'keywords'    => "PHP 8.4, Flat-file CMS, Security Laboratory, PSR-12, Education",
    'schemaType'  => "WebApplication"
];

/**
 * 4. [LAB] ROUTING & SANITIZATION
 * v3.4 uses the 'match' expression for strict request handling.
 */
$rawPage = match (true) {
    !empty($_SERVER['QUERY_STRING']) => (string) $_SERVER['QUERY_STRING'],
    default                          => 'index'
};

// [SECURITY] Validate against Path Traversal using the Hybrid SecurityUtils
$isValid = \CmsForNerd\SecurityUtils::isValidPageName($rawPage);
$page = $isValid ? $rawPage : 'index';
$pageName = pathinfo($page, PATHINFO_FILENAME);
$content['data'] = $pageName;

/**
 * 5. [MODERN PHP] CmsContext Initialization (Factory Method)
 * v3.4 Upgrade: We use createCmsContext() to ensure the object is correctly 
 * populated with the CSP Nonce and global configuration.
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

// SEO Optimized view for Search Crawlers
if (file_exists(__DIR__ . '/includes/is_bot.php')) {
    require_once __DIR__ . '/includes/is_bot.php';
    if (is_bot()) {
        header('Content-Type: text/plain; charset=utf-8');
        echo "CmsForNerd v3.4 - Text Mode\nSitemap: " . ($config['sitemap_url'] ?? '/sitemap.php');
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
    echo "Fatal Error: Theme pager missing.";
}

ob_end_flush();
