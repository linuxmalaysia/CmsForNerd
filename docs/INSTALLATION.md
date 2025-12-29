# 🛠️ Installation Guide

**CMSForNerd** is a lightweight, flat-file Content Management System geared towards developers and enthusiasts who want full control over their code. Unlike complex database-driven CMS platforms, CMSForNerd stores all content in simple text files.

---

## 📋 Requirements

To run the laboratory environment, ensure your system meets these specifications:

* **Web Server:** Nginx (Recommended), Apache, IIS, or LiteSpeed.
* **PHP Version:** PHP 8.2 or higher (**PHP 8.4 Recommended**).
* **Operating System:** Windows 11, Linux (Ubuntu/Debian), Unix, or FreeBSD.
* **Memory:** Minimum 256MB RAM.
* **Database:** None! (Flat-file architecture).

---

## 🚀 Installation Steps

Follow these steps to get your CMS up and running:

1.  **Download the Source:**
    Clone the repository or download the latest release from [GitHub](https://github.com/CMSForNerd/CmsForNerd).
    ```bash
    git clone [https://github.com/CMSForNerd/CmsForNerd.git](https://github.com/CMSForNerd/CmsForNerd.git)
    ```

2.  **Extract & Deploy:**
    Move the files to your web server's public directory (e.g., `public_html`, `www`, or your local Herd/Laragon path).

3.  **Dependency Setup:**
    Open your terminal in the root folder and run Composer to generate the autoloader:
    ```bash
    composer install
    ```

4.  **Permissions:**
    Ensure the web server has read/write access to the following directories:
    * `contents/`
    * `includes/`

5.  **Configuration:**
    Open `includes/global-control.inc.php` to customize your site name and default theme.

---

## 📂 The "Pair Logic" System

CMSForNerd uses a unique **Pair Logic** system for creating pages. Every page requires two components:

1.  **The Entry Point (Controller):** A `.php` file in the root (e.g., `about.php`) that initializes the `CmsContext`.
2.  **The Content Body (View):** A matching `.inc` file in the `contents/` folder (e.g., `contents/about-body.inc`).



---

## 🛡️ Security Features (v3.1)

The modernized framework includes:
* **Strict Typing:** `declare(strict_types=1);` on all core files.
* **CSP Nonce:** Automated Content Security Policy headers.
* **Bot Protection:** Built-in Cloudflare Turnstile support.

---

## 🧰 Recommended Nerd Stack

| Tool | Recommended Option |
| :--- | :--- |
| **Editor** | VS Code / Google Antigravity |
| **Local Server** | Laravel Herd (Windows/Mac) |
| **Browser** | Firefox Developer Edition |
| **Terminal** | PowerShell 7+ or Oh My Zsh |