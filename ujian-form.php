<?php

declare(strict_types=1);

/**
 * [LAB] Turnstile Bot Trap Verification
 */

require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/turnstile.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Turnstile Test Laboratory</title>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    <style>
        body { font-family: sans-serif; padding: 2rem; background: #f4f4f9; }
        .box { background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .status { margin-top: 1rem; padding: 1rem; border-left: 4px solid #007bff; background: #e7f3ff; }
    </style>
</head>
<body>
    <div class="box">
        <h2>🧪 Turnstile Bot-Trap Test</h2>
        <p>Submit this form to test if <code>includes/turnstile.php</code> correctly validates your request.</p>
        
        <form method="POST">
            <input type="text" name="test_data" placeholder="Enter some text" required>
            <br><br>
            <div class="cf-turnstile" data-sitekey="1x00000000000000000000AA"></div>
            <br>
            <button type="submit">Test POST Security</button>
        </form>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
            <div class="status">
                <strong>[PASS]</strong> If you see this, the Turnstile server-to-server check was successful!
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
