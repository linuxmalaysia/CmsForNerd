<article class="lab-worksheet linux-setup">
    <h1>🐧 Linux Setup Guide: Laboratory Readiness</h1>
    <p class="subtitle">Ensuring PHP 8.4+ Compatibility on Debian, Ubuntu LTS & AlmaLinux</p>

    <div class="requirement-alert">
        <strong>Requirement:</strong> To complete the laboratory modules, your Linux server <strong>MUST</strong> be running <strong>PHP 8.4</strong> or higher.
    </div>

    <section class="intro">
        <p>
            While many Linux distributions include PHP by default, the versions in "Stable" repositories often lag behind modern development needs. 
            To support <strong>PHP 8.4 Property Hooks</strong> and <strong>Strict Types</strong>, we use the standardized repositories maintained by the 
            primary PHP package maintainers for each platform.
        </p>
    </section>

    <div class="os-selector">
        <section class="os-block debian">
            <h2>📦 Option A: Debian & Ubuntu LTS</h2>
            <p>
                For <strong>Debian 12+</strong> and <strong>Ubuntu 24.04 LTS (and above)</strong>, we use the official repository maintained by 
                <strong>Ondřej Surý</strong>. This is the global standard for modern PHP on Apt-based systems.
            </p>
            
            <div class="terminal-block">
                <code># 1. Update system and install dependencies
sudo apt update && sudo apt install -y lsb-release ca-certificates curl

# 2. Add the official PHP repository GPG key
# (For Ubuntu, this also enables the official PHP PPA)
sudo curl -sSLo /usr/share/keyrings/deb.sury.org-php.gpg https://packages.sury.org/php/apt.gpg

# 3. Add the repository to your sources list
echo "deb [signed-by=/usr/share/keyrings/deb.sury.org-php.gpg] https://packages.sury.org/php/ $(lsb_release -sc) main" | sudo tee /etc/apt/sources.list.d/php.list

# 4. Install PHP 8.4 and required Nerd-Stack modules
sudo apt update
sudo apt install -y php8.4 php8.4-cli php8.4-common php8.4-mbstring php8.4-xml php8.4-curl php8.4-zip php8.4-xdebug</code>
            </div>
        </section>

        <section class="os-block almalinux">
            <h2>📦 Option B: AlmaLinux (9+)</h2>
            <p>AlmaLinux uses the <strong>Remi Repository</strong>, the official standard for modern PHP on RHEL-based systems, enabling DNF Modules.</p>
            
            <div class="terminal-block">
                <code># 1. Install EPEL and Remi Repository
sudo dnf install -y https://dl.fedoraproject.org/pub/epel/epel-release-latest-9.noarch.rpm
sudo dnf install -y https://rpms.remirepo.net/enterprise/remi-release-9.rpm

# 2. Enable the PHP 8.4 module stream
sudo dnf module reset php
sudo dnf module enable php:remi-8.4

# 3. Install PHP 8.4 and required Nerd-Stack modules
sudo dnf install -y php php-cli php-common php-mbstring php-xml php-curl php-zip php-xdebug

# 4. Verify the active stream
php -v</code>
            </div>
        </section>
    </div>

    <section class="step">
        <h2>🚀 Post-Installation: The Nerd Stack</h2>
        <p>Once PHP is installed, you <strong>MUST</strong> ensure <strong>Composer</strong> is available for the laboratory compliance tools.</p>
        <div class="terminal-block">
            <code># Download and install Composer globally
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
chmod +x /usr/local/bin/composer

# Verify Laboratory Readiness
composer compliance</code>
        </div>
    </section>

    <section class="step">
        <h2>📂 Directory Permissions</h2>
        <p>Linux filesystems are case-sensitive and strict about ownership. For the CMS to function, the web server (<code>www-data</code> or <code>apache</code>) <strong>MUST</strong> have read access to all files.</p>
        <div class="terminal-block">
            <code># Set ownership to the web user (adjust user as needed)
sudo chown -R www-data:www-data /var/www/cmsfornerd
sudo chmod -R 755 /var/www/cmsfornerd</code>
        </div>
    </section>

    <footer class="standards-summary">
        <h2>🎓 Summary of RFC 2119 Standards for Linux</h2>
        <ul>
            <li><strong>MUST:</strong> Use <code>https://</code> for all repository sources and GPG key downloads.</li>
            <li><strong>REQUIRED:</strong> Install the <code>php-mbstring</code> extension for full international text support.</li>
            <li><strong>SHOULD:</strong> Enable <code>Xdebug</code> for Module 5 (Code Coverage) testing.</li>
        </ul>
    </footer>

    <nav class="progress-nav">
        <a href="windows-setup.php" class="btn prev">&lt; Previous: Windows Setup</a>
        <a href="welcome-kit.php" class="btn next">Next: Student Welcome Kit &gt;</a>
    </nav>
</article>

<style>
.linux-setup h1 { color: #2ecc71; margin-bottom: 0.1rem; }
.linux-setup .subtitle { font-size: 1.2rem; color: #777; margin-bottom: 2rem; }
.linux-setup .requirement-alert { background: #e8f5e9; border: 1px solid #c8e6c9; color: #2e7d32; padding: 1rem; border-radius: 4px; margin-bottom: 2rem; }
.linux-setup h2 { color: #333; border-bottom: 1px solid #eee; padding-bottom: 0.5rem; margin-top: 2rem; }
.linux-setup .os-selector { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin: 2rem 0; }
.linux-setup .os-block { background: #fdfdfd; padding: 1.5rem; border: 1px solid #eee; border-radius: 8px; min-width: 0; }
.linux-setup .terminal-block { background: #1a1a1a; color: #fff; padding: 1rem; font-family: 'Consolas', 'Monaco', monospace; border-radius: 4px; margin: 1rem 0; border-left: 5px solid #2ecc71; overflow-x: auto; max-width: 100%; box-sizing: border-box; }
.linux-setup .terminal-block code { color: #a2f2a2; white-space: pre-wrap; word-break: break-all; }
.linux-setup .standards-summary { margin-top: 3rem; background: #f8f9fa; padding: 1.5rem; border-radius: 8px; border: 1px solid #eee; }
.progress-nav { display: flex; justify-content: space-between; margin-top: 3rem; padding: 2rem 0; border-top: 2px solid #eee; }
.progress-nav .btn { padding: 1rem 1.5rem; border-radius: 4px; text-decoration: none; font-weight: bold; }
.progress-nav .prev { background: #6c757d; color: #fff; }
.progress-nav .next { background: #2ecc71; color: #fff; }
@media (max-width: 900px) { .linux-setup .os-selector { grid-template-columns: 1fr; } .progress-nav { flex-direction: column; gap: 1rem; } }
</style>
