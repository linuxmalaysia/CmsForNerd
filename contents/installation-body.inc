<h1>Introduction</h1>
<p>
    <strong>CMSForNerd</strong> is a lightweight, flat-file Content Management System geared towards developers and enthusiasts who want full control over their code. 
    Unlike complex database-driven CMS platforms (like WordPress or Joomla), CMSForNerd stores all content in simple text files. 
    This makes it incredibly fast, secure, and easy to backup—just copy the files!
</p>
<p>
    We built <strong>CMSForNerd framework</strong> to help users learn the fundamentals of <strong>HTML5, CSS3, and Modern PHP (8.4+)</strong>.
    The v3.1 modernization ensures full <strong>cross-platform compatibility</strong> (Windows, Linux, Unix, FreeBSD) achieved through <strong>AI-Assisted Coding</strong> using <strong>Google Antigravity</strong>.
</p>

<h3>Requirements</h3>
<ul>
    <li>Web Server (Apache, Nginx, IIS, or LiteSpeed)</li>
    <li>PHP 8.2 or higher (PHP 8.4 Recommended)</li>
    <li>OS: Windows, Linux, Unix, or FreeBSD (Tested)</li>
    <li>No Database required!</li>
</ul>

<h3>Installation</h3>
<ol>
    <li>Download the latest release zip/tarball from our <a href="https://github.com/CMSForNerd/CmsForNerd" target="_blank">GitHub Repository</a>.</li>
    <li>Extract the contents to your web server's public directory (e.g., <code>public_html</code> or <code>www</code>).</li>
    <li>Ensure permissions are set correctly (typically 755 for directories, 644 for files).</li>
    <li>Open <code>includes/global-control.inc.php</code> to configure your site name and theme.</li>
</ol>

<h3>How to Create Pages</h3>
<p>
    CMSForNerd uses a unique <strong>"Pair Logic"</strong> system. To create a new page (e.g., <em>About Us</em>), you need two files:
</p>
<ol>
    <li>
        <strong>The Entry Point (`about.php`):</strong> 
        Copy <code>template.php</code> to the root directory and rename it to <code>about.php</code>.
    </li>
    <li>
        <strong>The Content Body (`contents/about-body.inc`):</strong> 
        Create a file inside the <code>contents/</code> folder named <code>about-body.inc</code>. 
        Put your raw HTML content here (just the part inside the <code>&lt;body&gt;</code> tags).
    </li>
</ol>

<h3>Recommended Tools</h3>
<p>Coding and maintaining a flat-file site is easier with the right tools:</p>
<ul>
    <li><strong>Code Editor:</strong> <a href="https://code.visualstudio.com/" target="_blank">Visual Studio Code (VS Code)</a>, <a href="https://www.sublimetext.com/" target="_blank">Sublime Text</a>, or <a href="https://notepad-plus-plus.org/" target="_blank">Notepad++</a>.</li>
    <li><strong>File Transfer:</strong> <a href="https://filezilla-project.org/" target="_blank">FileZilla</a> or <a href="https://winscp.net/" target="_blank">WinSCP</a>.</li>
    <li><strong>Local Server:</strong> <a href="https://herd.laravel.com/" target="_blank">Laravel Herd</a> (Recommended), <a href="https://www.apachefriends.org/" target="_blank">XAMPP</a>, or <a href="https://laragon.org/" target="_blank">Laragon</a>.</li>
    <li><strong>Debugging:</strong> <a href="https://www.mozilla.org/firefox/developer/" target="_blank">Mozilla Firefox Developer Tools</a> for HTML5 validation and CSS Grid debugging.</li>
</ul>

<h3>Security Features (v3.1)</h3>
<p>
    <strong>CMSForNerd v3.1</strong> includes strict input validation and <strong>Cloudflare Turnstile</strong> support. 
    To enable Bot Protection on your forms, edit <code>includes/turnstile.php</code> and add your API keys.
</p>

<h3>Advanced: Theme Development (PHP 8.4)</h3>
<p>
    When building themes, we now use the <strong>Context Object</strong> pattern for clean, object-oriented inclusions:
</p>
<pre><code>// NEW (PHP 8.4 with Context Object)
include "themes/{$ctx->themeName}/header.tpl";
</code></pre>

<h3>Maintenance Note</h3>
<p>
    Remember to run <code>composer install</code> if you move the project to a new machine to ensure the autoloader and PHPUnit are ready to go.
</p>

<div class="next-steps" style="background: #fff3cd; border: 2px solid #ffeeba; padding: 2rem; border-radius: 8px; margin-top: 3rem; text-align: center;">
    <h3>✅ Installation Complete?</h3>
    <p>Your NEXT STEP is to open the <strong>Student Welcome Kit</strong> to get your "Nerd Stack" ready for the laboratory.</p>
    <p><a href="welcome-kit.php" class="btn" style="background: #856404; color: #fff; padding: 0.8rem 1.5rem; border-radius: 4px; text-decoration: none; font-weight: bold;">🚀 Open Student Welcome Kit</a></p>
</div>

<p>
    <em>All changes have been committed and pushed to your GitHub repository. It has been a pleasure modernizing this "Radically Simple" CMS using <strong>Google Antigravity</strong>!</em>
</p>


