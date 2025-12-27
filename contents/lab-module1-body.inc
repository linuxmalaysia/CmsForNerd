<article class="lab-worksheet">
    <h1>Student Lab Worksheet: Module 1</h1>
    <p class="subtitle">Topic: Modern PHP 8.4+ Architecture & PHP 9 Readiness</p>

    <div class="requirement-alert">
        <strong>Requirement Level:</strong> Students <strong>MUST</strong> implement Constructor Promotion and Property Hooks to pass the "Code Elegance" audit.
    </div>

    <section class="objectives">
        <h2>🎯 Learning Objectives</h2>
        <ul>
            <li>Eliminate boilerplate using <strong>Constructor Property Promotion</strong>.</li>
            <li>Master <strong>Property Hooks</strong> to replace traditional Getters/Setters.</li>
            <li>Understand <strong>Asymmetric Visibility</strong> for secure data encapsulation.</li>
        </ul>
    </section>

    <section class="step">
        <h2>🛠️ Step 1: Constructor Property Promotion</h2>
        <p>In legacy PHP, you had to declare a property, define it in the constructor, and then assign it. In PHP 8.4, we do all three in one line.</p>
        <p><strong>Task:</strong> Refactor the <code>User</code> class in <code>includes/User.php</code>.</p>
        <div class="code-compare">
            <div class="old">
                <h3>Old Way</h3>
                <pre><code>final class User {
    public readonly string $username;
    public string $role;
    
    public function __construct(string $username, string $role = 'student') {
        $this->username = $username;
        $this->role = $role;
    }
}</code></pre>
            </div>
            <div class="new">
                <h3>New Way (PHP 8.4)</h3>
                <pre><code>final class User {
    public function __construct(
        public readonly string $username,
        public private(set) string $role = 'student'
    ) {}
}</code></pre>
            </div>
        </div>
    </section>

    <section class="step">
        <h2>🧪 Step 2: Implementing Property Hooks</h2>
        <p>Property hooks allow you to intercept the "Get" or "Set" action on a property. This is perfect for data that needs to be formatted or validated on the fly.</p>
        <div class="exercise">
            <h3>Exercise 1.1: The Auto-Title Hook</h3>
            <p>Update your <code>CmsContext</code> to automatically capitalize page titles when they are accessed.</p>
            <div class="code-block modern">
                <pre><code>public string $pageTitle {
    // The 'get' hook acts like a virtual getter
    get => ucfirst($this->pageTitle);
    
    // The 'set' hook can sanitize data before it hits the property
    set => $this->pageTitle = trim($value);
}</code></pre>
            </div>
        </div>
    </section>

    <section class="step">
        <h2>🔐 Step 3: Asymmetric Visibility</h2>
        <p>This is a "Game Changer" for education. It allows a property to be <strong>Publicly Readable</strong> but <strong>Privately Writable</strong>.</p>
        <div class="exercise">
            <h3>Exercise 1.2: The Counter Challenge</h3>
            <ul>
                <li>Create a property called <code>$viewCount</code>.</li>
                <li>Set its visibility to <code>public private(set)</code>.</li>
                <li><strong>The Test:</strong> Try to change the count from <code>index.php</code> (it should fail). Only a method inside the class should be able to increment it.</li>
            </ul>
            <div class="code-block modern">
                <pre><code>public private(set) int $viewCount = 0;

public function incrementViews(): void {
    $this->viewCount++; // This works!
}</code></pre>
            </div>
        </div>
    </section>

    <section class="step">
        <h2>✅ Step 4: Verification (The "Architect" Audit)</h2>
        <p>Run your compliance tool to ensure your new architecture follows PSR-12:</p>
        <div class="terminal-block">
            <code>composer check-style</code>
        </div>
        <div class="question-box">
            <p><strong>Question for the Student:</strong> If a property is marked as <code>readonly</code>, can it also have a <code>set</code> hook?</p>
            <p class="hint">(Hint: Think about why 'Readonly' and 'Setting a value' might conflict).</p>
        </div>
    </section>

    <footer class="standards-summary">
        <h2>🎓 Summary of RFC 2119 Standards for Module 1</h2>
        <ul>
            <li><strong>MUST:</strong> Use <code>readonly</code> for any data that should never change after the object is created.</li>
            <li><strong>SHOULD:</strong> Use Constructor Promotion for all Data Transfer Objects (DTOs).</li>
            <li><strong>MAY:</strong> Use Property Hooks to replace complex getter methods for better readability.</li>
        </ul>
    </footer>

    <nav class="progress-nav">
        <a href="welcome-kit.php" class="btn prev">&lt; Back to Welcome Kit</a>
        <a href="lab-module2.php" class="btn next">Next: Module 2 (Standards) &gt;</a>
    </nav>
</article>

<style>
.lab-worksheet h1 { color: #007bff; margin-bottom: 0.1rem; }
.lab-worksheet .subtitle { font-size: 1.2rem; color: #777; margin-bottom: 2rem; }
.lab-worksheet .requirement-alert { background: #dff0d8; border: 1px solid #d6e9c6; color: #3c763d; padding: 1rem; border-radius: 4px; margin-bottom: 2rem; }
.lab-worksheet h2 { color: #333; border-bottom: 1px solid #eee; padding-bottom: 0.5rem; margin-top: 2rem; }
.lab-worksheet .code-compare { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin: 1rem 0; }
.lab-worksheet .code-compare .old, .lab-worksheet .code-compare .new { background: #f8f9fa; padding: 1rem; border-radius: 4px; border: 1px solid #ddd; }
.lab-worksheet .code-compare pre { margin: 0; font-size: 0.85rem; }
.lab-worksheet .exercise { background: #f9f9f9; padding: 1rem; border-radius: 4px; border: 1px solid #ddd; margin: 1rem 0; }
.lab-worksheet .code-block { background: #2d2d2d; color: #ccc; padding: 1rem; border-radius: 4px; overflow-x: auto; margin: 1rem 0; }
.lab-worksheet .code-block.modern { border-left: 5px solid #007bff; }
.lab-worksheet .terminal-block { background: #000; color: #00ff00; padding: 1rem; font-family: 'Courier New', Courier, monospace; border-radius: 4px; margin: 1rem 0; }
.lab-worksheet .question-box { background: #fff3cd; border: 1px solid #ffeeba; color: #856404; padding: 1rem; border-radius: 4px; margin: 2rem 0; }
.lab-worksheet .standards-summary { margin-top: 3rem; background: #f5f5f5; padding: 1.5rem; border-radius: 8px; }
.progress-nav { display: flex; justify-content: space-between; margin-top: 3rem; padding: 2rem 0; border-top: 2px solid #eee; }
.progress-nav .btn { padding: 1rem 1.5rem; border-radius: 4px; text-decoration: none; font-weight: bold; }
.progress-nav .prev { background: #6c757d; color: #fff; }
.progress-nav .next { background: #007bff; color: #fff; }
@media (max-width: 768px) { .lab-worksheet .code-compare { grid-template-columns: 1fr; } .progress-nav { flex-direction: column; gap: 1rem; } }
</style>
