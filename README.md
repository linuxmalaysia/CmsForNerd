# 🚀 CmsForNerd v3.5 (2026 Laboratory Edition)

**CmsForNerd** is a Lightweight, Radically Simple, Database-Free PHP Laboratory CMS designed as a live learning environment for modern developers. Version 3.5 marks the final synchronization of **"Pair Logic"** and **AI-Agentic Workflows** within a flat-file architecture.

**Current Version:** 3.5 (Bumping from 3.4 - Jan 2026)  
**Changelog:** See [Modernization History](docs/HISTORY.md) for v3.5 Milestone notes.  
**Primary Maintainer:** Harisfazillah Jamel  
**AI Architect:** Google Gemini & Google Antigravity

---

## 🛠️ Tech Stack & Development Environment

### Core Engine
* **Language:** PHP 8.4+ (Enforced Strict Types & Constructor Property Promotion)
* **Architecture:** "Pair Logic" (Immutable **CmsContext** Factory Pattern)
* **Security:** Native Content Security Policy (CSP) with Nonce-tracking
* **Server:** Nginx Latest (Recommended) or Apache 2.4+
* **OS:** Windows 11 (Herd), Debian, AlmaLinux, or FreeBSD

### Professional Tooling
* **IDE:** [Google Antigravity](https://deepmind.google/technologies/gemini/) (AI-native) or VS Code
* **Static Analysis:** **PHPStan Level 8** (The Laboratory Gold Standard)
* **Package Manager:** Composer 2.8+
* **Testing & QA:** PHPUnit 11.5+ and PHP_CodeSniffer 3.11+ (PSR-12)
* **Browser:** Mozilla Firefox (For strict CSP and network auditing)
* **Tooling:** [setup-lab.sh](tools/setup-lab.sh) for Linux/macOS, [setup-lab.ps1](tools/setup-lab.ps1) for Windows


---

## 🚀 Installation & Laboratory Setup

### 🪟 Option 1: Microsoft Windows 11 (Nerd-Stack)
1. Install [Laravel Herd](https://herd.laravel.com) and select **PHP 8.4**.
2. Clone the repo into your Herd `sites` folder.
3. Run `composer install` to initialize the Autoloader and Tooling.
4. Run `composer lab-check` to verify the environment.

### 🐧 Option 2: Linux (Debian/AlmaLinux)
1. Use [Ondřej Surý's PPA](https://deb.sury.org/) or [Remi Repo](https://rpms.remirepo.net/).
2. Install `php8.4-cli`, `php8.4-mbstring`, `php8.4-xml`, and `php8.4-zip`.
3. Follow the [Linux Setup Guide](docs/linux-setup.md).

---

## 🤖 AI-Assisted Development
CMSForNerd v3.5 is architected for co-authoring with AI Agents:

1. **Google Gemini (The Architect)**: Use for planning logic and Level 8 PHPDoc refactoring.
2. **Google Antigravity (The Agent)**: Use for secure file writes, static analysis audits, and Git management.
3. **Workflow**: Describe changes → Review `implementation_plan.md` → Verify with `composer lab-check`.

> **v3.5 Sync Tip:** Every `.php` controller MUST have a corresponding `-body.inc` fragment in the `contents/` directory.

---

## 🧪 The Laboratory Curriculum (v3.5 Sync)

Master backend engineering through our built-in modules:
1. **Module 1-2**: Architecture, PSR-12, & PSR-4 Autoloading.
2. **Module 3**: **Defensive Engineering** (Path Sanitization & CSP).
3. **Module 4**: **Automated Testing** (PHPUnit 11.5+ Mastery).
4. **Module 5**: **AI-Agentic Workflows** & Pair Logic.
5. **Final Exam**: The "Break-Fix" Challenge (Repairing a live laboratory system).

Start your journey in the [🎓 Lab Manual](docs/lab-manual.md).

---

## ⚖️ Standards (RFC 2119 & v3.5 Engineering)

* **MUST**: Begin all files with `declare(strict_types=1);`.
* **MUST NOT**: Use `global` variables; use the `createCmsContext()` factory.
* **REQUIRED**: All new code **MUST** pass `composer compliance` (PHPStan Level 8).
* **SHOULD**: Use Property Hooks for data validation where appropriate.
* **MUST**: Follow the "Pair Logic" naming convention.

---

### 🛠️ Laboratory Automation Tools

To simplify the setup process for students and developers, we have provided automation scripts in the `tools/` directory.

#### 🐧 For Linux & macOS
```bash
chmod +x tools/setup-lab.sh
./tools/setup-lab.sh
```

#### 🪟 For Windows 11
```powershell
.\tools\setup-lab.ps1
```

#### 🌐 Web Environment Check
After setting up the CLI, verify your web server configuration by visiting:
`http://localhost/tools/sanity-check.php`

---

### Credits
* **Author:** Harisfazillah Jamel (LinuxMalaysia)
* **Assistant:** Google Gemini & Google Antigravity (v3.5 "Pair Logic" Milestone)
* **Website:** [linuxmalaysia.com](https://www.linuxmalaysia.com)

*Modernization without loss of simplicity. Security without the bloat.*
