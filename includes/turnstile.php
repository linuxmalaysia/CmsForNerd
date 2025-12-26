<?php
declare(strict_types=1);

/**
 * Cloudflare Turnstile Verification for PHP 8.4
 * Integration for CmsForNerd
 */

// 1. Configuration (Move these to a config file later)
if (!defined('TURNSTILE_SECRET_KEY')) {
    define('TURNSTILE_SECRET_KEY', 'YOUR_SECRET_KEY_HERE');
}

/**
 * Verifies the Turnstile Token
 */
function verifyTurnstile(string $token, string $remoteIp): bool {
    if (empty($token)) return false;

    $url = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
    
    // PHP 8.4: Using cURL for a robust POST request
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
    
    // PHP 8 logic: check for success property
    return (bool)($outcome['success'] ?? false);
}

// 2. Global Control Execution
// Only verify if a POST request is being made (e.g., login or contact form)
// AND the user is not logged in (optional refinenement, but sticking to basics first)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
    
    $userToken = $_POST['cf-turnstile-response'] ?? '';
    $userIp    = $_SERVER['REMOTE_ADDR'] ?? '';

    if (!verifyTurnstile($userToken, $userIp)) {
        // Modern PHP 8.1+ Enums or Match can be used for error handling
        http_response_code(403);
        die("Security Check Failed: Automated traffic detected (Turnstile).");
    }
}
?>
