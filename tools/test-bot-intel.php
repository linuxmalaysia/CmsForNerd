<?php

declare(strict_types=1);

function run_test(string $ip, string $ua, bool $expected): void {
    $cmd = sprintf(
        'php -r "declare(strict_types=1); $_SERVER[\"REMOTE_ADDR\"]=\"%s\"; $_SERVER[\"HTTP_USER_AGENT\"]=\"%s\"; require \"includes/is_bot.php\"; exit(is_bot() === %s ? 0 : 1);"',
        $ip,
        addslashes($ua),
        $expected ? 'true' : 'false'
    );
    
    exec($cmd, $output, $result);
    
    echo sprintf("Test IP: %-15s | UA: %-15s | Expected: %s | Result: %s\n", 
        $ip, 
        substr($ua, 0, 15), 
        $expected ? 'TRUE' : 'FALSE', 
        $result === 0 ? "PASSED" : "FAILED"
    );
}

echo "🧪 Verifying Hybrid Bot Intelligence (Process Isolation)...\n\n";

run_test('127.0.0.1', 'Googlebot', false); // Localhost should be false
run_test('66.249.66.1', 'Googlebot', true);  // Verified Googlebot IP
run_test('1.1.1.1', 'Googlebot', false);      // Spoofed Googlebot UA
run_test('17.58.101.50', 'Applebot', true);   // Verified Applebot IP
run_test('8.8.8.8', 'Mozilla/5.0', false);    // Normal User

echo "\n🏁 Logic Audit Complete.\n";
