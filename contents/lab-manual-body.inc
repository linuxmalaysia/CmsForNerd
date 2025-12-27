<article class="lab-manual">
    <h1>🎓 CMSForNerd v3.1: The Developer’s Lab Manual</h1>
    <p class="intro">
        Welcome to the v3.1 educational suite. This CMS is designed to be a <strong>transparent laboratory</strong>. 
        Every line of code is accessible, every architectural choice is documented, and every security feature 
        is a lesson in professional standards.
    </p>

    <section class="module">
        <h2>📚 Laboratory Module 1: Modern PHP 8.4 Architecture</h2>
        <p>In this module, students explore the transition from procedural scripts to modern object-oriented patterns.</p>
        <div class="exercise">
            <h3>Exercise 1.1: Strict Typing</h3>
            <p>Observe how <code>declare(strict_types=1);</code> prevents the CMS from accepting incorrect data types, forcing developers to write predictable code.</p>
        </div>
        <div class="exercise">
            <h3>Exercise 1.2: The Context Pattern</h3>
            <p>See how the <code>CmsContext</code> object replaces the "Global Variable" anti-pattern, teaching the principle of <strong>Single Source of Truth</strong>.</p>
        </div>
        <div class="exercise">
            <h3>Exercise 1.3: Property Hooks (PHP 8.4)</h3>
            <p>Learn to use PHP 8.4 hooks to automate data validation within class properties, reducing boilerplate code.</p>
        </div>
    </section>

    <section class="module">
        <h2>⚖️ Laboratory Module 2: Standards & Compliance</h2>
        <p>Students learn that professional code is defined by its adherence to global standards.</p>
        <ul>
            <li><strong>Requirement Level (RFC 2119):</strong> We use <em>MUST</em>, <em>SHOULD</em>, and <em>MAY</em> to define project boundaries.
                <ul>
                    <li>Rule: All templates <strong>MUST</strong> be HTML5 compliant.</li>
                    <li>Rule: Security utilities <strong>MUST NOT</strong> be bypassed by the core loader.</li>
                </ul>
            </li>
            <li><strong>PSR-12 Linting:</strong> Use the integrated <code>composer check-style</code> command to identify and fix visual inconsistencies in your code.</li>
        </ul>
    </section>

    <section class="module">
        <h2>🛡️ Laboratory Module 3: Defensive Engineering</h2>
        <p>Security is the "Red Team vs. Blue Team" playground of CMSForNerd.</p>
        <div class="lab-box">
            <h3>Lab: The LFI Challenge</h3>
            <p>We intentionally provide a "Safe Loader" in <code>index.php</code>. Students are challenged to attempt a <strong>Directory Traversal</strong> attack to understand why regex sanitization is a <strong>MUST</strong>.</p>
            <p><a href="lab-module3.php" class="btn">📝 Open Student Worksheet: Module 3</a></p>
        </div>
        <div class="lab-box">
            <h3>Lab: Header Hardening</h3>
            <p>Learn to configure the Content Security Policy (CSP) to block malicious scripts, turning the browser into a security ally.</p>
        </div>
    </section>

    <section class="module">
        <h2>🧪 Laboratory Module 4: Automated Testing (TDD)</h2>
        <p>Master the art of Test-Driven Development using <strong>PHPUnit 11</strong>.</p>
        <div class="exercise">
            <h3>Exercise: Write a new test</h3>
            <p>Create a test in <code>tests/ThemeIntegrityTest.php</code> that fails if a student accidentally deletes the <code>style.css</code> file.</p>
            <p><a href="lab-module4.php" class="btn">📝 Open Student Worksheet: Module 4</a></p>
        </div>
        <p><strong>Concept: "Green-Light Thinking"</strong>—if the tests aren't green, the code isn't ready.</p>
    </section>

    <hr>

    <section class="case-study">
        <h2>📝 The History of v3.1: A Modernization Case Study</h2>
        <p>CMSForNerd v3.1 isn't just a version; it's a <strong>Modernization Journey</strong>.</p>
        <ol>
            <li><strong>Phase 1:</strong> Refactored the 2005 foundation into PHP 8.4 classes.</li>
            <li><strong>Phase 2:</strong> Standardized the UI with CSS Grid (replacing legacy float-based layouts).</li>
            <li><strong>Phase 3:</strong> Hardened the perimeter with Cloudflare Turnstile and <code>SecurityUtils</code>.</li>
            <li><strong>Phase 4:</strong> Automated the workflow with PHPUnit and <code>PHP_CodeSniffer</code>.</li>
        </ol>
        <p class="motto"><strong>Educational Motto:</strong> "Modernization without loss of simplicity." — Harisfazillah Jamel & Gemini, 2025.</p>
    </section>
</article>

<style>
.lab-manual h1 { color: #004d00; border-bottom: 2px solid #004d00; padding-bottom: 0.5rem; }
.lab-manual h2 { color: #006600; margin-top: 2rem; border-left: 5px solid #006600; padding-left: 10px; }
.lab-manual section { margin-bottom: 3rem; background: #fff; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
.lab-manual .intro { font-size: 1.1rem; color: #333; line-height: 1.6; background: #e6f7ff; padding: 1.5rem; border-radius: 8px; border-left: 5px solid #007bff; }
.lab-manual .exercise, .lab-manual .lab-box { background: #f9f9f9; padding: 1rem; border-radius: 4px; border: 1px solid #ddd; margin: 1rem 0; }
.lab-manual .exercise h3, .lab-manual .lab-box h3 { margin-top: 0; color: #d9534f; }
.lab-manual .motto { text-align: center; font-style: italic; font-size: 1.2rem; color: #555; margin-top: 2rem; }
.lab-manual hr { border: 0; border-top: 2px dashed #ccc; margin: 3rem 0; }
</style>
