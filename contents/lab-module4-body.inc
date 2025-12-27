<article class="lab-worksheet">
    <h1>Student Lab Worksheet: Module 4</h1>
    <p class="subtitle">Topic: Automated Testing with PHPUnit 11</p>

    <div class="requirement-alert">
        <strong>Requirement Level:</strong> Students <strong>MUST</strong> pass all assertions to achieve "Certified Nerd" status.
    </div>

    <section class="objectives">
        <h2>🎯 Learning Objectives</h2>
        <ul>
            <li>Understand the <strong>Arrange-Act-Assert (AAA)</strong> pattern.</li>
            <li>Write a unit test for the <code>SecurityUtils</code> class.</li>
            <li>Master the terminal-based test runner.</li>
        </ul>
    </section>

    <section class="step">
        <h2>📂 Step 1: The Test Anatomy</h2>
        <p>In PHPUnit, every test file <strong>MUST</strong> end with the suffix <code>Test.php</code> and its class <strong>MUST</strong> extend <code>TestCase</code>.</p>
        
        <h3>The AAA Pattern:</h3>
        <ul>
            <li><strong>Arrange:</strong> Set up the objects and data needed for the test.</li>
            <li><strong>Act:</strong> Execute the specific function you want to test.</li>
            <li><strong>Assert:</strong> Check if the result matches your expectations.</li>
        </ul>
    </section>

    <section class="step">
        <h2>🛠️ Step 2: Writing Your First Test</h2>
        <p>You will write a test for the <code>SecurityUtils::escapeHtml</code> method to ensure it correctly prevents XSS (Cross-Site Scripting).</p>
        <p><strong>Task:</strong> Create <code>tests/SecurityUtilsTest.php</code> and enter this code:</p>
        <div class="code-block modern">
            <pre><code>&lt;?php

declare(strict_types=1);

namespace CmsForNerd\Tests;

use PHPUnit\Framework\TestCase;
use CmsForNerd\SecurityUtils;

final class SecurityUtilsTest extends TestCase
{
    /**
     * Requirement: HTML special characters MUST be converted to entities.
     */
    public function testEscapesHtmlSpecialCharacters(): void
    {
        // 1. Arrange
        $input = '&lt;script&gt;alert("hack");&lt;/script&gt;';
        $expected = '&amp;lt;script&amp;gt;alert(&amp;quot;hack&amp;quot;);&amp;lt;/script&amp;gt;';

        // 2. Act
        $result = SecurityUtils::escapeHtml($input);

        // 3. Assert
        $this->assertSame($expected, $result, "The HTML was not escaped correctly!");
    }
}</code></pre>
        </div>
    </section>

    <section class="step">
        <h2>🚀 Step 3: Running the Lab</h2>
        <p>Open your Antigravity Terminal and execute the test suite:</p>
        <div class="terminal-block">
            <code>./vendor/bin/phpunit tests/SecurityUtilsTest.php</code>
        </div>
        <p><strong>What to look for:</strong></p>
        <ul>
            <li><strong>. (Dot):</strong> This means your test passed!</li>
            <li><strong>F (Failure):</strong> Something went wrong. PHPUnit will show you exactly what it expected vs. what it got.</li>
        </ul>
    </section>

    <section class="step">
        <h2>🧪 Step 4: The "Breaking" Exercise</h2>
        <p>To truly understand testing, you must see a failure.</p>
        <ol>
            <li>Open <code>includes/SecurityUtils.php</code>.</li>
            <li>Temporarily change the <code>escapeHtml</code> function to just <code>return $content;</code> (breaking the security).</li>
            <li>Run the test again.</li>
            <li><strong>Observe:</strong> Watch how PHPUnit catches your mistake instantly. This is why we test!</li>
        </ol>

        <div class="question-box">
            <p><strong>Question for the Student:</strong> Why is it better to test small units of code (Unit Testing) before testing the entire website (Integration Testing)?</p>
        </div>
    </section>

    <footer class="standards-summary">
        <h2>🎓 Summary of RFC 2119 Standards for Module 4</h2>
        <ul>
            <li><strong>MUST:</strong> Every test method name <strong>MUST</strong> start with the word <code>test</code> (e.g., <code>testAddition</code>).</li>
            <li><strong>MUST:</strong> Test classes <strong>MUST</strong> be marked as <code>final</code> to prevent unnecessary inheritance.</li>
            <li><strong>SHOULD:</strong> You <strong>SHOULD</strong> use <code>assertSame()</code> instead of <code>assertEquals()</code> to check both value and type (strict comparison).</li>
        </ul>
    </footer>

    <nav class="progress-nav">
        <a href="lab-module3.php" class="btn prev">&lt; Previous: Module 3 (Defensive Engineering)</a>
        <a href="lab-module5.php" class="btn next">Next: Module 5 (Coverage &amp; QA) &gt;</a>
    </nav>
</article>

<style>
.lab-worksheet h1 { color: #d9534f; margin-bottom: 0.1rem; }
.lab-worksheet .subtitle { font-size: 1.2rem; color: #777; margin-bottom: 2rem; }
.lab-worksheet .requirement-alert { background: #fcf8e3; border: 1px solid #faebcc; color: #8a6d3b; padding: 1rem; border-radius: 4px; margin-bottom: 2rem; }
.lab-worksheet h2 { color: #333; border-bottom: 1px solid #eee; padding-bottom: 0.5rem; margin-top: 2rem; }
.lab-worksheet .code-block { background: #2d2d2d; color: #ccc; padding: 1rem; border-radius: 4px; overflow-x: auto; margin: 1rem 0; }
.lab-worksheet .code-block.modern { border-left: 5px solid #5cb85c; }
.lab-worksheet .terminal-block { background: #000; color: #00ff00; padding: 1rem; font-family: 'Courier New', Courier, monospace; border-radius: 4px; margin: 1rem 0; }
.lab-worksheet .question-box { background: #d9edf7; border: 1px solid #bce8f1; color: #31708f; padding: 1rem; border-radius: 4px; margin: 2rem 0; }
.lab-worksheet .standards-summary { margin-top: 3rem; background: #f5f5f5; padding: 1.5rem; border-radius: 8px; }
.progress-nav { display: flex; justify-content: space-between; margin-top: 3rem; padding: 2rem 0; border-top: 2px solid #eee; }
.progress-nav .btn { padding: 1rem 1.5rem; border-radius: 4px; text-decoration: none; font-weight: bold; }
.progress-nav .prev { background: #6c757d; color: #fff; }
.progress-nav .next { background: #5cb85c; color: #fff; }
@media (max-width: 768px) { .progress-nav { flex-direction: column; gap: 1rem; } }
</style>

