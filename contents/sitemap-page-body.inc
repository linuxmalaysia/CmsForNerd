<?php
/**
 * Dynamic HTML Sitemap - Slave Fragment
 * EDUCATIONAL NOTE: We use a specific variable name ($sitemapData) 
 * to avoid conflicts with global theme variables.
 */

// Load the generator
require_once dirname(__DIR__) . '/includes/sitemap_generator.php';

// Call our newly renamed function
$sitemapData = get_detailed_site_pages();
?>

<div class="sitemap-list" style="padding: 20px;">
    <h2>Laboratory Sitemap</h2>
    
    <?php if (empty($sitemapData)): ?>
        <p style="background: #fff3cd; padding: 15px; border: 1px solid #ffeeba;">
            <strong>Notice:</strong> No page pairs found. Ensure your <code>contents/</code> folder 
            contains <code>-body.inc</code> files and the root contains matching <code>.php</code> files.
        </p>
    <?php else: ?>
        <ul style="line-height: 2;">
            <?php foreach ($sitemapData as $item) : ?>
                <li>
                    <a href="<?= htmlspecialchars($item['url']) ?>" style="font-weight: bold; color: #8e44ad;">
                        <?= htmlspecialchars($item['title']) ?>
                    </a>
                    <span style="color: #999; font-size: 0.8rem;">
                        (Updated: <?= htmlspecialchars($item['lastmod']) ?>)
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <hr style="margin: 30px 0; border: 0; border-top: 1px solid #eee;">

    <p>
        <a href="sitemap.php">
            <img src="https://upload.wikimedia.org/wikipedia/commons/4/43/Feed-icon.svg" width="16" height="16" alt="RSS">
            View XML Version
        </a>
    </p>
</div>
