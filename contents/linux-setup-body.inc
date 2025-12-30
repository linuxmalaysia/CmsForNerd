<article class="lab-worksheet linux-setup" itemscope itemtype="https://schema.org/HowTo">
    <header class="setup-header">
        <h1 itemprop="name">🐧 Linux Setup Guide: Laboratory Readiness</h1>
        <p class="subtitle">Ensuring PHP 8.4+ Compatibility on Debian, Ubuntu LTS & AlmaLinux</p>
    </header>

    <div class="requirement-alert" role="alert">
        <strong>RFC 2119 REQUIRED:</strong> To complete the laboratory modules, your server <strong>MUST</strong> run <strong>PHP 8.4</strong> or higher to support Property Hooks.
    </div>

    <section class="os-selector">
        <div class="os-block debian" itemprop="step">
            <h2>📦 Option A: Debian & Ubuntu</h2>
            <p>Using the <strong>Ondřej Surý</strong> repository—the industry standard for modern PHP on Apt systems.</p>
            
            <div class="terminal-block">
                <code># Install dependencies
sudo apt update && sudo apt install -y curl ca-certificates
# Add GPG Key
curl -sSLo /usr/share/keyrings/deb.sury.org-php.gpg https://packages.sury.org/php/apt.gpg
# Add Repo
echo "deb [signed-by=/usr/share/keyrings/deb.sury.org-php.gpg] https://packages.sury.org/php/ $(lsb_release -sc) main" | sudo tee /etc/apt/sources.list.d/php.list
# Install PHP 8.4 Stack
sudo apt update && sudo apt install -y php8.4 php8.4-cli php8.4-mbstring php8.4-xml php8.4-curl php8.4-zip php8.4-xdebug</code>
            </div>
        </div>

        <div class="os-block almalinux" itemprop="step">
            <h2>📦 Option B: AlmaLinux (9+)</h2>
            <p>Using the <strong>Remi Repository</strong> to enable DNF module streams for RHEL-based systems.</p>
            
            <div class="terminal-block">
                <code># Install Remi Repo
sudo dnf install -y https://rpms.remirepo.net/enterprise/remi-release-9.rpm
# Reset and Enable PHP 8.4 Stream
sudo dnf module reset php
sudo dnf module enable php:remi-8.4 -y
# Install PHP 8.4 Stack
sudo dnf install -y php php-cli php-mbstring php-xml php-curl php-zip php-xdebug
# Verify
php -v</code>
            </div>
        </div>
    </section>

    <section class="permissions" itemprop="step">
        <h2>📂 Directory Permissions</h2>
        <p>Linux is strict about ownership. The web user <strong>MUST</strong> have read access to the CMS core.</p>
        <div class="terminal-block">
            <code># Set ownership (Ubuntu/Debian)
sudo chown -R www-data:www-data /var/www/cmsfornerd
# Standard Lab Permissions
sudo find /var/www/cmsfornerd -type d -exec chmod 755 {} \;
sudo find /var/www/cmsfornerd -type f -exec chmod 644 {} \;</code>
        </div>
    </section>

    <footer class="standards-summary">
        <h2>🎓 Linux Compliance Summary</h2>
        <ul>
            <li><strong>MUST:</strong> Use <code>https://</code> for all repository and GPG key downloads.</li>
            <li><strong>REQUIRED:</strong> Install <code>php-mbstring</code> for international text support.</li>
            <li><strong>SHOULD:</strong> Enable <code>Xdebug</code> for Module 5 code coverage testing.</li>
        </ul>
    </footer>

    <nav class="progress-nav">
        <a href="windows-setup.php" class="btn btn-secondary">&lt; Previous: Windows Setup</a>
        <a href="welcome-kit.php" class="btn btn-primary">Next: Student Welcome Kit &gt;</a>
    </nav>
</article>

<style>
    :root { --linux-green: #2ecc71; --terminal-bg: #1a1a1a; --linux-border: #ddd; }
    .linux-setup { max-width: 950px; margin: 0 auto; line-height: 1.7; }
    .setup-header h1 { color: var(--linux-green); border-bottom: 3px solid var(--linux-green); }
    .subtitle { color: #666; font-style: italic; }
    .requirement-alert { background: #e8f5e9; border: 1px solid #c8e6c9; padding: 15px; border-radius: 8px; margin: 20px 0; }
    .os-selector { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin: 30px 0; }
    .os-block { background: #fdfdfd; padding: 20px; border: 1px solid var(--linux-border); border-radius: 10px; }
    .terminal-block { background: var(--terminal-bg); color: #a2f2a2; padding: 15px; border-radius: 6px; font-family: 'Consolas', monospace; margin: 15px 0; border-left: 5px solid var(--linux-green); overflow-x: auto; }
    .terminal-block code { white-space: pre-wrap; word-break: break-all; }
    .standards-summary { background: #f8f9fa; padding: 25px; border-radius: 12px; margin-top: 40px; }
    .progress-nav { display: flex; justify-content: space-between; margin-top: 50px; padding-top: 20px; border-top: 1px solid #eee; }
    .btn { padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold; }
    .btn-primary { background: var(--linux-green); color: white; }
    .btn-secondary { background: #eee; color: #333; }
    @media (max-width: 800px) { .os-selector { grid-template-columns: 1fr; } }
</style>
