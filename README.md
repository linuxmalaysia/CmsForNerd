# CmsForNerd
**A Lightweight, Flat-File PHP CMS**

## Overview
CmsForNerd is a simple, database-free Content Management System designed for speed and simplicity. It uses flat files for content, requiring only PHP to run.

**Current Version:** 3.1 (27 Dec 2025)  
**Primary Maintainer:** Harisfazillah Jamel  
**Assisted By:** Google Gemini (AI-Assisted Refactoring)

---

## 🚀 New in Version 3.1 (PHP 8.4+ & PHP 9 Ready)
This project has been heavily modernized to support the latest PHP standards and improve security.

### Key Features
*   **PHP 8.4+ Ready**: Fully upgraded codebase using strict types, readonly classes, and modern syntax (`[]` arrays, match expressions).
*   **Context Object Pattern**: Replaced legacy global variables with a robust `CmsContext` object for better state management.
*   **Enhanced Security**:
    *   **Cloudflare Turnstile**: Integrated invisible bot protection for forms.
    *   **Bot Detection**: Optimized Regex-based detection to block scrapers effectively.
    *   **Directory Traversal Protection**: Strict input validation on all entry points.
*   **Clean Repository**: Removed legacy zip archives, unused scripts, and redundant files.

---

## 📂 Directory Structure

### 1. Content (`/contents`)
Your actual page content goes here.
*   `common-headertag.inc`: Metadata for `<head>`.
*   `footer.inc`: Site footer.
*   `right-side.inc` / `left-side.inc`: Sidebar columns.

### 2. Core Logic (`/includes`)
System files - generally, do not touch these unless you are a developer.
*   `common.inc.php`: Core display functions.
*   `CmsContext.php`: The main state object (New in v3.1).
*   `turnstile.php`: Cloudflare security integration.
*   `is_bot.php`: Bot detection logic.

### 3. Themes (`/themes`)
To create a custom look, duplicate the `CmsForNerd` folder. A theme consists of:
*   `pager.php`: The main layout controller (HTML skeleton).
*   `theme.php`: Configuration (pointers to CSS, etc).
*   `style.css`: Visual styling.
*   `header.tpl` / `bodytop.tpl` / `bodyfooter.tpl`: HTML fragments included by `pager.php`.

**To switch themes:**
1.  Create your new theme folder (e.g., `themes/MyTheme`).
2.  Open `includes/global-control.inc.php`.
3.  Change `$THEMENAME = "MyTheme";`.

---

## 🔧 Configuration
Most settings are controlled via `includes/global-control.inc.php`.

To enable **Cloudflare Turnstile**:
1.  Open `includes/turnstile.php`.
2.  Add your Secret Key.
3.  Add the frontend widget to your theme files.

---

## Credits
*   **Original Author:** Harisfazillah Jamel (LinuxMalaysia)
*   **Refactoring & Modernization:** Google Gemini (2025)
*   **Inspiration:** Conceptualized from Drupal and XAMPP architecture.

**Links:**
*   Website: [https://www.linuxmalaysia.com](https://www.linuxmalaysia.com)
*   GitHub Repository: [https://github.com/CMSForNerd/CmsForNerd](https://github.com/CMSForNerd/CmsForNerd)

---

### 🛠️ Maintenance Note
Remember to run `composer install` if you move the project to a new machine to ensure the autoloader and PHPUnit are ready to go.

*All changes have been committed and pushed to the GitHub repository. It has been a pleasure modernizing this "Radically Simple" CMS with you!*
