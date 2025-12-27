<article class="ai-dev-guide">
    <h1>🤖 AI-Assisted Development: Gemini + Antigravity</h1>
    <p class="subtitle">The Modern Workflow: "From Prompt to Production"</p>

    <div class="intro-box">
        <p>
            In the modern era of backend development, you are no longer coding alone. <strong>CMSForNerd v3.1</strong> was built using a high-speed synergy between <strong>Google Gemini</strong> (The Architect) and <strong>Google Antigravity</strong> (The Agent).
        </p>
    </div>

    <section class="workflow-grid">
        <div class="workflow-card gemini">
            <h2>🧠 Google Gemini</h2>
            <p class="role">The Architect & Strategist</p>
            <ul>
                <li><strong>Logic & Math:</strong> Gemini plans your classes and algorithm complexity.</li>
                <li><strong>RFC Compliance:</strong> It ensures your code adheres to RFC 2119 and PSR-12 standards.</li>
                <li><strong>Debugging:</strong> Paste an error, and Gemini analyzes the root cause instantly.</li>
            </ul>
        </div>

        <div class="workflow-card antigravity">
            <h2>🚀 Google Antigravity</h2>
            <p class="role">The Agentic Executioner</p>
            <ul>
                <li><strong>File I/O:</strong> Antigravity writes the actual files to your disk.</li>
                <li><strong>Terminal Control:</strong> It runs <code>composer compliance</code> and <code>phpunit</code> for you.</li>
                <li><strong>Git Mastery:</strong> It stages, commits, and pushes your code once verified.</li>
            </ul>
        </div>
    </section>

    <section class="how-to">
        <h2>🛠️ How to Create a New Page via AI</h2>
        <p>You can create a new page for CMSForNerd by simply describing it to the AI Agent. Follow this 3-step prompt pattern:</p>
        
        <div class="prompt-box">
            <h3>The "Architect Prompt" Pattern:</h3>
            <p><em>"I want to add a new page called 'Gallery'. Please create the <code>gallery.php</code> entry point using the CmsContext pattern and a <code>contents/gallery-body.inc</code> file with a 3-column photo grid. Use CSS Grid for the layout."</em></p>
        </div>

        <ol class="execution-steps">
            <li><strong>Paste Instructions:</strong> Paste your instructions or raw HTML content into this chat.</li>
            <li><strong>Review the Plan:</strong> Gemini will draft an <code>implementation_plan.md</code>. Review it for PSR-12 compliance.</li>
            <li><strong>Automate Execution:</strong> Type "Yes", and Antigravity will write the files, update the sidebar, and run the compliance audit.</li>
        </ol>
    </section>

    <section class="standards-warning">
        <h2>⚖️ The "Good AI Citizen" Rules</h2>
        <ul>
            <li><strong>MUST:</strong> Always ask the AI to verify <code>strict_types=1</code> on new files.</li>
            <li><strong>MUST NOT:</strong> Allow the AI to bypass <code>composer compliance</code>. If it fails, the code is NOT ready.</li>
            <li><strong>SHOULD:</strong> Use Gemini to explain *why* it chose a specific design pattern (e.g., why <code>CmsContext</code> is better than <code>global</code>).</li>
        </ul>
    </section>

    <nav class="footer-nav">
        <p>Ready to try it? Description your next module in the chat right now!</p>
        <a href="lab-manual.php" class="btn">Return to Lab Manual</a>
    </nav>
</article>

<style>
.ai-dev-guide h1 { color: #1a73e8; border-bottom: 2px solid #1a73e8; padding-bottom: 0.5rem; }
.ai-dev-guide .subtitle { font-size: 1.2rem; color: #5f6368; font-weight: bold; margin-bottom: 2rem; }
.ai-dev-guide .intro-box { background: #e8f0fe; padding: 1.5rem; border-radius: 8px; border-left: 5px solid #1a73e8; margin-bottom: 2rem; }
.ai-dev-guide .workflow-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin: 2rem 0; }
.ai-dev-guide .workflow-card { padding: 1.5rem; border-radius: 8px; border: 1px solid #dadce0; background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
.ai-dev-guide .workflow-card h2 { margin-top: 0; }
.ai-dev-guide .role { font-weight: bold; color: #188038; margin-bottom: 1rem; }
.ai-dev-guide .gemini h2 { color: #1a73e8; }
.ai-dev-guide .antigravity h2 { color: #d93025; }
.ai-dev-guide .prompt-box { background: #f8f9fa; border: 1px dashed #1a73e8; padding: 1.5rem; border-radius: 8px; font-style: italic; color: #3c4043; margin: 1.5rem 0; }
.ai-dev-guide .standards-warning { background: #fff7e0; padding: 1.5rem; border-radius: 8px; border: 1px solid #f9ab00; margin-top: 3rem; }
.ai-dev-guide .footer-nav { text-align: center; margin-top: 4rem; padding: 2rem; border-top: 1px solid #eee; }
@media (max-width: 800px) { .ai-dev-guide .workflow-grid { grid-template-columns: 1fr; } }
</style>
