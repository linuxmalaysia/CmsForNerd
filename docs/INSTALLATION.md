# 🛠️ Installation Guide: CMSForNerd v3.3

**CMSForNerd** is a lightweight, flat-file Content Management System geared towards developers and enthusiasts who want full control over their code. Unlike complex database-driven platforms, CMSForNerd stores all content in simple text files, making it incredibly fast, secure, and easy to backup—just copy the files!

---

## 📋 Requirements

To run the laboratory environment, ensure your system meets these specifications:

* **Web Server:** Nginx (Recommended), Apache, IIS, or LiteSpeed.
* **PHP Version:** **PHP 8.4+ REQUIRED** (supports Property Hooks and modern strict typing).
* **Operating System:** Windows 11, Linux (Ubuntu/Debian/AlmaLinux), Unix, or FreeBSD.
* **Dependency Manager:** [Composer](https://getcomposer.org/) is REQUIRED for autoloader generation.
* **Database:** **None!** (Radically simple flat-file architecture).

---

## 🚀 Installation Steps

Follow these steps to get your CMS up and running:

### 1. Download the Source
Clone the repository or download the latest release from GitHub:
```bash
git clone [https://github.com/CMSForNerd/CmsForNerd.git](https://github.com/CMSForNerd/CmsForNerd.git) .

```

### 2. Dependency Setup

Open your terminal in the root folder and run Composer. This step is crucial for the v3.3 PSR-4 Autoloader and PHPUnit readiness:

```bash
composer install

```

### 3. Permissions & Deployment

Move the files to your web server's public directory. Ensure permissions follow the 755/644 standard:

* **Linux (Debian/Ubuntu):** ```bash
sudo chown -R www-data:www-data .
sudo chmod -R 755 .
```

```


* **Windows:** Ensure the user running your web server (e.g., Laravel Herd) has read/write access to the `contents/` folder.

### 4. Configuration

Open `includes/global-control.inc.php` to customize your site name and default theme.

---

## 📂 The "Pair Logic" System

CMSForNerd uses a unique **Pair Logic** architecture. To create a new page (e.g., `about.php`), you need two components:

1. **The Entry Point (Controller):** A `.php` file in the root directory. You can copy `template.php` and rename it. This file initializes the `CmsContext` and acts as the request handler.
2. **The Content Body (View):** A file inside the `contents/` folder named `about-body.inc`. Put your raw HTML/PHP content here (only the portion intended for the `<body>` tag).

---

## 🛡️ Security Features (v3.3)

The modernized framework ensures a "Bunker" security posture:

* **Strict Typing:** `declare(strict_types=1);` is enforced on all core files to prevent PHP 9 compatibility issues.
* **Zero Directory Traversal:** Strict path validation via `SecurityUtils`.
* **Bot Protection:** Built-in [Cloudflare Turnstile](https://www.cloudflare.com/products/turnstile/) support. To enable, edit `includes/turnstile.php` and add your API keys.
* **AI-Assisted Hardening:** Achieved through development with **Google Gemini** and **Antigravity** to ensure code logic is clean and audited.

---

## 🧰 Recommended Nerd Stack

| Category | Recommended Option | Why? |
| --- | --- | --- |
| **Editor** | **Google Antigravity** / VS Code | AI-optimized coding and terminal speed. |
| **Local Server** | **Laravel Herd** | The fastest PHP 8.4 engine for Windows/Mac. |
| **Browser** | **Firefox Developer Edition** | Superior CSS Grid debugging and privacy tools. |
| **Maintenance** | **Composer** | Vital for compliance checks: `composer compliance`. |

---

## 🎓 Advanced: Theme Development (PHP 8.4)

When building themes, always use the **Context Object** pattern for clean, object-oriented inclusions. Avoid using global variables directly:

```php
// Standard v3.3 Theme Inclusion
include "themes/{$ctx->themeName}/header.tpl";

```

## 📜 Maintenance Note

Whenever you move the project to a new machine or pull updates, **MUST** run `composer install` to ensure the autoloader, PHPUnit 11+, and the Nerd-Stack are ready for the laboratory modules.

