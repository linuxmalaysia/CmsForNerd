<?php
declare(strict_types=1);
/**
 * CMSForNerd v3.4 - Silent Sentry
 * Rule #8: Unauthorized directory browsing is forbidden.
 */
header('HTTP/1.1 403 Forbidden');
exit("Access Denied: Laboratory Gateway Active.");
