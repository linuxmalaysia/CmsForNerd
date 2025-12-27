<article class="exam-answers">
    <header class="answers-header">
        <h1>✅ Official Answer Key: Final Exam</h1>
        <p class="subtitle">CMSForNerd v3.1 Modernization Curriculum</p>
    </header>

    <div class="answers-intro">
        <p>
            Here is the <strong>Official Answer Key</strong> for the CMSForNerd v3.1 Final Exam. Use this to verify your students' 
            logic and ensure their refactored code meets the RFC 2119 and PSR-12 standards taught throughout the curriculum.
        </p>
    </div>

    <section class="answer">
        <h2>✅ Answer 1: The Security Breach (Module 3)</h2>
        <p><strong>Requirement:</strong> Use a positive allow-list and sanitize the input to prevent Path Traversal.</p>
        <div class="code-block fixed">
            <pre><code>// FIXED CODE
$requestedPage = $_GET['page'] ?? 'index';
$safePage = \CmsForNerd\SecurityUtils::sanitizePageName($requestedPage);
$contentPath = __DIR__ . "/contents/{$safePage}.inc";

if (file_exists($contentPath)) {
    include $contentPath;
} else {
    include "contents/404.inc";
}</code></pre>
        </div>
    </section>

    <section class="answer">
        <h2>✅ Answer 2: The Logic Error (Module 1)</h2>
        <p><strong>Requirement:</strong> Remove the <code>return</code> keyword (hooks use implicit returns for arrow syntax) and use the correct property reference.</p>
        <div class="code-block fixed">
            <pre><code>// FIXED CODE
class Project {
    public string $author {
        set => $this->author = trim($value);
        get => strtoupper($this->author); // Implicit return in PHP 8.4 hooks
    }
}</code></pre>
        </div>
    </section>

    <section class="answer">
        <h2>✅ Answer 3: The PSR-12 Audit (Module 2)</h2>
        <p><strong>Requirement:</strong> Class and Method braces on new lines, 4-space indentation, and visibility keywords.</p>
        <div class="code-block fixed">
            <pre><code>// FIXED CODE
class Checker
{
    public function validate(string $data): bool
    {
        if ($data === "valid") {
            return true;
        }

        return false;
    }
}</code></pre>
        </div>
    </section>

    <section class="answer">
        <h2>✅ Answer 4: The Failing Test (Module 4)</h2>
        <p><strong>Requirement:</strong> Use <code>assertSame</code> to check both the value and the type (Strict Comparison).</p>
        <div class="code-block fixed">
            <pre><code>// FIXED CODE
public function testTypeSafety(): void
{
    $result = "100";
    // This will now correctly fail because string "100" !== integer 100
    $this->assertSame(100, $result, "The result must be an integer, not a string.");
}</code></pre>
        </div>
    </section>

    <section class="answer">
        <h2>✅ Answer 5: The CSP Leak (Module 3)</h2>
        <p><strong>Requirement:</strong> Explicitly restrict sources to <code>'self'</code> and avoid wildcards.</p>
        <div class="code-block fixed">
            <pre><code>&lt;!-- FIXED CODE --&gt;
&lt;meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self';"&gt;</code></pre>
        </div>
    </section>

    <footer class="grading-rubric">
        <h2>🎓 Grading Rubric</h2>
        <p>To award the Certificate of Completion, the student's solution <strong>MUST</strong> meet these three criteria:</p>
        <ul>
            <li><strong>Functionality:</strong> Does the code run without PHP fatal errors?</li>
            <li><strong>Standards:</strong> Does <code>composer check-style</code> return 0 errors?</li>
            <li><strong>Integrity:</strong> Does the <code>SecurityUtils</code> unit test achieve 100% coverage?</li>
        </ul>
    </footer>
</article>

<style>
.exam-answers h1 { color: #28a745; border-bottom: 2px solid #28a745; padding-bottom: 0.5rem; }
.exam-answers .answers-header { text-align: center; margin-bottom: 3rem; }
.exam-answers .subtitle { font-size: 1.2rem; color: #666; font-style: italic; }
.exam-answers .answers-intro { background: #f0fdf4; padding: 1.5rem; border-radius: 8px; border-left: 5px solid #28a745; margin-bottom: 3rem; }
.exam-answers h2 { color: #333; margin-top: 3rem; }
.exam-answers .code-block { background: #1a1a1a; padding: 1.5rem; border-radius: 4px; margin: 1rem 0; box-shadow: inset 0 0 10px rgba(0,0,0,0.5); }
.exam-answers .code-block pre { color: #f8f8f2; margin: 0; }
.exam-answers .code-block.fixed { border-left: 5px solid #28a745; }
.exam-answers .grading-rubric { background: #fffbeb; border: 2px solid #fde68a; padding: 2rem; border-radius: 8px; margin-top: 4rem; }
.exam-answers .grading-rubric h2 { color: #92400e; margin-top: 0; }
.exam-answers .grading-rubric ul { padding-left: 1.5rem; }
.exam-answers .grading-rubric li { margin-bottom: 0.5rem; color: #78350f; }
</style>

