<article class="lab-worksheet">
    <h1>Student Lab Worksheet: Module 3</h1>
    <p class="subtitle">Topic: Defensive Engineering & Perimeter Security</p>

    <div class="requirement-alert">
        <strong>Requirement Level:</strong> Students <strong>MUST</strong> successfully implement a "Level 2" CSP and secure the file loader to achieve "Green-Light" status.
    </div>

    <section class="objectives">
        <h2>🎯 Learning Objectives</h2>
        <ul>
            <li>Understand <strong>Defense-in-Depth</strong> strategies.</li>
            <li>Eliminate <strong>Path Traversal</strong> vulnerabilities using allowlist sanitization.</li>
            <li>Configure a <strong>Content Security Policy (CSP)</strong> to neutralize XSS.</li>
            <li>Implement <strong>Bot Defense</strong> using Cloudflare Turnstile.</li>
        </ul>
    </section>

    <section class="step">
        <h2>🧱 Step 1: The "Defense-in-Depth" Concept</h2>
        <p>Security is like an onion. If one layer fails, another must catch the attacker. In CmsForNerd, we use three primary layers:</p>
        <ol>
            <li><strong>The Code Layer:</strong> Sanitizing inputs (e.g., using <code>SecurityUtils</code>).</li>
            <li><strong>The Browser Layer:</strong> Using CSP to tell the browser what scripts to trust.</li>
            <li><strong>The Network Layer:</strong> Using Turnstile to block automated bots.</li>
        </ol>
    </section>

    <section class="step">
        <h2>🧪 Step 2: Input Hardening (Path Traversal)</h2>
        <p>In legacy versions of CMSForNerd, the code was vulnerable to <strong>Dot-Dot-Slash (../)</strong> attacks:</p>
        <div class="code-block legacy">
            <pre><code>// VULNERABLE CODE - DO NOT USE
$page = $_GET['page'];
include "contents/" . $page . ".php";</code></pre>
        </div>
        <p><strong>Exercise:</strong> Open <code>includes/SecurityUtils.php</code> and ensure <code>sanitizePageName()</code> is used in <code>index.php</code> to neutralize non-alphanumeric characters.</p>
        <div class="code-block modern">
            <pre><code>public static function sanitizePageName(string $pageName): string
{
    // MUST: Only allow alphanumeric characters and hyphens.
    return preg_replace('/[^a-zA-Z0-9\-]/', '', $pageName);
}</code></pre>
        </div>
    </section>

    <section class="step">
        <h2>🧪 Step 3: Neutralizing XSS with CSP</h2>
        <p>Even if an attacker injects a malicious script, a strong <strong>Content Security Policy</strong> can block its execution.</p>
        <p><strong>Task:</strong> Open <code>themes/CmsForNerd/bodytop.tpl</code> and locate the CSP meta tag. Update it to <strong>MUST NOT</strong> allow scripts from untrusted domains.</p>
        <div class="code-block html">
            <pre><code>&lt;meta http-equiv="Content-Security-Policy" content="
    default-src 'self'; 
    script-src 'self' https://challenges.cloudflare.com;
    style-src 'self' 'unsafe-inline';
"&gt;</code></pre>
        </div>
    </section>

    <section class="step">
        <h2>🤖 Step 4: Implementing Turnstile (Bot Defense)</h2>
        <p>We use <strong>Cloudflare Turnstile</strong> to verify "humanness" without frustrating users with traditional CAPTCHAs.</p>
        <p><strong>Task:</strong> Integrate the Turnstile widget.</p>
        <ol>
            <li>Add the API script to your <code>&lt;head&gt;</code>:
                <div class="code-block html"><code>&lt;script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer&gt;&lt;/script&gt;</code></div>
            </li>
            <li>Place the widget inside your <code>&lt;form&gt;</code>:
                <div class="code-block html"><code>&lt;div class="cf-turnstile" data-sitekey="your-site-key"&gt;&lt;/div&gt;</code></div>
            </li>
        </ol>
    </section>

    <section class="step">
        <h2>✅ Step 5: The "Attack & Defend" Audit</h2>
        
        <h3>5.1: Programmatic Defense</h3>
        <p>Run the test suite to verify Path Traversal protection:</p>
        <div class="terminal-block"><code>./vendor/bin/phpunit --filter it_prevents_directory_traversal_attacks</code></div>

        <h3>5.2: Perimeter Testing</h3>
        <ol>
            <li>Try to inject an external image: <code>&lt;img src="http://evil.com/trap.jpg"&gt;</code>.</li>
            <li><strong>Result:</strong> Open Browser Console (F12). You <strong>MUST</strong> see a CSP error.</li>
        </ol>

        <div class="question-box">
            <p><strong>Question for the Student:</strong> Why is a CSP considered a "Fail-Safe" for XSS vulnerabilities?</p>
            <p class="hint">(Hint: What happens if you forget to use <code>escapeHtml()</code> on a user comment?)</p>
        </div>
    </section>

    <footer class="standards-summary">
        <h2>🎓 Summary of RFC 2119 Standards for Module 3</h2>
        <ul>
            <li><strong>MUST:</strong> All external assets (scripts/fonts) <strong>MUST</strong> be explicitly allowed in the CSP.</li>
            <li><strong>MUST:</strong> Use <code>preg_replace</code> to strip non-alphanumeric characters from file paths.</li>
            <li><strong>SHOULD:</strong> Avoid using <code>'unsafe-inline'</code> in your CSP whenever possible.</li>
            <li><strong>MUST NOT:</strong> Use the <code>http://</code> protocol for external resources; only <strong>https://</strong> is permitted.</li>
        </ul>
    </footer>

    <nav class="progress-nav">
        <a href="lab-module2.php" class="btn prev">&lt; Previous: Module 2 (Standards)</a>
        <a href="lab-module4.php" class="btn next">Next: Module 4 (Automated Testing) &gt;</a>
    </nav>
</article>

<style>
.lab-worksheet h1 { color: #d9534f; margin-bottom: 0.1rem; }
.lab-worksheet .subtitle { font-size: 1.2rem; color: #777; margin-bottom: 2rem; }
.lab-worksheet .requirement-alert { background: #fcf8e3; border: 1px solid #faebcc; color: #8a6d3b; padding: 1rem; border-radius: 4px; margin-bottom: 2rem; }
.lab-worksheet h2 { color: #333; border-bottom: 1px solid #eee; padding-bottom: 0.5rem; margin-top: 2rem; }
.lab-worksheet .code-block { background: #2d2d2d; color: #ccc; padding: 1rem; border-radius: 4px; overflow-x: auto; margin: 1rem 0; }
.lab-worksheet .code-block.legacy { border-left: 5px solid #d9534f; }
.lab-worksheet .code-block.modern { border-left: 5px solid #5cb85c; }
.lab-worksheet .terminal-block { background: #000; color: #00ff00; padding: 1rem; font-family: 'Courier New', Courier, monospace; border-radius: 4px; margin: 1rem 0; }
.lab-worksheet .question-box { background: #d9edf7; border: 1px solid #bce8f1; color: #31708f; padding: 1rem; border-radius: 4px; margin: 2rem 0; }
.lab-worksheet .standards-summary { margin-top: 3rem; background: #f5f5f5; padding: 1.5rem; border-radius: 8px; }
.progress-nav { display: flex; justify-content: space-between; margin-top: 3rem; padding: 2rem 0; border-top: 2px solid #eee; }
.progress-nav .btn { padding: 1rem 1.5rem; border-radius: 4px; text-decoration: none; font-weight: bold; }
.progress-nav .prev { background: #6c757d; color: #fff; }
.progress-nav .next { background: #d9534f; color: #fff; }
@media (max-width: 768px) { .progress-nav { flex-direction: column; gap: 1rem; } }
</style>
