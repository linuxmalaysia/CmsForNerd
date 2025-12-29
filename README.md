# 🚀 CmsForNerd v3.3 (2025 Edition)

**CmsForNerd** is a Lightweight, Radically Simple, Database-Free PHP Laboratory CMS designed as a live learning environment for modern developers.

**Current Version:** 3.3 (Bumping from 3.1 - Dec 2025)  
**Changelog:** See [CHANGELOG.md](CHANGELOG.md) for merge notes.  
**Primary Maintainer:** Harisfazillah Jamel  
**AI Architect:** Google Gemini & Google Antigravity

---

## 🛠️ Tech Stack & Development Environment

### Core Engine
* **Language:** PHP 8.4+ (Optimized for Property Hooks & Strict Types)
* **Architecture:** "Pair Logic" (CmsContext Object Pattern)
* **Server:** Nginx Latest (Recommended) or Apache 2.4+
* **OS:** Windows 11 (Herd), Debian, or AlmaLinux

### Professional Tooling
* **IDE:** [Google Antigravity](https://deepmind.google/technologies/gemini/) (AI-native) or VS Code
* **Package Manager:** Composer 2.7+
* **Testing & QA:** PHPUnit 11.5+ and PHP_CodeSniffer 3.11+ (PSR-12)
* **Browser:** Mozilla Firefox (For strict standard testing)

## 🚀 Installation & Laboratory Setup

### 🪟 Option 1: Windows 11 (Nerd-Stack)
1. Install [Laravel Herd](https://herd.laravel.com) and select **PHP 8.4**.
2. Clone the repo into your Herd `sites` folder.
3. Run `composer install` in **Google Antigravity Terminal**.
4. See the [Windows Setup Guide](docs/windows-setup.md) for full details.

### 🐧 Option 2: Linux (Debian/AlmaLinux)
1. Use [Ondřej Surý's PPA](https://deb.sury.org/) (Debian) or [Remi Repo](https://rpms.remirepo.net/) (RHEL).
2. Install `php8.4-cli`, `php8.4-mbstring`, and `php8.4-xml`.
3. See the [Linux Setup Guide](docs/linux-setup.md).

---

## 🤖 AI-Assisted Development
CMSForNerd v3.3 is designed to be co-authored with AI Agents:

1. **Google Gemini (The Architect)**: Use for planning logic and RFC refactoring.
2. **Google Antigravity (The Agent)**: Use for file writes, audits, and Git management.
3. **Workflow**: Describe changes in natural language → Review `implementation_plan.md` → Verify with `composer compliance`.

> **VS Code Tip:** If using VS Code, ensure **EditorConfig** and **PHP Intelephense** are installed to respect the `.vscode/settings.json` provided in this repo.

## 🧪 The Laboratory Curriculum

Master backend engineering through our built-in modules:
1. **Module 1-2**: Architecture & PSR-12 Standards.
2. **Module 3**: Defensive Engineering & RFC 9116.
3. **Module 4-5**: Automated Testing & Coverage.
4. **Module 6**: AI-Agentic Workflows.
5. **Final Exam**: The "Break-Fix" Challenge.

Start your journey in the [🎓 Lab Manual](docs/lab-manual.md).

---

## ⚖️ Standards (RFC 2119)

* **MUST**: Begin all files with `declare(strict_types=1);`.
* **MUST NOT**: Use `global` variables; use the `CmsContext` object.
* **SHOULD**: Maintain 90% test coverage for new logic.
* **MUST**: Follow the "Pair Logic" naming convention (`page.php` + `page-body.inc`).

---

### Credits
* **Author:** Harisfazillah Jamel (LinuxMalaysia)
* **Assistant:** Google Gemini & Google Antigravity (2025 Refactor)
* **Website:** [linuxmalaysia.com](https://www.linuxmalaysia.com)

*Modernization without loss of simplicity.*