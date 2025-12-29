<?php

declare(strict_types=1); // [LAB] Enforces strict data typing, preventing "quiet" bugs with integers/strings.

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

// [PERFORMANCE] Use Output Buffering to allow header manipulation later in the script
// and compress data (GZIP) to reduce bandwidth usage in the laboratory.
if (!ob_start("ob_gzhandler")) {
    ob_start();
}

/**
 * [LAB] BOOTSTRAP PHASE
 * We load the "engine" of the CMS. Instead of repeating logic on every page,
 * we use bootstrap.php to initialize the Autoloader, Security, and Config.
 */
require_once __DIR__ . '/includes/bootstrap.php';

// [LAB] EDUCATIONAL NOTE: At this point, $config, $themeName, and $cssPath 
// are already defined by bootstrap.php through the get_runtime_config() function.

// [SEO] Metadata - Site-wide defaults. 
// Students: These are used by the theme to generate <meta> tags.
$content = [
    'title'       => "CmsForNerd - A Content Management Software For Nerd",
    'author'      => "Harisfazillah Jamel",
    'description' => "CmsForNerd is a lightweight flat-file CMS optimized for PHP 8.4.",
    'keywords'    => "CmsForNerd, CMS, HTML, PHP, Flat-file, Security",
];

/**
 * [LAB] ROUTING & SANITIZATION
 * Determining what the user wants to see and ensuring the input is safe.
 */
// [SECURITY] Use the 'match' expression (PHP 8.0+) for cleaner sanitization logic.
$rawPage = match (true) {
    !empty($_SERVER['QUERY_STRING']) => $_SERVER['QUERY_STRING'],
    default                          => $scriptName // $scriptName is defined in bootstrap.php
};

// [SECURITY] Prevent Directory Traversal by validating the page name against a whitelist.
// [LAB] We use the FQCN (Fully Qualified Class Name) to access SecurityUtils.
$page = \CmsForNerd\SecurityUtils::isValidPageName($rawPage)
    ? $rawPage
    : 'index';

// [LAB] Normalize the page name (removes .php) for internal content lookup.
$pageName        = pathinfo($page, PATHINFO_FILENAME);
$content['data'] = $pageName;

/**
 * [MODERN PHP] CmsContext Object (State Management)
 * [LAB] Instead of using Global Variables, we pass a "Context" object.
 * This is a step toward Dependency Injection, making the code easier to test.
 */
$ctx = new \CmsForNerd\CmsContext(
    content:    $content,
    themeName:  $themeName,
    cssPath:    $cssPath,
    dataFile:   $dataFile, // Array defined in bootstrap.php
    scriptName: $pageName
);

/**
 * [SECURITY] Session Management
 * [LAB] Sessions allow us to store user state across different page loads.
 */
ini_set('session.gc_maxlifetime', '1800'); // 30-minute default timeout.
session_start();
$_SESSION['session_start_time'] = time();
$_SESSION['valid_session']      = true;

/**
 * [STRUCTURE] Theme Controller
 * [LAB] Decoupling logic from presentation. This loads the "Theme Engine".
 */
$pagerPath = __DIR__ . "/themes/{$ctx->themeName}/pager.php";
if (file_exists($pagerPath)) {
    include_once $pagerPath;
}

/**
 * [SECURITY/SEO] Bot Detection
 * [LAB] Real-world applications often serve different content to search 
 * engine crawlers to optimize indexing (SEO).
 */
if (file_exists(__DIR__ . '/includes/is_bot.php')) {
    require_once __DIR__ . '/includes/is_bot.php';
    if (is_bot()) {
        header('Content-Type: text/plain; charset=utf-8');
        echo "Welcome bot! This is an optimized text view for indexing.\n";
        echo "Sitemap: " . ($config['sitemap_url'] ?? 'https://www.linuxmalaysia.com/sitemap.php') . "\n";
        exit;
    }
}

// [SECURITY] Integration for Bot protection (e.g., Cloudflare Turnstile).
if (file_exists(__DIR__ . '/includes/turnstile.php')) {
    require_once __DIR__ . '/includes/turnstile.php';
}

/**
 * [RENDER] Page Generation
 * [LAB] The final step. We call the pager() function from our theme.
 * By passing $ctx, the theme has everything it needs to render the HTML.
 */
if (function_exists('pager')) {
    pager($ctx);
}

/**
 * [LOGIC] Logout Handling
 * [LAB] Demonstrates how to handle GET requests to destroy a session.
 */
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

// [PERFORMANCE] Flush the output buffer, sending the final HTML to the user's browser.
ob_end_flush();
