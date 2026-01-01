# 🚀 CmsForNerd v3.4 (2026 Laboratory Edition)

**CmsForNerd** is a Lightweight, Radically Simple, Database-Free PHP Laboratory CMS designed as a live learning environment for modern developers. Version 3.4 marks the transition to **Zero-Debt Engineering** and **Security-First** flat-file architecture.

**Current Version:** 3.4 (Bumping from 3.3 - Jan 2026)  
**Changelog:** See [CHANGELOG.md](CHANGELOG.md) for v3.4 Zero-Error Milestone notes.  
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

### 🪟 Option 1: Windows 11 (Nerd-Stack)
1. Install [Laravel Herd](https://herd.laravel.com) and select **PHP 8.4**.
2. Clone the repo into your Herd `sites` folder.
3. Run `composer install` to initialize the Autoloader and Tooling.
4. Run `composer analyze` to verify the "Zero-Error" state.

### 🐧 Option 2: Linux (Debian/AlmaLinux)
1. Use [Ondřej Surý's PPA](https://deb.sury.org/) or [Remi Repo](https://rpms.remirepo.net/).
2. Install `php8.4-cli`, `php8.4-mbstring`, `php8.4-xml`, and `php8.4-zip`.
3. Follow the [Linux Setup Guide](docs/linux-setup.md).

---

## 🤖 AI-Assisted Development
CMSForNerd v3.4 is designed to be co-authored with AI Agents:

1. **Google Gemini (The Architect)**: Use for planning immutable logic and Level 8 PHPDoc refactoring.
2. **Google Antigravity (The Agent)**: Use for secure file writes, static analysis audits, and Git management.
3. **Workflow**: Describe changes → Review `implementation_plan.md` → Verify with `composer lab-check`.

> **v3.4 Security Tip:** Always use `$ctx->cspNonce` for inline scripts to comply with the Laboratory's Content Security Policy.

---

## 🧪 The Laboratory Curriculum (Updated v3.4)

Master backend engineering through our built-in modules:
1. **Module 1-2**: Architecture, PSR-12, & PSR-4 Autoloading.
2. **Module 3**: **Static Analysis Mastery** (Eliminating "Undefined" errors with PHPStan).
3. **Module 4**: Defensive Engineering, Path Sanitization, & CSP Security.
4. **Module 5**: Automated Testing & Logic Coverage.
5. **Module 6**: AI-Agentic Workflows & Pair Logic.
6. **Final Exam**: The "Zero-Error" Challenge (Passing Level 8 with a custom module).

Start your journey in the [🎓 Lab Manual](docs/lab-manual.md).

---

## ⚖️ Standards (RFC 2119 & v3.4 Engineering)

* **MUST**: Begin all files with `declare(strict_types=1);`.
* **MUST NOT**: Use `global` variables; use the `createCmsContext()` factory.
* **REQUIRED**: All new code **MUST** pass `composer analyze` (PHPStan Level 8).
* **SHOULD**: Use `readonly` properties for Context data to prevent state mutation.
* **MUST**: Follow the "Pair Logic" naming convention (`page.php` + `contents/page-body.inc`).

---

### 🛠️ Laboratory Automation Tools

To simplify the setup process for students and developers, we have provided automation scripts in the `tools/` directory. These scripts verify your environment and install the necessary "Nerd-Stack" components.

#### 🐧 For Linux & macOS

If you are on a Unix-like system, run the shell script:

```bash
chmod +x tools/setup-lab.sh
./tools/setup-lab.sh

```

#### 🪟 For Windows 11

If you are using Windows (with Laravel Herd or Laragon), run the PowerShell script:

```powershell
.\tools\setup-lab.ps1

```

#### What these tools do:

* **PHP 8.4 Check:** Ensures your CLI version is up to date.
* **Composer Audit:** Verifies Composer is installed and accessible.
* **Dependency Injection:** Automatically runs `composer install`.
* **Compliance Check:** Runs `composer lab-check` to ensure the "Zero-Debt" standard is met.

---

---

### Credits
* **Author:** Harisfazillah Jamel (LinuxMalaysia)
* **Assistant:** Google Gemini & Google Antigravity (v3.4 "Zero-Debt" Refactor)
* **Website:** [linuxmalaysia.com](https://www.linuxmalaysia.com)

*Modernization without loss of simplicity. Security without the bloat.*
