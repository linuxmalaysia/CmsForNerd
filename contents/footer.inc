<?php
declare(strict_types=1);

// Load the helper to scan for internal laboratory pages
@include_once __DIR__ . '/../includes/nav-helper.inc.php';
?>

<div style="text-align: center; padding: 20px; border-top: 1px solid #eee;"> 
    
    <nav style="margin-bottom: 20px;">
        <p><strong>Laboratory Modules:</strong></p>
        <div style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap; margin-bottom: 10px;">
            <a href="index.php">Home</a>
            <?php 
            if (function_exists('get_site_pages')) {
                foreach (get_site_pages() as $url => $label) {
                    /**
                     * TYPE DEFENSE: 
                     * If $label is an array (from sitemap_generator), extract the 'title'.
                     * If $label is already a string (from nav-helper), use it directly.
                     */
                    $displayLabel = is_array($label) ? ($label['title'] ?? $url) : $label;
                    
                    // Sanitize output for security
                    $safeUrl = htmlspecialchars((string)$url);
                    $safeLabel = htmlspecialchars((string)$displayLabel);
                    
                    echo "<a href=\"$safeUrl\">$safeLabel</a>";
                }
            }
            ?>
        </div>
    </nav>

    <hr style="width: 50%; border: 0; border-top: 1px solid #ddd; margin: 20px auto;">

    <p>
        CmsForNerd Main Site: <a href="https://www.linuxmalaysia.com">https://www.linuxmalaysia.com</a>
        <br>
        CmsForNerd Blog: <a href="https://www.linuxmalaysia.com">https://www.linuxmalaysia.com</a>
        <br>
        Copyright &copy; 2005 - <?= date("Y") ?> Harisfazillah Jamel
    </p>
    
    <p style="font-size: 0.8rem; color: #666;">
        Standard: <strong>RFC 9116 Compliant</strong> | Environment: <strong>PHP 8.4</strong>
    </p>
</div>
