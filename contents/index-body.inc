<article class="lab-home">
    <header class="hero-section">
        <h1>Welcome to CMSForNerd v3.3: The Developer’s Laboratory</h1>
        <div class="runtime-badge">
            Currently running on: <strong>PHP <?= phpversion() ?></strong>
        </div>
    </header>

    <div class="intro-box">
        <p>
            <strong>CMSForNerd</strong> is a radically simple, database-free Content Management System designed as a live learning environment. 
            Unlike "black box" frameworks, it exposes the raw power of PHP 8.4 to help you master the full stack.
        </p>
        <div class="quick-links">
            <a href="lab-manual.php" class="btn lab-btn">🎓 Lab Manual</a>
            <a href="linux-setup.php" class="btn linux-btn">🐧 Linux Setup</a>
            <a href="windows-setup.php" class="btn win-btn">🪟 Windows Setup</a>
        </div>
    </div>

    <section class="grid-features">
        <div class="feature-card">
            <h3>Why "For Nerd"?</h3>
            <ul>
                <li><strong>No Database:</strong> Zero SQL overhead. Backups are just ZIP files.</li>
                <li><strong>Absolute Control:</strong> No "magic" plugins. You edit the logic directly.</li>
                <li><strong>Educational:</strong> Learn HTTP headers, PHP includes, and strict typing.</li>
            </ul>
        </div>

        <div class="feature-card">
            <h3>🚀 v3.3 Evolution (2025)</h3>
            <ul>
                <li><strong>PHP 9 Ready:</strong> Built with Property Hooks and Constructor Promotion.</li>
                <li><strong>Security First:</strong> Integrated Cloudflare Turnstile & Path Sanitization.</li>
                <li><strong>Cross-Platform:</strong> Tested on Linux (Debian/Alma), Windows 11, and FreeBSD.</li>
            </ul>
        </div>
    </section>

    <section class="stack-recommendation">
        <h3>Recommended Laboratory Stack</h3>
        <p>For the optimal "Nerd" experience, we recommend:</p>
        <table class="stack-table">
            <tr>
                <td><strong>Editor</strong></td>
                <td>Google Antigravity (AI Optimized)</td>
            </tr>
            <tr>
                <td><strong>Server</strong></td>
                <td>Nginx 1.2x with PHP 8.4-FPM</td>
            </tr>
            <tr>
                <td><strong>Browser</strong></td>
                <td>Mozilla Firefox (Strict Privacy Mode)</td>
            </tr>
        </table>
    </section>
</article>

<style>
    .lab-home { max-width: 1000px; margin: 0 auto; line-height: 1.6; }
    .hero-section h1 { color: #2c3e50; border-bottom: 4px solid #3498db; padding-bottom: 10px; }
    .runtime-badge { background: #f8f9fa; display: inline-block; padding: 5px 15px; border-radius: 20px; border: 1px solid #ddd; margin-bottom: 20px; }
    
    .intro-box { background: #eef2f7; padding: 25px; border-radius: 12px; border-left: 6px solid #3498db; margin-bottom: 40px; }
    .quick-links { margin-top: 20px; display: flex; gap: 10px; flex-wrap: wrap; }
    
    .btn { padding: 10px 20px; text-decoration: none; border-radius: 6px; font-weight: bold; color: white; transition: 0.3s; }
    .lab-btn { background: #d9534f; }
    .linux-btn { background: #2ecc71; }
    .win-btn { background: #0078d4; }
    .btn:hover { opacity: 0.8; transform: translateY(-2px); }

    .grid-features { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 40px; }
    .feature-card { background: white; border: 1px solid #eee; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    .feature-card h3 { color: #2980b9; margin-top: 0; }

    .stack-table { width: 100%; border-collapse: collapse; margin-top: 15px; }
    .stack-table td { padding: 12px; border: 1px solid #eee; }
    .stack-table tr td:first-child { background: #fdfdfd; width: 30%; }
</style>
