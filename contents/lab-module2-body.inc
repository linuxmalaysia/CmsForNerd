<article class="lab-worksheet">
    <h1>🎨 Student Lab Worksheet: Module 2</h1>
    <p class="subtitle">Topic: PSR-12 and the Art of Clean Code</p>

    <div class="requirement-alert">
        <strong>Requirement Level:</strong> Students <strong>MUST</strong> pass a zero-error style audit using automated linting tools.
    </div>

    <section class="objectives">
        <h2>🎯 Learning Objectives</h2>
        <ul>
            <li>Identify common PSR-12 violations (Indentation, Braces, Spacing).</li>
            <li>Automate code formatting using <strong>PHPCBF</strong>.</li>
            <li>Integrate style checks into the developer workflow.</li>
        </ul>
    </section>

    <section class="step">
        <h2>🛠️ Step 1: The "Manual Eye" Test</h2>
        <p>Before using tools, students must recognize "messy" code. In PHP 8.4+, PSR-12 governs how we structure new features like Enums and Match expressions.</p>
        <p><strong>Common Violations to spot:</strong></p>
        <ul>
            <li>Opening braces <code>{</code> on the same line as a class or method.</li>
            <li>Using <strong>Tabs</strong> instead of <strong>4 Spaces</strong>.</li>
            <li>Missing visibility keywords (<code>public</code>, <code>private</code>) on properties.</li>
        </ul>
    </section>

    <section class="step">
        <h2>🧪 Step 2: The Automated Audit (Linter)</h2>
        <p>Instead of arguing over where a bracket goes, we use <strong>PHP_CodeSniffer (phpcs)</strong>.</p>
        <p><strong>Task:</strong> Run a style audit on your current project.</p>
        <div class="terminal-block">
            <code>./vendor/bin/phpcs --standard=PSR12 includes/</code>
        </div>
        <p><strong>Observation:</strong> You will likely see a list of "Errors" and "Warnings."</p>
        <ul>
            <li><strong>Errors:</strong> Violations that <strong>MUST</strong> be fixed.</li>
            <li><strong>Warnings:</strong> Code that <strong>SHOULD</strong> be improved for readability.</li>
        </ul>
    </section>

    <section class="step">
        <h2>🪄 Step 3: The "Magic" Fixer (PHPCBF)</h2>
        <p>Professional nerds don't fix spaces manually. We use the <strong>PHP Code Beautifier and Fixer</strong>.</p>
        <p><strong>Task:</strong> Tell the computer to fix your formatting for you.</p>
        <div class="terminal-block">
            <code>./vendor/bin/phpcbf --standard=PSR12 includes/</code>
        </div>
        <p><strong>Observation:</strong> Re-run the audit from Step 2. You should see the error count drop significantly (often to zero).</p>
    </section>

    <section class="step">
        <h2>🧩 Step 4: The "Strict Header" Challenge</h2>
        <p>PSR-12 requires a specific order for file headers.</p>
        <p><strong>Exercise:</strong> Ensure every file in your <code>contents/</code> folder follows this exact sequence:</p>
        <ol>
            <li>Opening <code>&lt;?php</code> tag.</li>
            <li>Blank line.</li>
            <li><code>declare(strict_types=1);</code> statement.</li>
            <li>Namespace declaration.</li>
            <li>Import (<code>use</code>) statements.</li>
        </ol>
    </section>

    <footer class="standards-summary">
        <h2>🎓 Summary of RFC 2119 Standards for Module 2</h2>
        <ul>
            <li><strong>MUST:</strong> Use 4 spaces for indentation. Never use tabs.</li>
            <li><strong>MUST:</strong> Place the opening brace for classes and methods on a new line.</li>
            <li><strong>SHOULD:</strong> Keep lines under 120 characters for better split-screen readability.</li>
            <li><strong>MUST NOT:</strong> Use "Short Tags" like <code>&lt;?</code>. Always use the full <code>&lt;?php</code> tag.</li>
        </ul>
        <div class="question-box">
            <p><strong>Question for the Student:</strong> Why does PSR-12 require the closing <code>?&gt;</code> tag to be omitted in files that only contain PHP?</p>
            <p class="hint">(Hint: Think about accidental whitespace causing "Headers already sent" errors).</p>
        </div>
    </footer>
</article>

<style>
.lab-worksheet h1 { color: #6f42c1; margin-bottom: 0.1rem; }
.lab-worksheet .subtitle { font-size: 1.2rem; color: #777; margin-bottom: 2rem; }
.lab-worksheet .requirement-alert { background: #f3e5f5; border: 1px solid #d1c4e9; color: #4527a0; padding: 1rem; border-radius: 4px; margin-bottom: 2rem; }
.lab-worksheet h2 { color: #333; border-bottom: 1px solid #eee; padding-bottom: 0.5rem; margin-top: 2rem; }
.lab-worksheet .terminal-block { background: #1e1e1e; color: #d4d4d4; padding: 1rem; font-family: 'Consolas', 'Monaco', monospace; border-radius: 4px; margin: 1rem 0; border-left: 5px solid #6f42c1; }
.lab-worksheet .terminal-block code { color: #00ff00; }
.lab-worksheet .question-box { background: #e8f5e9; border: 1px solid #c8e6c9; color: #2e7d32; padding: 1rem; border-radius: 4px; margin: 2rem 0; }
.lab-worksheet .standards-summary { margin-top: 3rem; background: #f5f5f5; padding: 1.5rem; border-radius: 8px; }
</style>
