<?php

declare(strict_types=1);

/**
 * CmsForNerd - A flat-file CMS modernized for PHP 8.4+ and later PHP 9
 *
 * This is the Front Controller. In modern architecture, all requests flow through here
 * to ensure security, configuration, and environment setup are consistent.
 *
 * @package    linuxmalaysia/cmsfornerd
 * @author     Harisfazillah Jamel <linuxmalaysia@songketmail.org>
 * @copyright  2005 - 2025 Harisfazillah Jamel
 * @license    GPL-3.0-or-later
 * @link       https://www.linuxmalaysia.com/
 */

/**
 * [ENTRY POINT] CmsForNerd v3.3 - Front Controller
 * Architecture: Centralized Routing & Context Management.
 * Compliance: PHP 8.4+, PSR-12, RFC 2119.
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
    'title'       => "CmsForNerd v3.3 | The Developer’s Laboratory",
    'author'      => "Harisfazillah Jamel",
    'description' => "A lightweight flat-file CMS modernized for PHP 8.4+ and PHP 9 readiness.",
    'keywords'    => "PHP 8.4, Flat-file CMS, Security Laboratory, PSR-12, Education",
    'schemaType'  => "WebApplication"
];

/**
 * 4. [LAB] ROUTING & SANITIZATION
 * v3.3 uses the 'match' expression for strict request handling.
 */
$rawPage = match (true) {
    !empty($_SERVER['QUERY_STRING']) => $_SERVER['QUERY_STRING'],
    default                          => 'index'
};

// [SECURITY] Validate against Path Traversal
$page = \CmsForNerd\SecurityUtils::isValidPageName($rawPage) ? $rawPage : 'index';
$pageName = pathinfo($page, PATHINFO_FILENAME);
$content['data'] = $pageName;

/**
 * 5. [MODERN PHP] CmsContext Initialization
 */
$ctx = new \CmsForNerd\CmsContext(
    content:    $content,
    themeName:  $themeName,
    cssPath:    $cssPath,
    dataFile:   $dataFile,
    scriptName: $pageName
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
        echo "CmsForNerd v3.3 - Text Mode\nSitemap: " . ($config['sitemap_url'] ?? '/sitemap.php');
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
}

ob_end_flush();
