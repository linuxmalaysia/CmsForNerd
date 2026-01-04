<?php
/**
 * FILE: themes/CmsForNerd/amp-sidebar.tpl
 * ROLE: Interactive Slide-out navigation for AMP
 */
$navPages = get_site_pages();
$currentFile = ($ctx->scriptName ?? 'index') . '.php';
?>

<amp-sidebar id="sidebar" layout="nodisplay" side="left">
    <div class="sidebar-header">
        <span>LABORATORY</span>
        <button on="tap:sidebar.close" role="button" tabindex="0" class="close-btn">&times;</button>
    </div>
    
    <nav class="sidebar-nav">
        <ul>
            <li>
                <a href="index.php?view=amp" 
                   style="<?= ($currentFile === 'index.php') ? 'background: #f4f0f9; border-left: 5px solid #8e44ad;' : '' ?>">
                   🏠 Home
                </a>
            </li>

            <?php foreach ($navPages as $file => $label) : 
                $isActive = ($currentFile === $file);
                $activeStyle = $isActive ? 'background: #f4f0f9; border-left: 5px solid #8e44ad; color: #8e44ad;' : '';
            ?>
                <li>
                    <a href="<?= htmlspecialchars($file) ?>?view=amp" style="<?= $activeStyle ?>">
                        <?= htmlspecialchars($label) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</amp-sidebar>
