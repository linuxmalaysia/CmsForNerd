<article class="lab-home">
    <header class="hero-section">
        <h1>Welcome to CMSForNerd v3.4: The Secure Coding Laboratory</h1>
        <div class="runtime-status">
            <span class="badge php-version">PHP <?= phpversion() ?></span>
            <span class="badge status-strict">Strict Mode: Active</span>
            <span class="badge status-check">PHPStan: Level 8</span>
        </div>
    </header>

    <div class="intro-box">
        <p>
            <strong>CMSForNerd</strong> is not just a CMS; it is a live training ground for <strong>Modern PHP Engineering</strong>. 
            While frameworks hide complexity, we expose it—teaching you to write code that is fast, immutable, and impenetrable. 
            Master the "Zero-Debt" workflow used by professional security auditors.
        </p>
        <div class="quick-links">
            <a href="lab-manual.php" class="btn lab-btn">🎓 Lab Manual</a>
            <a href="template-guide.php" class="btn guide-btn">🎨 Template Guide</a>
            <a href="linux-setup.php" class="btn linux-btn">🐧 Linux Setup</a>
        </div>
    </div>

    

    <section class="grid-features">
        <div class="feature-card">
            <h3>🛡️ Secure by Design</h3>
            <ul>
                <li><strong>Static Analysis:</strong> Pre-configured for PHPStan Level 8. Catch bugs before they run.</li>
                <li><strong>CSP Engine:</strong> Native Content Security Policy with automatic Nonce generation.</li>
                <li><strong>Immutable Context:</strong> Uses <code>readonly</code> classes to prevent global state corruption.</li>
                <li><strong>Path Protection:</strong> Strict sanitization of page names to stop Directory Traversal.</li>
            </ul>
        </div>

        <div class="feature-card">
            <h3>🚀 Training Features (v3.4)</h3>
            <ul>
                <li><strong>Zero-Debt Coding:</strong> Learn to eliminate "Variable might be undefined" errors forever.</li>
                <li><strong>Type Mastery:</strong> Move beyond basic types to <code>iterable</code> shapes and generic arrays.</li>
                <li><strong>No Magic:</strong> Every include, class, and function is visible and documented for learning.</li>
                <li><strong>PHP 8.4 Core:</strong> Utilizing the latest engine features for maximum performance.</li>
            </ul>
        </div>
    </section>

    <section class="lab-workflow">
        <h3>The "Nerd-Stack" Secure Workflow</h3>
        <div class="workflow-steps">
            <div class="step">
                <span class="step-num">1</span>
                <h4>Code</h4>
                <p>Write clean PHP 8.4 using the <code>CmsContext</code>.</p>
            </div>
            <div class="step">
                <span class="step-num">2</span>
                <h4>Analyze</h4>
                <p>Run <code>phpstan</code> to verify type safety and logic.</p>
            </div>
            <div class="step">
                <span class="step-num">3</span>
                <h4>Protect</h4>
                <p>The system applies CSP headers and path filters.</p>
            </div>
        </div>
    </section>

    <section class="stack-recommendation">
        <h3>Optimized Learning Stack</h3>
        <table class="stack-table">
            <tr>
                <td><strong>IDE / Editor</strong></td>
                <td>VS Code or Google Antigravity (with PHPStan Extensions)</td>
            </tr>
            <tr>
                <td><strong>Web Server</strong></td>
                <td>Nginx 1.2x + PHP 8.4-FPM (Strict Mode)</td>
            </tr>
            <tr>
                <td><strong>Security Tools</strong></td>
                <td>Mozilla Firefox Console + OWASP ZAP for lab testing</td>
            </tr>
        </table>
    </section>
</article>

<style>
    .lab-home { max-width: 1000px; margin: 0 auto; line-height: 1.6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    .hero-section h1 { color: #2c3e50; border-bottom: 4px solid #8e44ad; padding-bottom: 10px; margin-bottom: 10px; }
    
    .runtime-status { margin-bottom: 25px; }
    .badge { display: inline-block; padding: 4px 12px; border-radius: 4px; font-size: 0.85rem; font-weight: bold; margin-right: 5px; }
    .php-version { background: #4F5B93; color: white; }
    .status-strict { background: #27ae60; color: white; }
    .status-check { background: #f39c12; color: white; }

    .intro-box { background: #f4f7f6; padding: 30px; border-radius: 12px; border-left: 6px solid #8e44ad; margin-bottom: 40px; }
    .quick-links { margin-top: 20px; display: flex; gap: 10px; flex-wrap: wrap; }
    
    .btn { padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold; color: white; transition: all 0.2s ease; }
    .lab-btn { background: #c0392b; }
    .guide-btn { background: #8e44ad; }
    .linux-btn { background: #2c3e50; }
    .btn:hover { filter: brightness(1.1); transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.1); }

    .grid-features { display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 25px; margin-bottom: 40px; }
    .feature-card { background: white; border: 1px solid #e0e0e0; padding: 25px; border-radius: 10px; }
    .feature-card h3 { color: #2c3e50; margin-top: 0; border-bottom: 1px solid #eee; padding-bottom: 10px; }
    .feature-card ul { padding-left: 20px; }
    .feature-card li { margin-bottom: 8px; }

    .lab-workflow { background: #2c3e50; color: white; padding: 30px; border-radius: 12px; margin-bottom: 40px; }
    .workflow-steps { display: flex; justify-content: space-around; gap: 20px; margin-top: 20px; text-align: center; }
    .step-num { background: #8e44ad; width: 40px; height: 40px; display: block; margin: 0 auto 10px; border-radius: 50%; line-height: 40px; font-weight: bold; font-size: 1.2rem; }
    .step h4 { margin-bottom: 5px; color: #ecf0f1; }
    .step p { font-size: 0.9rem; color: #bdc3c7; }

    .stack-table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; }
    .stack-table td { padding: 15px; border: 1px solid #eee; }
    .stack-table tr td:first-child { background: #f9f9f9; width: 30%; font-weight: bold; color: #7f8c8d; }
</style>
