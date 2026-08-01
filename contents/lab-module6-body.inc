<article class="lab-worksheet">
    <h1>📊 Student Lab Worksheet: Module 6</h1>
    <p class="subtitle">Topic: OWASP Top 10 Hardening & PHP Site Performance</p>

    <p class="intro">
        In this advanced laboratory module, students will dive deep into defense-in-depth security engineering and extreme speed optimizations.
        You will configure <strong>CSRF Protection</strong>, enforce <strong>OWASP Compliant HTTP Response Headers</strong>, and implement a highly effective <strong>Static Page & Metadata Caching Layer</strong>.
    </p>

    <div class="requirement-alert">
        <strong>Requirement Level:</strong> Students <strong>MUST</strong> successfully pass all static analysis, styling, and PHPUnit compliance tests for both performance caching and secure cookies/tokens.
    </div>

    <section class="objectives">
        <h2>🎯 Learning Objectives</h2>
        <ul>
            <li>Understand <strong>OWASP Top 10</strong> vulnerabilities (A01: Access Control, A02: Cryptographic Failures, A04: Insecure Design).</li>
            <li>Enforce secure cookie parameters and cryptographically strong <strong>CSRF Validation</strong>.</li>
            <li>Deploy secure, custom HTTP Response Headers (HSTS, CSP, Referrer-Policy, Permissions-Policy).</li>
            <li>Build a Zero-dependency <strong>Static Page Cache</strong> with Smart Cache Invalidation and metadata JSON acceleration.</li>
        </ul>
    </section>

    <section class="step">
        <h2>⚙️ Step 1: Session & Cookie Hardening</h2>
        <p>Before using sessions for critical security tokens, the underlying cookies must be locked down to prevent hijacking and fixation.</p>
        <p><strong>Task:</strong> Configure secure session parameters in <code>SecurityUtils::startSecureSession()</code>:</p>
        <ul>
            <li>Enable <code>session.use_strict_mode</code> to prevent session fixation.</li>
            <li>Enable <code>session.use_only_cookies</code> to block URL-based session IDs.</li>
            <li>Set <code>session.cookie_httponly = true</code> and <code>session.cookie_secure = true</code> (dynamically over HTTPS).</li>
            <li>Enforce <code>SameSite = Strict</code> on session cookies.</li>
        </ul>
    </section>

    <section class="step">
        <h2>🧪 Step 2: Cross-Site Request Forgery (CSRF) Mitigation</h2>
        <p>Without CSRF protection, malicious websites can trick authenticated users into executing unauthorized commands on your CMS.</p>
        <div class="exercise">
            <h3>Exercise: Implement & Verify CSRF Handshake</h3>
            <ol>
                <li>Inject a hidden input containing a cryptographically secure token: <code>SecurityUtils::generateCsrfToken()</code>.</li>
                <li>Verify and enforce token matching on POST submission: <code>SecurityUtils::validateCsrfToken($_POST['csrf_token'] ?? null)</code>.</li>
                <li>Try submitting a POST request to <code>ujian-form.php</code> without the CSRF token and verify it gets rejected with an error!</li>
            </ol>
        </div>
    </section>

    <section class="step">
        <h2>🚀 Step 3: Server-Side Static Page Caching</h2>
        <p>By bypassing PHP engine processing and file operations for repeat pages, we achieve massive performance gains.</p>
        <p><strong>Task:</strong> Verify the Smart Caching lifecycle in <code>PerformanceUtils</code>:</p>
        <div class="terminal-block">
            <code>X-Cache: HIT (Response served from cached HTML file)</code><br>
            <code>X-Cache: MISS (Page rendered dynamically and cache stored)</code>
        </div>
        <p>Our caching layer features <strong>Smart Invalidation</strong>: If any content fragment under <code>contents/</code> or theme templates are updated, the cache is automatically rebuilt on the next request. This ensures total data consistency!</p>
    </section>

    <section class="step">
        <h2>✅ Step 4: Metadata Cache & Conditional HTTP</h2>
        <p>Instead of scanning the disk on every page load to discover pages, the system stores discovered page structures in <code>discovered_pages.json</code>. Furthermore, handling <code>304 Not Modified</code> conditional requests based on ETags (with precedence over Last-Modified) ensures clients don't redownload unchanged pages.</p>
        <p><strong>Task:</strong> Run the complete laboratory compliance suite to ensure 100% test success:</p>
        <div class="terminal-block">
            <code>composer lab-check</code>
        </div>
    </section>

    <footer class="standards-summary">
        <h2>🎓 Summary of RFC 2119 Standards for Module 6</h2>
        <ul>
            <li><strong>MUST:</strong> All forms accepting POST submissions <strong>MUST</strong> enforce CSRF tokens.</li>
            <li><strong>MUST:</strong> Session and Cookie parameters <strong>MUST</strong> use HttpOnly and secure-transport flags.</li>
            <li><strong>SHOULD:</strong> Dynamic controllers <strong>SHOULD</strong> leverage static page caches to reduce server execution load.</li>
        </ul>
    </footer>

    <nav class="progress-nav">
        <a href="lab-module5.php" class="btn prev">&lt; Previous: Module 5 (Test Coverage)</a>
        <a href="final-exam.php" class="btn next">Next: Final Exam (Break-Fix Challenge) &gt;</a>
    </nav>
</article>

<style>
.lab-worksheet h1 { color: #8a2be2; margin-bottom: 0.1rem; }
.lab-worksheet .subtitle { font-size: 1.2rem; color: #666; margin-bottom: 2rem; }
.lab-worksheet .requirement-alert { background: #fee7e7; border: 1px solid #fad2d2; color: #a94442; padding: 1rem; border-radius: 4px; margin-bottom: 2rem; }
.lab-worksheet h2 { color: #333; border-bottom: 1px solid #eee; padding-bottom: 0.5rem; margin-top: 2rem; }
.lab-worksheet .intro { background: #f8f9fa; padding: 1.5rem; border-radius: 8px; border-left: 5px solid #8a2be2; margin-bottom: 2rem; }
.lab-worksheet .terminal-block { background: #1a1a1a; color: #fff; padding: 1rem; font-family: 'Consolas', 'Monaco', monospace; border-radius: 4px; margin: 1rem 0; border-left: 5px solid #8a2be2; }
.lab-worksheet .terminal-block code { color: #cda8ff; }
.lab-worksheet .exercise { background: #fcfcfc; padding: 1.5rem; border: 1px solid #e1e1e1; border-radius: 8px; margin: 1rem 0; }
.lab-worksheet .question-box { background: #fee7e7; border: 1px solid #fad2d2; color: #9a2020; padding: 1.5rem; border-radius: 8px; margin: 2rem 0; }
.lab-worksheet .standards-summary { margin-top: 3rem; background: #f8f9fa; padding: 1.5rem; border-radius: 8px; border: 1px solid #eee; }
.progress-nav { display: flex; justify-content: space-between; margin-top: 3rem; padding: 2rem 0; border-top: 2px solid #eee; }
.progress-nav .btn { padding: 1rem 1.5rem; border-radius: 4px; text-decoration: none; font-weight: bold; }
.progress-nav .prev { background: #6c757d; color: #fff; }
.progress-nav .next { background: #8a2be2; color: #fff; }
@media (max-width: 768px) { .progress-nav { flex-direction: column; gap: 1rem; } }
</style>
