<article class="lab-worksheet">
    <h1>Student Lab Worksheet: Module 3</h1>
    <p class="subtitle">Topic: Defensive Engineering & Path Traversal</p>

    <div class="requirement-alert">
        <strong>Requirement Level:</strong> Students <strong>MUST</strong> complete all steps to achieve "Green-Light" status.
    </div>

    <section class="objectives">
        <h2>🎯 Learning Objectives</h2>
        <ul>
            <li>Understand the "Dot-Dot-Slash" (<code>../</code>) attack vector.</li>
            <li>Implement an allowlist-based sanitization function.</li>
            <li>Verify defenses using the Security Testing methodology.</li>
        </ul>
    </section>

    <section class="step">
        <h2>🧪 Step 1: The Vulnerability (The "Before" State)</h2>
        <p>In legacy versions of CMSForNerd, the code used to load pages like this:</p>
        <div class="code-block legacy">
            <pre><code>// VULNERABLE CODE - DO NOT USE
$page = $_GET['page'];
include "contents/" . $page . ".php";</code></pre>
        </div>
        <p>
            <strong>The Attack:</strong> An attacker uses the URL <code>index.php?page=../../../../etc/passwd</code>. 
            <strong>The Result:</strong> The server "traverses" up from <code>/contents</code>, into the system root, 
            and displays the server's private password file.
        </p>
    </section>

    <section class="step">
        <h2>🛠️ Step 2: Implementing the "Bunker" Defense</h2>
        <p>
            You will now implement the <code>SecurityUtils</code> method we discussed. 
            This uses a <strong>Positive Security Model</strong> (Allowing only what is known to be good).
        </p>
        <p><strong>Task:</strong> Open <code>includes/SecurityUtils.php</code> and ensure the <code>sanitizePageName</code> method is active.</p>
        <div class="code-block modern">
            <pre><code>public static function sanitizePageName(string $pageName): string
{
    // MUST: Only allow alphanumeric characters and hyphens.
    // This effectively 'neutralizes' dots (.) and slashes (/).
    return preg_replace('/[^a-zA-Z0-9\-]/', '', $pageName);
}</code></pre>
        </div>
    </section>

    <section class="step">
        <h2>🧪 Step 3: The Lab Exercise (Hands-On)</h2>
        
        <h3>Exercise 3.1: The "Manual Bypass" Attempt</h3>
        <ol>
            <li>Open your browser to your local CMSForNerd installation.</li>
            <li>Try to "break out" by entering this URL: <code>http://localhost/index.php?page=../index</code></li>
            <li><strong>Observe:</strong> The CMS should reload the homepage or show a 404. It <strong>MUST NOT</strong> include the file from the parent directory.</li>
        </ol>

        <h3>Exercise 3.2: Code Analysis</h3>
        <p>Look at the output of your <code>index.php</code> after the sanitization.</p>
        <ul>
            <li><strong>Input:</strong> <code>../../secret</code></li>
            <li><strong>Sanitized Output:</strong> <code>secret</code></li>
            <li><strong>Final Path:</strong> <code>contents/secret.php</code> (Which does not exist, triggering a safe 404).</li>
        </ul>
    </section>

    <section class="step">
        <h2>✅ Step 4: Verification (The "Green-Light" Test)</h2>
        <p>Run the following command in your terminal to prove your defense is working programmatically:</p>
        <div class="terminal-block">
            <code>./vendor/bin/phpunit --filter it_prevents_directory_traversal_attacks</code>
        </div>
        <div class="question-box">
            <p><strong>Question for the Student:</strong> Why is <code>preg_replace</code> more secure than simply blocking the string <code>../</code>?</p>
            <p class="hint">(Hint: Think about "Double Encoding" like <code>%252e%252e%252f</code>).</p>
        </div>
    </section>

    <footer class="standards-summary">
        <h2>🎓 Summary of RFC 2119 Standards for this Lab</h2>
        <ul>
            <li><strong>MUST:</strong> Use <code>preg_replace</code> to strip non-alphanumeric characters.</li>
            <li><strong>SHOULD:</strong> Use <code>basename()</code> as a secondary layer of defense.</li>
            <li><strong>MAY:</strong> Log blocked attack attempts for security monitoring.</li>
        </ul>
    </footer>
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
</style>
