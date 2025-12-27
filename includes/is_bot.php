<?php
declare(strict_types=1);

/**
 * [SEO/PERFORMANCE] is_bot() checks if the visitor is a search engine crawler.
 * Understanding bots is key for:
 * 1. SEO: Serving optimized content to Googlebot.
 * 2. PERFORMANCE: Preventing aggressive crawlers from slowing down your site.
 */
function is_bot(?string $userAgent = null): bool
{
    // [PHP] $_SERVER['HTTP_USER_AGENT'] is a string identify the browser/bot.
    $userAgent = $userAgent ?? $_SERVER['HTTP_USER_AGENT'] ?? '';
    
    if (empty($userAgent)) {
        return false;
    }

    // [MODERN PHP] We use Regular Expressions (Regex) to find bot names in the User Agent string.
    // Instead of a giant list, this single pattern is much faster for the server to process.
    $pattern = '/(' .
        'googlebot|bingbot|yandex|baiduspider|twitterbot|facebookexternalhit|rogerbot|linkedinbot|' .
        'embedly|quora link preview|showyoubot|outbrain|pinterest\/0\.|pinterestbot|slackbot|vkShare|' .
        'w3c_validator|redditbot|applebot|whatsapp|flipboard|tumblr|bitlybot|skypeuripreview|' .
        'nuzzel|discordbot|google page speed|qwantify|pinterest|wordpress|xing-content|' .
        'telegrambot|mediapartners-google|mj12bot|ahrefsbot|semrushbot|dotbot|' .
        'duckduckbot|ia_archiver|amazonaws\.com|netcraft|coccoc|surdotly|' .
        'bot|crawl|spider|slurp|search' . 
        ')/i';

    // preg_match() returns 1 if it finds a match, 0 if not.
    return (bool) preg_match($pattern, $userAgent);
}

/**
 * Blocks traffic from data centers (hosting providers) using ipinfo.io API.
 * WARNING: This makes an external API call on every request. High latency.
 * 
 * @param string $token Your ipinfo.io API Token.
 */
function block_datacenter_traffic(string $token): void
{
    $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    
    // Suppress errors to prevent breaking the site on API failure
    $json = @file_get_contents("https://ipinfo.io/{$ip}/json?token={$token}");
    
    if ($json === false) {
        return; // Fail open (allow traffic) if API is down
    }

    $details = json_decode($json);

    // Check if ASN type is 'hosting'
    // Note: 'asn' field might not exist on free tier or all responses, check existence.
    if (isset($details->asn->type) && $details->asn->type === 'hosting') {
        http_response_code(403);
        die("Data center traffic blocked.");
    }
}
?>
