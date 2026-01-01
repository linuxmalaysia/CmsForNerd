<article class="template-guide">
    <h1>🎨 CmsForNerd v3.4 Laboratory Guide</h1>
    <p class="subtitle">Mastering the "Pair Logic" & Context Engine</p>

    <div class="intro-box">
        <p>
            The <code>template.php</code> file acts as the <strong>Front Controller</strong>. In v3.4, it initializes the immutable <code>CmsContext</code> object, ensuring that metadata and security nonces are carried safely into the theme engine.
        </p>
    </div>

    <section class="guide-step">
        <h2>📂 Step 1: Locate the Folders</h2>
        <p>Focus on these key areas in the Laboratory environment:</p>
        <ul>
            <li><strong>Root Directory:</strong> Public <code>.php</code> entry points (e.g., <code>about.php</code>).</li>
            <li><strong>contents/ Directory:</strong> Raw "body" fragments (<code>-body.inc</code> files).</li>
            <li><strong>src/ & includes/:</strong> The core engine and security utility classes.</li>
        </ul>
    </section>

    <section class="guide-step">
        <h2>📝 Step 2: Create Your Content (.inc file)</h2>
        <p>Code only the internal HTML structure for your page.</p>
        <ol>
            <li>Create a new file inside <code>contents/</code>.</li>
            <li><strong>Naming Rule:</strong> Match your entry point name (e.g., <code>contact-body.inc</code>).</li>
            <li>Use semantic HTML5 tags for better SEO and accessibility.</li>
        </ol>
        <div class="code-example">
            <h3>Example: <code>contents/contact-body.inc</code></h3>
            <pre><code>&lt;section class="contact-page"&gt;
    &lt;h1&gt;Contact Us&lt;/h1&gt;
    &lt;p&gt;Send a message to the lab administrators.&lt;/p&gt;
&lt;/section&gt;</code></pre>
        </div>
    </section>

    <section class="guide-step">
        <h2>🚀 Step 3: Create Your Page (.php file)</h2>
        <p>Leverage the v3.4 boilerplate to instantiate the page.</p>
        <div class="code-example">
            <h3>Example: <code>contact.php</code></h3>
            <pre><code>&lt;?php
declare(strict_types=1);

$content = [
    'title'       => "Contact - CmsForNerd",
    'description' => "Secure contact entry point."
];

require_once __DIR__ . '/includes/bootstrap.php';
// The Factory handles the rest!
require_once __DIR__ . '/template.php';
?&gt;</code></pre>
        </div>
    </section>

    <section class="guide-step security-check">
        <h2>🛡️ Step 4: Verify Safety & Compliance</h2>
        <p>Before moving to production, you <strong>MUST</strong> perform these three checks to ensure the page is "Laboratory Safe":</p>
        <div class="check-grid">
            <div class="check-item">
                <h3>1. Static Analysis</h3>
                <p>Run <code>vendor/bin/phpstan analyze</code>. Your new page must show 0 errors at Level 8.</p>
            </div>
            <div class="check-item">
                <h3>2. CSP Nonce Verification</h3>
                <p>If you use <code>&lt;script&gt;</code>, you must use <code>$ctx->cspNonce</code> to prevent XSS blocking.</p>
            </div>
            <div class="check-item">
                <h3>3. Sanitization</h3>
                <p>Ensure your page name contains no special characters using <code>SecurityUtils::isValidPageName()</code>.</p>
            </div>
        </div>
    </section>

    <section class="standards-box">
        <h2>⚖️ Laboratory Standards (v3.4 Update)</h2>
        <ul>
            <li><strong>MUST:</strong> Use <code>declare(strict_types=1);</code> in all new <code>.php</code> files.</li>
            <li><strong>MUST NOT:</strong> Use <code>$_GET</code> or <code>$_POST</code> directly; use the <code>SecurityUtils</code> filters.</li>
            <li><strong>REQUIRED:</strong> Ensure <code>CmsContext</code> is the only object passing data to your theme.</li>
        </ul>
    </section>
</article>

<style>
.template-guide h1 { color: #8e44ad; border-bottom: 2px solid #8e44ad; padding-bottom: 0.5rem; }
.template-guide .subtitle { font-size: 1.2rem; color: #666; font-weight: bold; margin-bottom: 2rem; }
.template-guide .intro-box { background: #f3e5f5; padding: 1.5rem; border-radius: 8px; border-left: 5px solid #8e44ad; margin-bottom: 2rem; }
.template-guide .guide-step { margin-bottom: 3rem; }
.template-guide h2 { color: #333; border-bottom: 1px solid #eee; padding-bottom: 0.5rem; }
.template-guide .code-example { background: #1a1a1a; color: #fff; padding: 1rem; border-radius: 8px; margin: 1rem 0; }
.template-guide .code-example h3 { color: #e1bee7; margin-top: 0; font-size: 0.9rem; text-transform: uppercase; }
.template-guide .code-example pre { margin: 0; white-space: pre-wrap; word-break: break-all; }
.template-guide .code-example code { font-family: 'Consolas', monospace; color: #f0f0f0; }
.template-guide .security-check { background: #fff3e0; padding: 1.5rem; border-radius: 8px; border: 1px solid #ffe0b2; }
.template-guide .check-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-top: 1rem; }
.check-item { background: white; padding: 1rem; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
.check-item h3 { font-size: 1rem; color: #e65100; margin-top: 0; }
.template-guide .standards-box { background: #f8f9fa; padding: 1.5rem; border-radius: 8px; border: 1px solid #ddd; margin-top: 2rem; }
</style>
