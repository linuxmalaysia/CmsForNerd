<?php

declare(strict_types=1);

require_once 'includes/is_bot.php';
require_once 'includes/SecurityUtils.php';

echo "🧪 Debugging SecurityTest logic...\n\n";

$_SERVER['REMOTE_ADDR'] = '66.249.66.1';

$ua_google = 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)';
$is_google = is_bot($ua_google);
echo "Googlebot UA + Trusted IP: " . ($is_google ? "YES" : "NO") . " (Expected: YES)\n";

$ua_human = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36';
$is_human = is_bot($ua_human);
echo "Human UA + Trusted IP: " . ($is_human ? "YES" : "NO") . " (Expected: NO)\n";

$_SERVER['REMOTE_ADDR'] = '1.1.1.1';
$is_spoof = is_bot($ua_google);
echo "Googlebot UA + Untrusted IP: " . ($is_spoof ? "YES" : "NO") . " (Expected: NO)\n";

echo "\n🏁 Debug Audit Complete.\n";
