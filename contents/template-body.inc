<article class="template-guide">
    <h1>🎨 CmsForNerd v3.3 Template Guide</h1>
    <p class="subtitle">Mastering the "Pair Logic" & Context Engine</p>

    <div class="intro-box">
        <p>
            The <code>template.php</code> file acts as the <strong>Front Controller</strong> for your individual pages. In v3.3, it initializes the <code>CmsContext</code> object, which securely carries your metadata and configuration from the <code>src/</code> engine into the theme's <code>pager.php</code>.
        </p>
    </div>

    <section class="guide-step">
        <h2>📂 Step 1: Locate the Folders</h2>
        <p>In the v3.3 Laboratory environment, focus on these key areas:</p>
        <ul>
            <li><strong>Root Directory:</strong> Where your public <code>.php</code> pages (like <code>search.php</code>) live.</li>
            <li><strong>contents/ Directory:</strong> Where the raw "body" HTML for each page is stored.</li>
            <li><strong>src/ & includes/:</strong> The hybrid engine folders that handle autoloader and security logic.</li>
        </ul>
    </section>

    <section class="guide-step">
        <h2>📝 Step 2: Create Your Content (.inc file)</h2>
        <p>Instead of writing a full HTML page, you only need to code what goes inside the <code>&lt;body&gt;</code> tag.</p>
        <ol>
            <li>Open <strong>Google Antigravity</strong>.</li>
            <li>Create a new file inside the <code>contents/</code> folder.</li>
            <li><strong>Naming Rule:</strong> If your page is <code>search.php</code>, your content file <strong>MUST</strong> be named <code>search-body.inc</code>.</li>
            <li>Paste only the HTML you want to appear in the middle of the page.</li>
        </ol>
        <div class="code-example">
            <h3>Example: <code>contents/search-body.inc</code></h3>
            <pre><code>&lt;section class="search-results"&gt;
    &lt;h1&gt;Search the Lab&lt;/h1&gt;
    &lt;form action="search.php" method="GET"&gt;
        &lt;input type="text" name="q" placeholder="Search for modules..."&gt;
        &lt;button type="submit"&gt;Go&lt;/button&gt;
    &lt;/form&gt;
&lt;/section&gt;</code></pre>
        </div>
    </section>

    <section class="guide-step">
        <h2>🚀 Step 3: Create Your Page (.php file)</h2>
        <p>Now, create the actual file that users will visit by leveraging the <code>template.php</code> boilerplate.</p>
        <ol>
            <li>In the Root Directory, copy <code>template.php</code> and rename it (e.g., <code>search.php</code>).</li>
            <li>Open <code>search.php</code> and locate the <strong>Metadata Configuration</strong>.</li>
            <li>Update the <code>$content</code> array (lowercase) to set the SEO title and description.</li>
        </ol>
        <div class="code-example">
            <h3>Example: <code>search.php</code> (v3.3 Standard)</h3>
            <pre><code>&lt;?php
declare(strict_types=1);

// 1. Customize Metadata
$content = [
    'title'       => "Search - CmsForNerd Laboratory",
    'description' => "Modernized search utility using PHP 8.4 types."
];

// 2. The system handles the rest via CmsContext
require_once __DIR__ . '/includes/bootstrap.php';
// ... rest of template logic
?&gt;</code></pre>
        </div>
    </section>

    <section class="guide-step highlight">
        <h2>💡 The "Modern PHP" Workflow</h2>
        <p>In v3.3, we no longer use global variables inside the theme. We use the <strong>Context Object</strong>:</p>
        <ol>
            <li>Your metadata is stored in <code>$ctx->content</code>.</li>
            <li>Your active theme is identified by <code>$ctx->themeName</code>.</li>
            <li>The content partial is loaded via <code>$ctx->scriptName</code>.</li>
        </ol>
    </section>

    <section class="standards-box">
        <h2>⚖️ Laboratory Standards (RFC 2119)</h2>
        <ul>
            <li><strong>MUST:</strong> Name your content file with the <code>-body.inc</code> suffix to ensure the engine finds it.</li>
            <li><strong>MUST NOT:</strong> Include <code>&lt;html&gt;</code> or <code>&lt;body&gt;</code> tags in <code>.inc</code> files.</li>
            <li><strong>REQUIRED:</strong> Run <code>composer lab-check</code> after creating new pages to ensure PSR-12 compliance.</li>
        </ul>
    </section>
</article>

<style>
.template-guide h1 { color: #8e44ad; border-bottom: 2px solid #8e44ad; padding-bottom: 0.5rem; }
.template-guide .subtitle { font-size: 1.2rem; color: #666; font-weight: bold; margin-bottom: 2rem; }
.template-guide .intro-box { background: #f3e5f5; padding: 1.5rem; border-radius: 8px; border-left: 5px solid #8e44ad; margin-bottom: 2rem; }
.template-guide .guide-step { margin-bottom: 3rem; }
.template-guide h2 { color: #333; border-bottom: 1px solid #eee; padding-bottom: 0.5rem; }
.template-guide .code-example { background: #1a1a1a; color: #fff; padding: 1rem; border-radius: 8px; margin: 1rem 0; }
.template-guide .code-example h3 { color: #e1bee7; margin-top: 0; font-size: 0.9rem; text-transform: uppercase; }
.template-guide .code-example pre { margin: 0; white-space: pre-wrap; word-break: break-all; }
.template-guide .code-example code { font-family: 'Consolas', monospace; color: #f0f0f0; }
.template-guide .highlight { background: #e3f2fd; padding: 1.5rem; border-radius: 8px; border: 1px solid #bbdefb; }
.template-guide .standards-box { background: #f8f9fa; padding: 1.5rem; border-radius: 8px; border: 1px solid #eee; margin-top: 2rem; }
.template-guide .standards-box h2 { border-bottom-color: #ddd; }
</style>
