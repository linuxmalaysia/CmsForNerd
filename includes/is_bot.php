<?php
declare(strict_types=1);

/**
 * is_bot
 * 
 * Detects search engine bots, crawlers, and spiders using a consolidated Regex pattern.
 * Replaces the legacy 800+ line array method.
 * 
 * @param string|null $userAgent Optional user agent string. Defaults to $_SERVER['HTTP_USER_AGENT'].
 * @return bool True if a bot is detected.
 */
function is_bot(?string $userAgent = null): bool
{
    // Use provided UA or fallback to server variable
    $userAgent = $userAgent ?? $_SERVER['HTTP_USER_AGENT'] ?? '';
    
    // If empty, we can't detect
    if (empty($userAgent)) {
        return false;
    }

    // Consolidated pattern of common bots
    // This covers major search engines, social media bots, and common crawler keywords.
    $pattern = '/(' .
        'googlebot|bingbot|yandex|baiduspider|twitterbot|facebookexternalhit|rogerbot|linkedinbot|' .
        'embedly|quora link preview|showyoubot|outbrain|pinterest\/0\.|pinterestbot|slackbot|vkShare|' .
        'w3c_validator|redditbot|applebot|whatsapp|flipboard|tumblr|bitlybot|skypeuripreview|' .
        'nuzzel|discordbot|google page speed|qwantify|pinterest|wordpress|xing-content|' .
        'telegrambot|mediapartners-google|mj12bot|ahrefsbot|semrushbot|dotbot|' .
        'duckduckbot|ia_archiver|amazonaws\.com|netcraft|coccoc|surdotly|' .
        'bot|crawl|spider|slurp|search' . // Fallback generic keywords
        ')/i';

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
