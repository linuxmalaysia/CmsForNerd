<?php

declare(strict_types=1);

/**
 * [SEO/PERFORMANCE] is_bot() checks if the visitor is a search engine crawler.
 * Understanding bots is RECOMMENDED for:
 * 1. SEO: Serving optimized content to Googlebot.
 * 2. PERFORMANCE: Preventing aggressive crawlers from slowing down your site.
 *
 * The bot list SHOULD be updated regularly to reflect new search engines.
 */
function is_bot(?string $userAgent = null): bool
{
    // [PHP] $_SERVER['HTTP_USER_AGENT'] SHOULD be used to identify the visitor.
    $userAgent = $userAgent ?? $_SERVER['HTTP_USER_AGENT'] ?? '';

    if (empty($userAgent)) {
        return false;
    }

    // [MODERN PHP] Regex MUST be used for efficient pattern matching.
    $pattern = '/(' .
        'googlebot|bingbot|yandex|baiduspider|twitterbot|facebookexternalhit|rogerbot|linkedinbot|' .
        'embedly|quora link preview|showyoubot|outbrain|pinterest\/0\.|pinterestbot|slackbot|vkShare|' .
        'w3c_validator|redditbot|applebot|whatsapp|flipboard|tumblr|bitlybot|skypeuripreview|' .
        'nuzzel|discordbot|google page speed|qwantify|pinterest|wordpress|xing-content|' .
        'telegrambot|mediapartners-google|mj12bot|ahrefsbot|semrushbot|dotbot|' .
        'duckduckbot|ia_archiver|amazonaws\.com|netcraft|coccoc|surdotly|' .
        'bot|crawl|spider|slurp|search' .
        ')/i';

    return (bool) preg_match($pattern, $userAgent);
}

/**
 * [SECURITY] Blocks traffic from data centers.
 * This SHOULD ONLY be used for sites experiencing heavy automated scraping.
 */
function block_datacenter_traffic(string $token): void
{
    $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';

    // API calls SHOULD be handled with error suppression in production.
    $json = @file_get_contents("https://ipinfo.io/{$ip}/json?token={$token}");

    if ($json === false) {
        return;
    }

    $details = json_decode($json);

    if (isset($details->asn->type) && $details->asn->type === 'hosting') {
        http_response_code(403);
        die("Data center traffic blocked.");
    }
}

