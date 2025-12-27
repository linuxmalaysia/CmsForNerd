<?php
/**
 * Nerd Hall of Fame Body
 * Recognizes students and researchers who follow "Good Faith" disclosure.
 */
$contributors = [
    ['name' => 'Nerd01', 'date' => '2025-10-12', 'fix' => 'XSS in Search'],
    ['name' => 'CyberPro', 'date' => '2025-11-05', 'fix' => 'CSRF on Login'],
    ['name' => 'Google Gemini', 'date' => '2025-12-27', 'fix' => 'Modernization v3.1']
];
?>
<div class="hall-of-fame">
    <h1>🏆 Nerd Hall of Fame</h1>
    <p>In the world of open source, recognition is the best reward. We honor those who find and fix bugs to keep the laboratory safe for everyone.</p>

    <ul class="contributor-list">
        <?php foreach($contributors as $c): ?>
            <li>
                <span class="contributor-name"><?= htmlspecialchars($c['name']) ?></span>
                <span class="contributor-fix"><?= htmlspecialchars($c['fix']) ?></span>
                <span class="contributor-date"><?= htmlspecialchars($c['date']) ?></span>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="nomination-box">
        <h3>Become a Legend</h3>
        <p>Found a bug? Follow our <a href="security-policy.php">Security Policy</a> to report it. Ethical disclosures are eligible for a permanent spot in this Hall of Fame.</p>
    </div>
</div>

<style>
.hall-of-fame h1 { color: #f39c12; border-bottom: 2px solid #f39c12; padding-bottom: 0.5rem; }
.contributor-list { list-style: none; padding: 0; margin-top: 2rem; }
.contributor-list li { background: #fff; border: 1px solid #eee; margin-bottom: 0.5rem; padding: 1rem; border-radius: 4px; display: flex; justify-content: space-between; align-items: center; }
.contributor-name { font-weight: bold; color: #d35400; flex: 1; }
.contributor-fix { flex: 2; font-style: italic; color: #555; }
.contributor-date { flex: 1; text-align: right; font-size: 0.9rem; color: #888; }
.nomination-box { margin-top: 3rem; background: #fffbe6; border: 1px solid #ffe58f; padding: 1.5rem; border-radius: 8px; text-align: center; }
.nomination-box h3 { margin-top: 0; color: #856404; }
</style>

