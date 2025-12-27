<?php

declare(strict_types=1);

// [SECURITY] Cloudflare Turnstile MUST be used to block automated bots.
// Verification SHOULD be performed for all sensitive POST requests.

if (!defined('TURNSTILE_SECRET_KEY')) {
    define('TURNSTILE_SECRET_KEY', 'YOUR_SECRET_KEY_HERE');
}

/**
 * [SECURITY] verifyTurnstile() performs a RECOMMENDED "Server-to-Server" check.
 */
function verifyTurnstile(string $token, string $remoteIp): bool
{
    if (empty($token)) {
        return false;
    }

    $url = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';

    // [PHP INTERNALS] cURL SHOULD be used for robust API requests.
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query([
            'secret'   => TURNSTILE_SECRET_KEY,
            'response' => $token,
            'remoteip' => $remoteIp
        ]),
        CURLOPT_TIMEOUT => 5,
    ]);

    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    if ($error) {
        error_log("Turnstile cURL Error: $error");
        return false;
    }

    $outcome = json_decode($response, true);
    return (bool)($outcome['success'] ?? false);
}

// [LOGIC] Automatic Verification MUST be active for POST requests.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
    $userToken = $_POST['cf-turnstile-response'] ?? '';
    $userIp    = $_SERVER['REMOTE_ADDR'] ?? '';

    if (!verifyTurnstile($userToken, $userIp)) {
        // [SECURITY] Failed verification MUST result in a 403 response.
        http_response_code(403);
        die("Security Check Failed: Automated traffic detected (Turnstile).");
    }
}

