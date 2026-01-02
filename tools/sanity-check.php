<?php
declare(strict_types=1);

/**
 * CMSForNerd v3.4 - Web Environment Sanity Check
 * Verifies Web Server configuration against Laboratory Standards.
 */

$requirements = [
    'php_version' => PHP_VERSION_ID >= 80400,
    'mbstring'    => extension_loaded('mbstring'),
    'xml'         => extension_loaded('xml'),
    'openssl'     => extension_loaded('openssl'),
    'writable'    => is_writable('../contents/'),
];

$title = "🧪 CMSForNerd v3.4 Sanity Check";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; max-width: 800px; margin: 2rem auto; padding: 0 1rem; background: #f4f4f9; }
        .card { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .status { font-weight: bold; padding: 4px 8px; border-radius: 4px; }
        .pass { background: #d4edda; color: #155724; }
        .fail { background: #f8d7da; color: #721c24; }
        h1 { color: #333; border-bottom: 2px solid #eee; padding-bottom: 0.5rem; }
        .version-badge { background: #333; color: #fff; padding: 5px 10px; border-radius: 20px; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="card">
        <h1><?php echo $title; ?> <span class="version-badge">PHP <?php echo PHP_VERSION; ?></span></h1>
        
        <ul>
            <li>
                PHP 8.4+ Engine: 
                <span class="status <?php echo $requirements['php_version'] ? 'pass' : 'fail'; ?>">
                    <?php echo $requirements['php_version'] ? 'READY' : 'OUTDATED'; ?>
                </span>
            </li>
            <li>
                MBString Extension: 
                <span class="status <?php echo $requirements['mbstring'] ? 'pass' : 'fail'; ?>">
                    <?php echo $requirements['mbstring'] ? 'LOADED' : 'MISSING'; ?>
                </span>
            </li>
            <li>
                XML Extension: 
                <span class="status <?php echo $requirements['xml'] ? 'pass' : 'fail'; ?>">
                    <?php echo $requirements['xml'] ? 'LOADED' : 'MISSING'; ?>
                </span>
            </li>
            <li>
                Content Directory Writable: 
                <span class="status <?php echo $requirements['writable'] ? 'pass' : 'fail'; ?>">
                    <?php echo $requirements['writable'] ? 'YES' : 'NO (Check Permissions)'; ?>
                </span>
            </li>
        </ul>

        <?php if (!in_array(false, $requirements, true)): ?>
            <p style="color: #155724; font-weight: bold;">✅ Your Web Server is fully optimized for the v3.4 Laboratory!</p>
        <?php else: ?>
            <p style="color: #721c24; font-weight: bold;">❌ Fix the red items above before proceeding.</p>
        <?php endif; ?>
        
        <small>Path: <?php echo __FILE__; ?></small>
    </div>
</body>
</html>
