<article class="security-policy" itemscope itemtype="https://schema.org/WebPage">
    <header class="policy-header">
        <h1 itemprop="headline">🛡️ Security Policy & Disclosure</h1>
        <p class="intro">
            At <strong>CMSForNerd</strong>, we take the security of our users seriously. We follow a "Defense-in-Depth" 
            strategy and appreciate the assistance of security researchers in keeping our laboratory safe.
        </p>
    </header>

    <section class="policy-section">
        <h2>1. Reporting a Vulnerability</h2>
        <p>Please do not use public GitHub issues for security reports. Instead, email your findings to <strong>security@cmsfornerd.test</strong>.</p>
        
        <div class="requirements-box">
            <ul>
                <li><strong>RFC 2119 MUST:</strong> Include a detailed description of the vulnerability.</li>
                <li><strong>RFC 2119 MUST:</strong> Provide a Proof of Concept (PoC) or reproduction steps.</li>
                <li><strong>RFC 2119 SHOULD:</strong> Include potential impact and mitigation suggestions.</li>
            </ul>
        </div>
    </section>

    <section class="policy-section">
        <h2>2. Our Commitment</h2>
        <p>For all valid reports submitted via the proper channels, we commit to:</p>
        <div class="grid-commitment">
            <div class="commit-card">
                <h3>72 Hours</h3>
                <p>Initial acknowledgment of receipt.</p>
            </div>
            <div class="commit-card">
                <h3>Full Transparency</h3>
                <p>Regular updates during the patch lifecycle.</p>
            </div>
            <div class="commit-card">
                <h3>Recognition</h3>
                <p>Credit in our Hall of Fame for "Good Faith" researchers.</p>
            </div>
        </div>
    </section>

    <section class="policy-section prohibited">
        <h2>3. Prohibited Actions</h2>
        <p>To remain in "Good Faith" status, researchers <strong>MUST NOT</strong>:</p>
        <ul class="danger-list">
            <li>Attempt Denial of Service (DoS/DDoS) attacks.</li>
            <li>Access, modify, or delete data not belonging to your test account.</li>
            <li>Use Social Engineering or Phishing against laboratory students.</li>
            <li>Exfiltrate data beyond what is necessary to prove the vulnerability.</li>
        </ul>
    </section>

    <nav class="footer-nav">
        <p>Review our technical security guides:</p>
        <div class="btn-group">
            <a href="csp-nonce-guide.php" class="btn btn-secondary">🛡️ CSP Nonce Guide</a>
            <a href="lab-manual.php" class="btn btn-primary">Return to Lab Manual</a>
        </div>
    </nav>
</article>

<style>
    :root { --policy-red: #d9534f; --policy-green: #2e7d32; --policy-gray: #f8f9fa; }
    .security-policy { max-width: 850px; margin: 0 auto; line-height: 1.7; }
    .policy-header h1 { color: var(--policy-red); border-bottom: 3px solid var(--policy-red); padding-bottom: 10px; }
    .intro { background: #fff3cd; padding: 20px; border-radius: 8px; border-left: 5px solid #ffc107; margin: 20px 0; }
    .policy-section { margin-bottom: 40px; }
    .requirements-box { background: var(--policy-gray); padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
    .grid-commitment { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-top: 20px; }
    .commit-card { background: #e8f5e9; padding: 15px; border-radius: 8px; text-align: center; border: 1px solid #c8e6c9; }
    .commit-card h3 { margin-top: 0; color: var(--policy-green); }
    .danger-list li { color: #c62828; margin-bottom: 8px; font-weight: 500; }
    .footer-nav { text-align: center; margin-top: 50px; border-top: 1px solid #eee; padding-top: 30px; }
    .btn { padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold; display: inline-block; margin: 5px; }
    .btn-primary { background: var(--policy-red); color: white; }
    .btn-secondary { background: #eee; color: #333; }
</style>
