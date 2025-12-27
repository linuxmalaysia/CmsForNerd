<!-- Dynamic HTML Sitemap -->
<?php
require_once 'includes/sitemap_generator.php';
$pages = get_site_pages();
?>

<div class="sitemap-list">
    <h2>Site Pages</h2>
    <ul>
    <?php foreach ($pages as $page): ?>
        <li>
            <a href="<?= $page['url'] ?>" title="<?= $page['title'] ?>">
                <?= $page['title'] ?>
            </a>
            <small>(Updated: <?= $page['lastmod'] ?>)</small>
        </li>
    <?php endforeach; ?>
    </ul>
    
    <hr>
    
    <p>
        <a href="sitemap.php" target="_blank">
            <img src="https://upload.wikimedia.org/wikipedia/commons/4/43/Feed-icon.svg" width="16" height="16" alt="XML">
            XML Sitemap for Search Engines
        </a>
    </p>
</div>
