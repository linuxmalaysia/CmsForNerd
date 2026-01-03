<?php
declare(strict_types=1);

/**
 * ==========================================================================
 * FILE: /sitemap.php
 * ROLE: Standalone XML Sitemap Generator (v3.4.5)
 * DESCRIPTION: Operates independently of the core engine to prevent 500 errors.
 * SECURITY: Implements Path Traversal Protection and Buffer Hardening.
 * ==========================================================================
 */

/**
 * 1. [SECURITY] DIRECTORY PROTECTION
 * Even though this is a public file, we ensure no accidental output 
 * from other processes (like auto-prepends) leaks into our XML.
 */
while (ob_get_level()) {
    ob_end_clean();
}

/**
 * 2. [EDUCATION] AUTO-URL DETECTION
 * Since we are not using bootstrap.php, we must calculate the Base URL manually.
 * This is a vital skill for PHP students: understanding the $_SERVER superglobal.
 */
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$host     = $_SERVER['HTTP_HOST'] ?? 'localhost';
// Normalize paths for Windows/Linux compatibility
$scriptPath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$baseUrl    = rtrim($protocol . $host . $scriptPath, '/') . '/';

/**
 * 3. [SECURITY] HEADERS
 * application/xml: Tells the browser/crawler this is data, not a webpage.
 * nosniff: Prevents the browser from "guessing" the content type (MIME sniffing).
 */
header("Content-Type: application/xml; charset=utf-8");
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY"); // Prevents clickjacking

/**
 * 4. [XML GENERATION]
 */
echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

/**
 * 5. [SEO] PRIMARY ENTRY POINT
 * The homepage is the most important 'specimen' in our lab.
 */
echo "  <url>" . PHP_EOL;
echo "    <loc>{$baseUrl}index.php</loc>" . PHP_EOL;
echo "    <priority>1.0</priority>" . PHP_EOL;
echo "  </url>" . PHP_EOL;

/**
 * 6. [AUTOMATION] THE SCANNING ENGINE
 * We use glob() to scan the contents directory for fragments.
 */
$fragmentDir = __DIR__ . '/contents/';

if (is_dir($fragmentDir)) {
    $files = glob($fragmentDir . '*-body.inc');

    foreach ($files as $file) {
        /**
         * [EDUCATION] SLUG EXTRACTION
         * Extracting 'about' from 'contents/about-body.inc'.
         */
        $slug = str_replace('-body.inc', '', basename($file));

        /**
         * [SECURITY] RULE #8 COMPLIANCE
         * We do not expose system files or error pages in the sitemap.
         */
        $exclude = ['index', 'sitemap', 'empty', '403', '404', 'header', 'footer'];
        if (in_array($slug, $exclude)) {
            continue;
        }

        /**
         * [SECURITY] PAIR LOGIC VERIFICATION
         * Only index the page if the Master Controller (.php) exists in the root.
         * This prevents 'ghost' URLs from appearing in Google.
         */
        $masterFile = __DIR__ . '/' . $slug . '.php';

        if (file_exists($masterFile)) {
            /**
             * [LAB] DATE SYNCHRONIZATION
             * We find the NEWEST date between the logic (.php) and the content (-body.inc).
             * This ensures the sitemap updates if EITHER file changes.
             */
            $mTime = max(filemtime($masterFile), filemtime($file));
            $lastMod = date("c", $mTime); // ISO 8601 format

            echo "  <url>" . PHP_EOL;
            echo "    <loc>{$baseUrl}{$slug}.php</loc>" . PHP_EOL;
            echo "    <lastmod>{$lastMod}</lastmod>" . PHP_EOL;
            echo "    <priority>0.8</priority>" . PHP_EOL;
            echo "  </url>" . PHP_EOL;
        }
    }
}

echo '</urlset>';

/**
 * 7. [PERFORMANCE] CLEAN EXIT
 * We use exit; to ensure no accidental trailing spaces in the PHP file 
 * get appended to the XML output.
 */
exit;
