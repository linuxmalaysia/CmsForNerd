<article class="ai-sop">
    <h1>📜 SOP: Responsible AI Usage in the Lab</h1>
    <div class="sop-header">
        <p><strong>Standard Operating Procedure #2025-01</strong></p>
        <p><strong>Effective Date:</strong> 27 December 2025</p>
    </div>

    <section class="objective">
        <h2>🎯 Objective</h2>
        <p>
            To leverage AI (Gemini/ChatGPT/Antigravity) to accelerate learning and debugging while maintaining 
            individual coding integrity and RFC 2119 compliance.
        </p>
    </section>

    <section class="rule">
        <h2>1. The "Think First" Rule</h2>
        <div class="rule-box">
            <p><strong>MUST:</strong> Before prompting an AI, a student <strong>MUST</strong> attempt to solve the problem for 10 minutes using the existing documentation and the <code>SecurityUtils</code> source code.</p>
        </div>
        <p><strong>Rationale:</strong> AI is a tool to enhance understanding, not replace critical thinking. The best engineers solve problems independently before seeking assistance.</p>
    </section>

    <section class="rule">
        <h2>2. The "Context Injection" Strategy</h2>
        <p>To get the best help from an AI, students <strong>SHOULD</strong> provide the context we built in the <code>.vscode</code> and <code>.cursorrules</code> files.</p>
        
        <div class="prompt-pattern">
            <h3>The "Nerd-Standard" Prompt Pattern:</h3>
            <blockquote>
                "I am working on <strong>CMSForNerd v3.1 (PHP 8.4)</strong> in VS Code. My Antigravity terminal is showing a PSR-12 error in <code>contents/search-body.inc</code>. How do I refactor this using property hooks while maintaining security?"
            </blockquote>
        </div>
        
        <p><strong>Why This Works:</strong> Specific context (project name, PHP version, error location) helps the AI provide accurate, standards-compliant solutions.</p>
    </section>

    <section class="rule">
        <h2>3. Verification & Auditing (The "Trust but Verify" Law)</h2>
        <p>AI-generated code <strong>MUST NOT</strong> be merged into the master branch until it passes the local audit suite.</p>
        
        <div class="workflow">
            <h3>The Mandatory Verification Loop:</h3>
            <ol>
                <li>Paste the AI suggestion into VS Code.</li>
                <li>Run <code>composer fix-style</code> to ensure the AI followed PSR-12.</li>
                <li>Run <code>composer test</code> to ensure the AI didn't break existing security logic.</li>
                <li>Run <code>composer compliance</code> to confirm the final "Green Bar" status.</li>
            </ol>
        </div>
        
        <div class="warning-box">
            <p>⚠️ <strong>WARNING:</strong> Code that bypasses the compliance suite is considered <strong>academic dishonesty</strong>.</p>
        </div>
    </section>

    <section class="rule">
        <h2>4. Prohibited AI Usage (Academic Integrity)</h2>
        <ul class="prohibited-list">
            <li><strong>DO NOT</strong> ask AI to "Complete the final exam for me."</li>
            <li><strong>DO NOT</strong> ignore AI warnings about "Insecure Code." If the AI says a pattern is dangerous, the student <strong>MUST</strong> investigate why.</li>
            <li><strong>DO NOT</strong> copy-paste code you do not understand. If you use an AI suggestion, you <strong>MUST</strong> be able to explain every line during the lab review.</li>
        </ul>
        <p><strong>Principle:</strong> AI is a <em>tutor</em>, not a <em>substitute</em> for learning.</p>
    </section>

    <section class="rule">
        <h2>5. AI as a Debugging Partner</h2>
        <p>Students are <strong>encouraged</strong> to use AI when they encounter "Cryptic Errors" in the Antigravity terminal.</p>
        
        <div class="workflow">
            <h3>Recommended Workflow:</h3>
            <ol>
                <li>Copy the error from Antigravity.</li>
                <li>Paste it into the AI with the command: <em>"Explain this error in the context of PHP 8.4 and help me find the line in my CMSForNerd project."</em></li>
                <li>Read the explanation carefully.</li>
                <li>Apply the fix and verify with <code>composer compliance</code>.</li>
            </ol>
        </div>
    </section>

    <section class="instructor-note">
        <h2>🎓 Instructor Note: AI Literacy in 2025</h2>
        <p>
            By including these files (<code>.vscode</code>, <code>.cursorrules</code>) and this SOP, you are teaching students 
            <strong>AI Literacy</strong>. You aren't just teaching them to code; you are teaching them how to work in a 
            2025 professional environment where AI and Humans collaborate.
        </p>
        <p><strong>Learning Outcome:</strong> Students who master this SOP will enter the workforce knowing how to be <em>effective AI partners</em>, not just passive AI consumers.</p>
    </section>

    <nav class="footer-nav">
        <p><strong>Related Resources:</strong></p>
        <a href="ai-dev.php" class="btn">🤖 AI Development Guide</a>
        <a href="lab-manual.php" class="btn">🎓 Lab Manual</a>
    </nav>
</article>

<style>
.ai-sop h1 { color: #0066cc; border-bottom: 2px solid #0066cc; padding-bottom: 0.5rem; }
.ai-sop .sop-header { background: #e7f3ff; padding: 1rem; border-radius: 8px; border-left: 5px solid #0066cc; margin-bottom: 2rem; }
.ai-sop .sop-header p { margin: 0.25rem 0; }
.ai-sop section { margin-bottom: 3rem; }
.ai-sop h2 { color: #004499; margin-top: 2rem; }
.ai-sop .rule-box { background: #fff3cd; padding: 1.5rem; border-radius: 8px; border-left: 5px solid #ff9800; margin: 1rem 0; }
.ai-sop .prompt-pattern { background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin: 1rem 0; }
.ai-sop blockquote { margin: 1rem 0; padding: 1rem; background: #fff; border-left: 4px solid #0066cc; font-style: italic; }
.ai-sop .workflow { background: #f0f8ff; padding: 1.5rem; border-radius: 8px; margin: 1rem 0; }
.ai-sop .workflow ol { margin: 1rem 0; padding-left: 2rem; }
.ai-sop .workflow li { margin: 0.5rem 0; }
.ai-sop .warning-box { background: #fff3e0; padding: 1.5rem; border-radius: 8px; border: 2px solid #ff6f00; margin: 1rem 0; text-align: center; }
.ai-sop .prohibited-list { list-style: none; padding-left: 0; }
.ai-sop .prohibited-list li { padding: 0.5rem 0 0.5rem 2rem; background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>') no-repeat left center; background-size: 1.5rem; }
.ai-sop .instructor-note { background: #e8f5e9; padding: 2rem; border-radius: 8px; border-left: 5px solid #4caf50; }
.ai-sop .footer-nav { text-align: center; margin-top: 3rem; padding: 2rem; border-top: 1px solid #eee; }
.ai-sop .btn { display: inline-block; margin: 0.5rem; padding: 0.75rem 1.5rem; background: #0066cc; color: white; text-decoration: none; border-radius: 4px; }
.ai-sop .btn:hover { background: #004499; }
</style>
