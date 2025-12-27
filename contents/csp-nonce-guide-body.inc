<article class="csp-guide">
    <h1>🛡️ CSP Nonce Implementation Guide</h1>
    <p class="intro">
        Implementing a <strong>Content Security Policy (CSP) Nonce</strong> is one of the most effective ways to stop 
        <strong>Cross-Site Scripting (XSS)</strong> while still allowing necessary inline scripts to run.
    </p>

    <section class="overview">
        <h2>What is a CSP Nonce?</h2>
        <p>
            A <strong>nonce</strong> (number used once) is a cryptographically random string generated for each page load. 
            Only scripts with this exact nonce are allowed to execute, creating an impenetrable barrier against XSS attacks.
        </p>
        <div class="highlight-box">
            <p><strong>Key Concept:</strong> Instead of allowing all inline scripts (<code>'unsafe-inline'</code>), 
            we use a unique token that changes every request. Attackers can't predict the nonce, so injected scripts fail.</p>
        </div>
    </section>

    <section class="implementation">
        <h2>Step 1: Generate the Nonce</h2>
        <p>Use <code>random_bytes()</code> to generate 16 bytes of cryptographically secure randomness.</p>
        
        <div class="code-block">
            <h3>SecurityUtils.php</h3>
            <pre><code><?php echo htmlspecialchars('<?php
public static function generateNonce(): string
{
    // Generate a 128-bit (16-byte) random nonce
    return base64_encode(random_bytes(16));
}
?>'); ?></code></pre>
        </div>

        <p><strong>Why 16 bytes?</strong> This creates a 128-bit nonce (2^128 possible values), making brute-force attacks mathematically impossible.</p>
    </section>

    <section class="implementation">
        <h2>Step 2: Store in Context (CMSForNerd Pattern)</h2>
        <p>In our architecture, we store the nonce in the <code>CmsContext</code> object so it's available throughout the request lifecycle.</p>
        
        <div class="code-block">
            <h3>CmsContext.php</h3>
            <pre><code><?php echo htmlspecialchars('<?php
readonly class CmsContext
{
    public string $cspNonce;

    public function __construct(
        // ... other parameters
        ?string $cspNonce = null,
    ) {
        // Auto-generate if not provided
        $this->cspNonce = $cspNonce ?? SecurityUtils::generateNonce();
    }
}
?>'); ?></code></pre>
        </div>
    </section>

    <section class="implementation">
        <h2>Step 3: Send the CSP Header</h2>
        <p>The CSP header <strong>MUST</strong> be sent before any HTML output. We use a <code>&lt;meta&gt;</code> tag in the <code>&lt;head&gt;</code>.</p>
        
        <div class="code-block">
            <h3>common-headertag.inc</h3>
            <pre><code><?php echo htmlspecialchars('<meta http-equiv="Content-Security-Policy" 
      content="script-src \'self\' \'nonce-<?= $ctx->cspNonce ?>\' https://challenges.cloudflare.com;">'); ?></code></pre>
        </div>

        <div class="warning-box">
            <p>⚠️ <strong>Notice:</strong> No <code>'unsafe-inline'</code> or <code>'unsafe-eval'</code>! 
            This is the key security improvement that blocks XSS attacks.</p>
        </div>
    </section>

    <section class="implementation">
        <h2>Step 4: Apply Nonce to Scripts</h2>
        <p>Any <code>&lt;script&gt;</code> tag—whether inline or external—must include the <code>nonce</code> attribute.</p>
        
        <div class="comparison">
            <div class="before">
                <h3>❌ Before (Vulnerable)</h3>
                <pre><code><?php echo htmlspecialchars('<script>
    console.log("This will run");
</script>

<script>
    // ATTACKER INJECTED THIS!
    alert(document.cookie);
</script>'); ?></code></pre>
                <p class="danger">Both scripts execute! The attacker wins.</p>
            </div>

            <div class="after">
                <h3>✅ After (Secure)</h3>
                <pre><code><?php echo htmlspecialchars('<script nonce="<?= $ctx->cspNonce ?>">
    console.log("This will run");
</script>

<script>
    // ATTACKER INJECTED THIS!
    alert(document.cookie);
</script>'); ?></code></pre>
                <p class="success">Only the first script runs! The injected script is blocked by CSP.</p>
            </div>
        </div>
    </section>

    <section class="best-practices">
        <h2>🎯 Best Practices</h2>
        
        <div class="practice-box">
            <h3>1. Never Reuse Nonces</h3>
            <p>A new nonce <strong>MUST</strong> be generated for every single page load. Reusing nonces defeats the entire purpose.</p>
            <pre><code><?php echo htmlspecialchars('// ❌ BAD: Static nonce
$nonce = "abc123"; 

// ✅ GOOD: Random per request
$nonce = base64_encode(random_bytes(16));'); ?></code></pre>
        </div>

        <div class="practice-box">
            <h3>2. Remove 'unsafe-inline'</h3>
            <p>Using a nonce allows you to completely remove <code>'unsafe-inline'</code> from your policy, significantly hardening your site.</p>
        </div>

        <div class="practice-box">
            <h3>3. Consider 'strict-dynamic'</h3>
            <p>If your scripts dynamically load other scripts, add <code>'strict-dynamic'</code> to trust scripts loaded by nonced scripts.</p>
            <pre><code><?php echo htmlspecialchars('script-src \'self\' \'nonce-XXXXX\' \'strict-dynamic\';'); ?></code></pre>
        </div>

        <div class="practice-box">
            <h3>4. Test with Report-Only</h3>
            <p>Use <code>Content-Security-Policy-Report-Only</code> to see what would be blocked without breaking your site.</p>
            <pre><code><?php echo htmlspecialchars('<meta http-equiv="Content-Security-Policy-Report-Only" 
      content="script-src \'self\' \'nonce-XXXXX\'; report-uri /csp-report">'); ?></code></pre>
        </div>
    </section>

    <section class="live-demo">
        <h2>🔍 Live Demo: Inspect This Page!</h2>
        <p>This very page uses CSP nonces! Open your browser's DevTools:</p>
        <ol>
            <li>Press <kbd>F12</kbd> or <kbd>Ctrl+Shift+I</kbd></li>
            <li>Go to the <strong>Network</strong> tab and reload the page</li>
            <li>Click on this page's request and view the <strong>Headers</strong></li>
            <li>Look for <code>Content-Security-Policy</code> - you'll see <code>nonce-XXXXX</code></li>
            <li>View the page source and find the <code>&lt;script&gt;</code> tags - they all have matching nonces!</li>
        </ol>
        
        <div class="try-it">
            <h3>🧪 Challenge: Try to Attack This Page</h3>
            <p>Open the browser console and try to inject a script:</p>
            <pre><code>var script = document.createElement('script');
script.textContent = 'alert("Hacked!");';
document.body.appendChild(script);</code></pre>
            <p class="success">
                <strong>Result:</strong> The CSP will block it! You'll see an error in the console: 
                <em>"Refused to execute inline script because it violates the following Content Security Policy..."</em>
            </p>
        </div>
    </section>

    <section class="cmsfornerd-implementation">
        <h2>📚 CMSForNerd Implementation</h2>
        <p>Our implementation follows Google's security model. Here's the complete flow:</p>
        
        <div class="flow-diagram">
            <ol class="flow-steps">
                <li><strong>Request arrives</strong> → <code>index.php</code> starts</li>
                <li><strong>Context created</strong> → <code>SecurityUtils::generateNonce()</code> called</li>
                <li><strong>Nonce stored</strong> → <code>$ctx->cspNonce</code> available globally</li>
                <li><strong>Header sent</strong> → CSP with nonce in <code>common-headertag.inc</code></li>
                <li><strong>Scripts tagged</strong> → All <code>&lt;script&gt;</code> tags get <code>nonce="<?= $ctx->cspNonce ?>"</code></li>
                <li><strong>Page renders</strong> → Only nonced scripts execute</li>
            </ol>
        </div>

        <p><strong>Files to Study:</strong></p>
        <ul>
            <li><code>includes/SecurityUtils.php</code> - Nonce generation</li>
            <li><code>includes/CmsContext.php</code> - Nonce storage</li>
            <li><code>contents/common-headertag.inc</code> - CSP header and script tags</li>
        </ul>
    </section>

    <nav class="footer-nav">
        <a href="lab-module3.php" class="btn">← Return to Module 3</a>
        <a href="security-policy.php" class="btn">Security Policy →</a>
    </nav>
</article>

<style>
.csp-guide h1 { color: #c7254e; border-bottom: 3px solid #c7254e; padding-bottom: 0.5rem; }
.csp-guide .intro { font-size: 1.1rem; background: #fff3cd; padding: 1.5rem; border-radius: 8px; border-left: 5px solid #ffc107; }
.csp-guide section { margin: 3rem 0; }
.csp-guide h2 { color: #d9534f; border-left: 5px solid #d9534f; padding-left: 1rem; margin-top: 2rem; }
.csp-guide .highlight-box { background: #e7f3ff; padding: 1.5rem; border-radius: 8px; border-left: 5px solid #0066cc; margin: 1rem 0; }
.csp-guide .warning-box { background: #fff3e0; padding: 1.5rem; border-radius: 8px; border: 2px solid #ff6f00; margin: 1rem 0; }
.csp-guide .code-block { background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin: 1rem 0; border: 1px solid #dee2e6; }
.csp-guide .code-block h3 { margin-top: 0; color: #5a5a5a; font-size: 0.9rem; text-transform: uppercase; }
.csp-guide pre { background: #2d2d2d; color: #f8f8f2; padding: 1rem; border-radius: 4px; overflow-x: auto; }
.csp-guide code { font-family: 'Courier New', monospace; font-size: 0.9rem; }
.csp-guide .comparison { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin: 2rem 0; }
.csp-guide .before, .csp-guide .after { background: #fff; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
.csp-guide .before { border-left: 5px solid #d9534f; }
.csp-guide .after { border-left: 5px solid #5cb85c; }
.csp-guide .danger { color: #d9534f; font-weight: bold; }
.csp-guide .success { color: #5cb85c; font-weight: bold; }
.csp-guide .practice-box { background: #f0f8ff; padding: 1.5rem; border-radius: 8px; margin: 1rem 0; border-left: 4px solid #0066cc; }
.csp-guide .practice-box h3 { margin-top: 0; color: #004499; }
.csp-guide .try-it { background: #fff8dc; padding: 2rem; border-radius: 8px; border: 2px dashed #ffa500; margin: 2rem 0; }
.csp-guide .flow-steps { background: #f8f9fa; padding: 2rem; border-radius: 8px; list-style-position: inside; }
.csp-guide .flow-steps li { padding: 0.5rem 0; }
.csp-guide kbd { background: #333; color: #fff; padding: 0.2rem 0.5rem; border-radius: 3px; font-family: monospace; }
.csp-guide .footer-nav { text-align: center; margin: 3rem 0; padding: 2rem; border-top: 2px solid #eee; }
.csp-guide .btn { display: inline-block; margin: 0.5rem; padding: 0.75rem 1.5rem; background: #d9534f; color: white; text-decoration: none; border-radius: 4px; }
.csp-guide .btn:hover { background: #c9302c; }
@media (max-width: 768px) {
    .csp-guide .comparison { grid-template-columns: 1fr; }
}
</style>

