<?php

/**
 * ==========================================================================
 * FILE: /includes/is_bot.php
 * ROLE: Hybrid Bot Intelligence & Protection (v3.5)
 * DESCRIPTION: Combines User-Agent regex with verified IP CIDR matching.
 * ==========================================================================
 */

declare(strict_types=1);

/**
 * [SEO/PERFORMANCE] checks if the visitor is a verified search engine crawler.
 */
function is_bot(?string $userAgent = null): bool
{
    static $isBotResult = null;
    if ($isBotResult !== null && $userAgent === null) {
        return $isBotResult;
    }

    $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';

    // 1. [FAST PATH] Localhost is never a bot
    if ($ip === '127.0.0.1' || $ip === '::1') {
        return $isBotResult = false;
    }

    $userAgent = $userAgent ?? $_SERVER['HTTP_USER_AGENT'] ?? '';
    if (empty($userAgent)) {
        return $isBotResult = false;
    }

    // 2. [PATTERN MATCH] Primary UA check
    $pattern = '/(googlebot|bingbot|yandex|baiduspider|applebot|whatsapp|discordbot|slurp|search)/i';
    $regexMatch = (bool) preg_match($pattern, $userAgent);

    // 3. [TRUST BUT VERIFY] If UA looks like a bot, check the IP
    if ($regexMatch) {
        if (is_trusted_bot_ip($ip)) {
            return $isBotResult = true;
        }
    }

    return $isBotResult = false;
}

/**
 * [INTELLIGENCE] Verifies if an IP belongs to a trusted bot network.
 */
function is_trusted_bot_ip(string $ip): bool
{
    $dataPath = dirname(__DIR__) . '/data/trusted-bots.json';
    if (!file_exists($dataPath)) {
        return false;
    }

    $data = json_decode((string)file_get_contents($dataPath), true);
    if (!isset($data['bots'])) {
        return false;
    }

    foreach ($data['bots'] as $bot) {
        foreach ($bot['prefixes'] as $prefix) {
            if (ip_in_range($ip, $prefix)) {
                return true;
            }
        }
    }

    return false;
}

/**
 * [LOGIC] CIDR Matcher (IPv4/IPv6 Support)
 */
function ip_in_range(string $ip, string $range): bool
{
    if (str_contains($range, '/')) {
        [$subnet, $bits] = explode('/', $range);
        $bits = (int)$bits;
    } else {
        $subnet = $range;
        $bits = str_contains($ip, ':') ? 128 : 32;
    }

    if (str_contains($ip, ':') !== str_contains($subnet, ':')) {
        return false; // Type mismatch
    }

    if (!str_contains($ip, ':')) {
        // IPv4
        $ipLong = ip2long($ip);
        $subnetLong = ip2long($subnet);
        $mask = -1 << (32 - $bits);
        return ($ipLong & $mask) === ($subnetLong & $mask);
    } else {
        // IPv6
        $ipBin = inet_pton($ip);
        $subnetBin = inet_pton($subnet);
        if ($ipBin === false || $subnetBin === false) {
            return false;
        }

        $mask = "";
        for ($i = 0; $i < 16; $i++) {
            if ($bits >= 8) {
                $mask .= chr(255);
                $bits -= 8;
            } elseif ($bits > 0) {
                $mask .= chr(256 - (1 << (8 - $bits)));
                $bits = 0;
            } else {
                $mask .= chr(0);
            }
        }
        return ($ipBin & $mask) === ($subnetBin & $mask);
    }
}

/**
 * [AUTOMATION] Updates the trusted IP list from official sources.
 */
function update_trusted_bot_ips(): array
{
    $sources = [
        'Google' => 'https://developers.google.com/search/apis/ipranges/googlebot.json',
        'Bing'   => 'https://www.bing.com/toolbox/bingbot.json'
    ];

    $results = [
        'updated' => date('c'),
        'bots'    => []
    ];

    foreach ($sources as $name => $url) {
        $json = @file_get_contents($url);
        if ($json) {
            $data = json_decode($json, true);
            $prefixes = [];
            if ($name === 'Google' && isset($data['prefixes'])) {
                foreach ($data['prefixes'] as $p) {
                    $prefixes[] = $p['ipv4Prefix'] ?? $p['ipv6Prefix'];
                }
            } elseif ($name === 'Bing' && isset($data['prefixes'])) {
                foreach ($data['prefixes'] as $p) {
                    $prefixes[] = $p['ipv4Prefix'] ?? $p['ipv6Prefix'];
                }
            }
            $results['bots'][] = [
                'name' => $name,
                'prefixes' => array_filter($prefixes)
            ];
        }
    }

    $dataPath = dirname(__DIR__) . '/data/trusted-bots.json';
    file_put_contents($dataPath, json_encode($results, JSON_PRETTY_PRINT));

    return $results;
}

/**
 * [SECURITY] Blocks traffic from data centers.
 */
function block_datacenter_traffic(string $token): void
{
    $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';

    // 1. [PERFORMANCE] Localhost check
    if ($ip === '127.0.0.1' || $ip === '::1') {
        return;
    }

    // 2. [INTELLIGENCE] Trust bots before blocking datacenters
    if (is_bot()) {
        return;
    }

    $json = @file_get_contents("https://ipinfo.io/{$ip}/json?token={$token}");
    if ($json === false) {
        return;
    }

    $details = json_decode($json);
    if (isset($details->asn->type) && $details->asn->type === 'hosting') {
        http_response_code(403);
        die("Data center traffic blocked. Institutional/Bot detected.");
    }
}
