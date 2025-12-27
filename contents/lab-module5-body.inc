<article class="lab-worksheet">
    <h1>📊 Student Lab Worksheet: Module 5</h1>
    <p class="subtitle">Topic: Test Coverage and Quality Assurance</p>

    <p class="intro">
        In this final lab for the CMSForNerd Laboratory, students move from simply passing tests to visualizing the "safety net" they’ve built. 
        <strong>Code Coverage</strong> identifies the "dark spots" in an application—lines of code that have never been executed during a test.
    </p>

    <div class="requirement-alert">
        <strong>Requirement Level:</strong> Students <strong>MUST</strong> generate an HTML report showing 100% coverage for all <code>SecurityUtils</code> methods.
    </div>

    <section class="objectives">
        <h2>🎯 Learning Objectives</h2>
        <ul>
            <li>Understand the difference between <strong>Code Execution</strong> and <strong>Code Coverage</strong>.</li>
            <li>Generate an interactive <strong>HTML Coverage Report</strong>.</li>
            <li>Use coverage data to find "hidden" logic branches.</li>
        </ul>
    </section>

    <section class="step">
        <h2>⚙️ Step 1: The Coverage Engine</h2>
        <p>To see which lines of code are tested, PHP needs a driver. In modern environments (like Laravel Herd or dedicated servers), we use <strong>Xdebug</strong> or <strong>PCOV</strong>.</p>
        <p><strong>Task:</strong> Verify your environment is ready. Run:</p>
        <div class="terminal-block">
            <code>php -m | findstr "xdebug"</code>
        </div>
        <p>If "xdebug" appears, your "sensor" is active.</p>
    </section>

    <section class="step">
        <h2>🧪 Step 2: Generating the Visual Map</h2>
        <p>Instead of reading terminal output, we will generate a website that shows our code with highlighted lines.</p>
        <p><strong>Task:</strong> Run PHPUnit with the HTML coverage flag:</p>
        <div class="terminal-block">
            <code>XDEBUG_MODE=coverage ./vendor/bin/phpunit --coverage-html build/coverage</code>
        </div>
        <p><strong>Observation:</strong></p>
        <ol>
            <li>Open the folder <code>build/coverage</code> in your project.</li>
            <li>Open <code>index.html</code> in your browser.</li>
            <li>Click on <code>SecurityUtils.php</code>.</li>
        </ol>
    </section>

    <section class="step">
        <h2>🔍 Step 3: Analyzing "Unreachable" Code</h2>
        <p>In your report, you might see <strong>Red Lines</strong>. This means your tests never triggered that specific part of the code.</p>
        <div class="exercise">
            <h3>Exercise:</h3>
            <ol>
                <li>Look at <code>SecurityUtils::sanitizePageName</code>.</li>
                <li>Do you have a test case that tries to use a hyphen <code>-</code>?</li>
                <li>If not, that specific regex path might be "Red."</li>
                <li><strong>The Fix:</strong> Add a test case in <code>SecurityUtilsTest.php</code> that passes a name with a hyphen (e.g., <code>about-us</code>).</li>
                <li><strong>Re-Run:</strong> Regenerate the report. The line should now be <strong>Green</strong>.</li>
            </ol>
        </div>
    </section>

    <section class="step">
        <h2>✅ Step 4: The Quality Audit</h2>
        <p>A professional developer doesn't just write tests; they ensure the tests are comprehensive.</p>
        <p><strong>Final Challenge:</strong> Navigate to the "Dashboard" tab in your HTML report. Look at the <strong>CRAP (Change Risk Anti-Patterns) Index</strong>.</p>
        <ul>
            <li><strong>High CRAP score:</strong> Code is complex and poorly tested.</li>
            <li><strong>Low CRAP score:</strong> Code is clean, simple, and well-tested.</li>
        </ul>
        <p><strong>Requirement:</strong> Your <code>SecurityUtils</code> class <strong>MUST</strong> have a CRAP score of less than 5.</p>
    </section>

    <footer class="standards-summary">
        <h2>🎓 Summary of RFC 2119 Standards for Module 5</h2>
        <ul>
            <li><strong>MUST:</strong> A coverage report <strong>MUST</strong> be generated before any version release.</li>
            <li><strong>SHOULD:</strong> All core logic <strong>SHOULD</strong> aim for 90% or higher coverage.</li>
            <li><strong>MAY:</strong> You <strong>MAY</strong> exclude the <code>themes/</code> folder from coverage reports as they contain mostly HTML.</li>
        </ul>
        <div class="question-box">
            <p><strong>Question for the Student:</strong> Does 100% Code Coverage mean your code is 100% bug-free?</p>
            <p class="hint">(Hint: Think about "logic errors"—if your test expects <code>2+2</code> to be <code>5</code> and the code gives <code>5</code>, the test passes, but the logic is wrong).</p>
        </div>
    </footer>

    <nav class="progress-nav">
        <a href="lab-module4.php" class="btn prev">&lt; Previous: Module 4 (Automated Testing)</a>
        <a href="final-exam.php" class="btn next">Next: Final Exam (Break-Fix Challenge) &gt;</a>
    </nav>
</article>

<style>
.lab-worksheet h1 { color: #0275d8; margin-bottom: 0.1rem; }
.lab-worksheet .subtitle { font-size: 1.2rem; color: #777; margin-bottom: 2rem; }
.lab-worksheet .requirement-alert { background: #d9edf7; border: 1px solid #bce8f1; color: #31708f; padding: 1rem; border-radius: 4px; margin-bottom: 2rem; }
.lab-worksheet h2 { color: #333; border-bottom: 1px solid #eee; padding-bottom: 0.5rem; margin-top: 2rem; }
.lab-worksheet .intro { background: #f8f9fa; padding: 1.5rem; border-radius: 8px; border-left: 5px solid #0275d8; margin-bottom: 2rem; }
.lab-worksheet .terminal-block { background: #1a1a1a; color: #fff; padding: 1rem; font-family: 'Consolas', 'Monaco', monospace; border-radius: 4px; margin: 1rem 0; border-left: 5px solid #0275d8; }
.lab-worksheet .terminal-block code { color: #5bc0de; }
.lab-worksheet .exercise { background: #fcfcfc; padding: 1.5rem; border: 1px solid #e1e1e1; border-radius: 8px; margin: 1rem 0; }
.lab-worksheet .question-box { background: #fee7e7; border: 1px solid #fad2d2; color: #9a2020; padding: 1.5rem; border-radius: 8px; margin: 2rem 0; }
.lab-worksheet .standards-summary { margin-top: 3rem; background: #f8f9fa; padding: 1.5rem; border-radius: 8px; border: 1px solid #eee; }
.progress-nav { display: flex; justify-content: space-between; margin-top: 3rem; padding: 2rem 0; border-top: 2px solid #eee; }
.progress-nav .btn { padding: 1rem 1.5rem; border-radius: 4px; text-decoration: none; font-weight: bold; }
.progress-nav .prev { background: #6c757d; color: #fff; }
.progress-nav .next { background: #0275d8; color: #fff; }
@media (max-width: 768px) { .progress-nav { flex-direction: column; gap: 1rem; } }
</style>

