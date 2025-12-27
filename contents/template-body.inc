<article class="template-guide">
    <h1>🎨 CmsForNerd Template Guide</h1>
    <p class="subtitle">Mastering the "Pair Logic" Architecture</p>

    <div class="intro-box">
        <p>
            The <code>template.php</code> file acts as the master frame for your website. It contains the standard HTML structure (the <code>&lt;head&gt;</code>, <code>&lt;nav&gt;</code>, and global scripts) and uses PHP to "pull in" the content for specific pages.
        </p>
    </div>

    <section class="guide-step">
        <h2>📂 Step 1: Locate the Folders</h2>
        <p>In your project structure, focus on these two areas:</p>
        <ul>
            <li><strong>Root Directory:</strong> Where <code>template.php</code> and your public pages live.</li>
            <li><strong>contents/ Directory:</strong> Where the raw "body" content for each page is stored in <code>.inc</code> files.</li>
        </ul>
    </section>

    <section class="guide-step">
        <h2>📝 Step 2: Create Your Content (.inc file)</h2>
        <p>Instead of writing a full HTML page, you only need to code what goes inside the <code>&lt;body&gt;</code> tag.</p>
        <ol>
            <li>Open <strong>Google Antigravity</strong>.</li>
            <li>Create a new file inside the <code>contents/</code> folder.</li>
            <li><strong>Naming Rule:</strong> If your page will be <code>search.php</code>, your content file <strong>MUST</strong> be named <code>search-body.inc</code>.</li>
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
        <p>Now, you need to create the actual file that users will visit.</p>
        <ol>
            <li>In the Root Directory, copy <code>template.php</code> and rename it to your page name (e.g., <code>search.php</code>).</li>
            <li>Open the new <code>search.php</code> file.</li>
            <li><strong>The Manual Edit:</strong> Find the <code>$CONTENT</code> array at the top and customize the metadata.</li>
        </ol>
        <div class="code-example">
            <h3>Example: <code>search.php</code> (Customization)</h3>
            <pre><code>&lt;?php
// Customize these variables for each page
$CONTENT['title'] = "Search - CMSForNerd";
$CONTENT['description'] = "Use this tool to find specific laboratory modules.";

// The modern system handles the inclusion automatically via CmsContext
include('template.php');
?&gt;</code></pre>
        </div>
    </section>

    <section class="guide-step highlight">
        <h2>💡 The "Copy-Paste" Workflow</h2>
        <p>If you already have a static HTML file you want to convert to CmsForNerd:</p>
        <ol>
            <li>Open your HTML source code.</li>
            <li>Select everything between the opening <code>&lt;body&gt;</code> and closing <code>&lt;/body&gt;</code> tags.</li>
            <li>Copy that content.</li>
            <li>Paste it into your new <code>.inc</code> file inside the <code>contents/</code> directory.</li>
        </ol>
    </section>

    <section class="standards-box">
        <h2>⚖️ RFC 2119 Standards for Templates</h2>
        <ul>
            <li><strong>MUST:</strong> Name your content file with the <code>-body.inc</code> suffix to maintain consistency.</li>
            <li><strong>MUST NOT:</strong> Include <code>&lt;html&gt;</code>, <code>&lt;head&gt;</code>, or <code>&lt;body&gt;</code> tags inside your <code>.inc</code> file.</li>
            <li><strong>SHOULD:</strong> Use Google Antigravity's "Format Document" feature to keep your HTML clean.</li>
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
.template-guide .highlight { background: #fffde7; padding: 1.5rem; border-radius: 8px; border: 1px solid #fff9c4; }
.template-guide .standards-box { background: #f8f9fa; padding: 1.5rem; border-radius: 8px; border: 1px solid #eee; margin-top: 2rem; }
.template-guide .standards-box h2 { border-bottom-color: #ddd; }
</style>
