<?php
declare(strict_types=1);

/**
 * Cloudflare Turnstile Verification for PHP 8.4
 * Integration for CmsForNerd
 */

// [SECURITY] Cloudflare Turnstile blocks automated bots while allowing real humans.
// It works in two steps:
// 1. The browser shows a widget that generates a 'token'.
// 2. This script sends that token to Cloudflare to verify it's valid.

if (!defined('TURNSTILE_SECRET_KEY')) {
    define('TURNSTILE_SECRET_KEY', 'YOUR_SECRET_KEY_HERE');
}

/**
 * [SECURITY] verifyTurnstile() performs a "Server-to-Server" check.
 * This is the most secure way to verify tokens because the secret key never leaves your server.
 */
function verifyTurnstile(string $token, string $remoteIp): bool {
    if (empty($token)) return false;

    $url = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
    
    // [PHP INTERNALS] cURL is a powerful tool for making requests to other websites.
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true, // Return response as a string instead of printing it
        CURLOPT_POST => true,           // Use the POST method (sending data)
        CURLOPT_POSTFIELDS => http_build_query([
            'secret'   => TURNSTILE_SECRET_KEY,
            'response' => $token,
            'remoteip' => $remoteIp
        ]),
        CURLOPT_TIMEOUT => 5,           // If Cloudflare doesn't respond in 5s, fail (good for performance)
    ]);

    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    if ($error) {
        error_log("Turnstile cURL Error: $error");
        return false;
    }

    // [DATA] Parse the JSON response from Cloudflare into a PHP array.
    $outcome = json_decode($response, true);
    
    // Return true if success is present and true.
    return (bool)($outcome['success'] ?? false);
}

// [LOGIC] Automatic Verification
// We only check if the user is submitting data (POST request).
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
    
    $userToken = $_POST['cf-turnstile-response'] ?? '';
    $userIp    = $_SERVER['REMOTE_ADDR'] ?? '';

    if (!verifyTurnstile($userToken, $userIp)) {
        // [SECURITY] If verification fails, we stop the script immediately.
        http_response_code(403);
        die("Security Check Failed: Automated traffic detected (Turnstile).");
    }
}
?>
