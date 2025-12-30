<article class="about-page">
    <header class="about-header">
        <h1>About CMSForNerd</h1>
        <p class="tagline">Radical Simplicity. Educational Empowerment. AI Synergy.</p>
    </header>

    <section class="mission-vision">
        <div class="mission-card">
            <h2>The Mission</h2>
            <p>
                To provide a "Transparent Codebase" where students can see every moving part. 
                CMSForNerd isn't just a tool to manage content; it is a tool to manage <strong>knowledge</strong>. 
                By stripping away the complexity of databases and heavy frameworks, we allow the 
                purity of PHP 8.4 to shine through.
            </p>
        </div>
    </section>

    <section class="architects">
        <h2>The Architects</h2>
        <div class="architect-grid">
            <div class="architect-card">
                <div class="avatar">👨‍💻</div>
                <h3>LinuxMalaysia</h3>
                <p class="role">Project Founder & Lead Architect</p>
                <p>
                    A veteran of the open-source movement since 2005, Harisfazillah Jamel 
                    envisions a world where code remains accessible and "hackable" for the next generation.
                </p>
            </div>

            <div class="architect-card">
                <div class="avatar">🤖</div>
                <h3>Google Gemini</h3>
                <p class="role">AI Thought Partner</p>
                <p>
                    Providing the modernization engine for the v3.3 refactor, Gemini ensures 
                    the CMS adheres to the latest PSR-12 standards and PHP 8.4 best practices.
                </p>
            </div>
        </div>
    </section>

    <section class="philosophy">
        <h2>Our Philosophy: "The Nerd Way"</h2>
        <p>
            In an era of "Low-Code" and "No-Code," we choose <strong>"All-Code."</strong> We believe 
            that true mastery comes from understanding how a <code>CmsContext</code> object is 
            constructed, how a <code>GZIP</code> buffer is flushed, and how a <code>match</code> 
            expression secures a route.
        </p>
        <blockquote>
            "Simplicity is the ultimate sophistication, but transparency is the ultimate security."
        </blockquote>
    </section>

    <footer class="about-footer">
        <p>Join us in the laboratory. Explore the <a href="history.php">Project History</a> or start your journey with the <a href="welcome-kit.php">Student Welcome Kit</a>.</p>
    </footer>
</article>

<style>
    :root { --about-primary: #2c3e50; --about-accent: #e67e22; }
    .about-page { max-width: 900px; margin: 0 auto; line-height: 1.8; color: #333; }
    .about-header { text-align: center; margin-bottom: 50px; }
    .about-header h1 { font-size: 3rem; color: var(--about-primary); margin-bottom: 10px; }
    .tagline { font-size: 1.2rem; color: var(--about-accent); font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }

    .mission-card { background: #fdf2e9; border-left: 8px solid var(--about-accent); padding: 30px; border-radius: 12px; margin-bottom: 50px; }
    .mission-card h2 { margin-top: 0; color: #a04000; }

    .architect-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 50px; }
    .architect-card { background: #fff; border: 1px solid #eee; padding: 25px; border-radius: 15px; text-align: center; box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    .architect-card .avatar { font-size: 3rem; margin-bottom: 15px; }
    .architect-card h3 { margin: 10px 0 5px; color: var(--about-primary); }
    .role { font-weight: bold; color: var(--about-accent); font-size: 0.9rem; margin-bottom: 15px; }

    .philosophy blockquote { font-size: 1.4rem; font-style: italic; color: #555; border-top: 1px solid #eee; border-bottom: 1px solid #eee; padding: 20px 0; text-align: center; margin: 30px 0; }
    
    .about-footer { text-align: center; margin-top: 60px; padding: 40px; background: #f9f9f9; border-radius: 12px; }
    @media (max-width: 768px) { .architect-grid { grid-template-columns: 1fr; } }
</style>
