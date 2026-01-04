<article class="about-page">
    <header class="about-header">
        <h1>About the Laboratory</h1>
        <p class="tagline">Radical Simplicity. Human-AI Symbiosis. Persistent State.</p>
    </header>

    <section class="mission-vision">
        <div class="mission-card">
            <h2>The Mission: "Transparent Intelligence"</h2>
            <p>
                CMSForNerd is more than a Content Management System—it is a live proving ground for 
                <strong>AI-Agentic Workflows</strong>. In an era of black-box code generation, we champion 
                the "Transparent Codebase."
            </p>
            <p>
                Our goal is to demonstrate how Human Architects and AI Agents (like Google Gemini) can 
                maintain a shared <strong>"State of Mind"</strong> across sessions. By stripping away databases 
                and frameworks, we expose the raw PHP 8.4 structure, making the collaboration visible, auditible, and teachable.
            </p>
        </div>
    </section>

    <section class="architects">
        <h2>The Collaboration</h2>
        <div class="architect-grid">
            <div class="architect-card">
                <div class="avatar">👨‍💻</div>
                <h3>LinuxMalaysia</h3>
                <p class="role">Human Architect</p>
                <p>
                    Harisfazillah Jamel sets the vision: A "Zero-Global" architecture where 
                    every decision is intentional. He defines the <strong>Nerd Lab Protocol</strong>, 
                    ensuring that technology serves educational empowerment.
                </p>
            </div>

            <div class="architect-card">
                <div class="avatar">🧠</div>
                <h3>Google Antigravity</h3>
                <p class="role">Agentic Intelligence</p>
                <p>
                    More than a chatbot, the Agent acts as a long-term partner. Through 
                    <strong>Persistent State Artifacts</strong> (Brain/Task lists), it fights "Context Decay," 
                    remembering architectural nuances like the <em>Global-Free</em> refactor long after the session ends.
                </p>
            </div>
        </div>
    </section>

    <section class="philosophy">
        <h2>The Methodology: "State Sync"</h2>
        <div class="philosophy-grid">
            <div class="philo-item">
                <h3>1. Intelligence Audit</h3>
                <p>
                    Before writing code, we sync. The Agent reads the Git history and 
                    Brain artifacts to align its internal model with the physical codebase.
                </p>
            </div>
            <div class="philo-item">
                <h3>2. Zero-Global Arch</h3>
                <p>
                    We reject hidden state. Every dependency (like <code>$ctx</code>) is passed 
                    explicitly via Factory Methods, ensuring total testability.
                </p>
            </div>
            <div class="philo-item">
                <h3>3. Defense in Depth</h3>
                <p>
                    Security isn't an addon. From <strong>CSP Nonces</strong> to 
                    <strong>Cloudflare Turnstile</strong>, protection is woven into the chassis.
                </p>
            </div>
        </div>
        <blockquote>
            "Standardized code is good. Standardized <strong>intelligence</strong> is better. 
            We don't just manage content; we manage the shared memory between Man and Machine."
        </blockquote>
    </section>

    <footer class="about-footer">
        <p>
            Explore the results of this symbiosis. Read the <a href="docs/blog-state-sync.md">State Sync Manifesto</a> 
            or review the <a href="history.php">Project History</a>.
        </p>
    </footer>
</article>

<style>
    :root { --about-primary: #2c3e50; --about-accent: #e67e22; --about-light: #fdf2e9; }
    .about-page { max-width: 900px; margin: 0 auto; line-height: 1.8; color: #333; }
    .about-header { text-align: center; margin-bottom: 50px; }
    .about-header h1 { font-size: 3rem; color: var(--about-primary); margin-bottom: 10px; position: relative; display: inline-block; }
    .about-header h1::after { content: ''; display: block; width: 60px; height: 4px; background: var(--about-accent); margin: 10px auto 0; border-radius: 2px; }
    .tagline { font-size: 1.2rem; color: #7f8c8d; font-weight: 500; letter-spacing: 0.5px; }

    .mission-card { background: var(--about-light); border-left: 6px solid var(--about-accent); padding: 40px; border-radius: 8px; margin-bottom: 60px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); }
    .mission-card h2 { margin-top: 0; color: #d35400; font-size: 1.8rem; }

    .architect-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-bottom: 60px; }
    .architect-card { background: #fff; border: 1px solid #eee; padding: 30px; border-radius: 12px; text-align: center; transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .architect-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.08); }
    .architect-card .avatar { font-size: 4rem; margin-bottom: 20px; }
    .architect-card h3 { margin: 10px 0 5px; color: var(--about-primary); font-size: 1.4rem; }
    .role { font-weight: bold; color: var(--about-accent); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px; }

    .philosophy h2 { text-align: center; margin-bottom: 40px; color: var(--about-primary); }
    .philosophy-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; margin-bottom: 40px; }
    .philo-item h3 { color: var(--about-accent); margin-bottom: 15px; font-size: 1.2rem; }
    .philo-item p { font-size: 0.95rem; color: #555; }
    
    .philosophy blockquote { 
        font-size: 1.3rem; 
        font-style: italic; 
        color: #555; 
        background: #f8f9fa;
        border-radius: 8px;
        padding: 40px; 
        text-align: center; 
        margin: 50px 0; 
        position: relative;
    }
    .philosophy blockquote::before { content: '"'; font-size: 6rem; color: #eee; position: absolute; top: 0; left: 20px; font-family: sans-serif; }

    .about-footer { text-align: center; margin-top: 60px; padding: 40px; background: #2c3e50; color: #fff; border-radius: 12px; }
    .about-footer a { color: var(--about-accent); text-decoration: none; font-weight: bold; }
    .about-footer a:hover { text-decoration: underline; color: #f39c12; }

    @media (max-width: 768px) { 
        .architect-grid, .philosophy-grid { grid-template-columns: 1fr; } 
        .about-header h1 { font-size: 2.2rem; }
    }
</style>
