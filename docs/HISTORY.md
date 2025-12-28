# Modernization History: The v3.1 Journey

In late 2025, a landmark project was undertaken to bring **CMSForNerd** from its roots in 2005 into the modern PHP era. This document records the steps, standards, and improvements that transformed a classic flat-file CMS into a high-performance, standards-compliant, and secure teaching tool.

---

## 1. The PHP 8.4 Foundation
The entire codebase was refactored to support **PHP 8.4+ and PHP 9**. This included embracing modern object-oriented patterns while maintaining the "Radically Simple" philosophy of the original author.

* **Strict Types**: Every core file now starts with `declare(strict_types=1);`.
* **State Management**: Replaced hundreds of global variables with an immutable `CmsContext` object.
* **Modern Classes**: Implemented `readonly` classes and Constructor Property Promotion.



## 2. Standards & Compliance (PSR-12 & RFC 2119)
To ensure the codebase is professional and easy to maintain, we adopted global standards for style and requirements.

* **PSR-12 Style**: Standardized indentation (4 spaces), brace placement, and naming conventions.
* **RFC 2119 Maturity**: Codified architectural "Laws of the Project" using **MUST**, **SHOULD**, and **RECOMMENDED** terminology.
* **Automated Audits**: Integrated `php_codesniffer` and custom composer compliance workflows.

## 3. Security Hardening
Modern web threats require modern defenses. CMSForNerd v3.1 is now a bunker of security best practices.

* **Cloudflare Turnstile**: Integrated invisible bot protection for all forms.
* **Zero Directory Traversal**: Implemented strict `SecurityUtils` for sanitizing every request.
* **Content Security Policy (CSP)**: Hardened headers to block XSS and unauthorized script execution.
* **Bot Defense**: High-speed Regex-based detection to protect resources from aggressive scrapers.

## 4. Design Evolution (CSS Grid)
We replaced the legacy float-based layouts from the mid-2000s with a fluid, responsive **CSS Grid** system. The site now feels premium on 4K monitors and mobile phones alike.

## 5. Automated Testing Suite
For the first time in its history, CMSForNerd features a comprehensive test suite powered by **PHPUnit 12**.

* **Logic Tests**: Verifies core routing and context integrity.
* **Security Tests**: Ensures input sanitization and bot detection never fail.
* **Standards Tests**: Programmatically enforces PSR-12 and strict typing.



## 6. Rebranding: The Developer’s Laboratory
In late December 2025, the homepage was updated to reflect the project's core mission: serving as a **Developer’s Laboratory**. This shift emphasizes educational empowerment over simple content management.

## 7. Education: The Developer’s Lab Manual
The project was enhanced with a comprehensive Lab Manual, providing students with exercises in modern architecture, security, and testing.

* **Educational Tools**: Added the Lab Manual, Break-Fix Final Exam, Windows 11 Setup Guide, and Student Welcome Kit.
* **Standards Adoption**: Integrated **RFC 9116 (security.txt)** and established a formal Security Policy.
* **Worksheets**: Added Modules 1-6 and the Onboarding Kit.
* **AI Synergy**: Established the AI-Assisted Development workflow using **Google Gemini** and **Antigravity**.

---

> "Modernization without loss of simplicity." — *Harisfazillah Jamel & Google Gemini, 2025.*

---

### Recent Updates (2025-12-27)
* **Documentation**: Updated AI guidance in `.github/copilot-instructions.md`.
* **Examples**: Added `about.php` and `contents/about-body.inc`.
* **Maintenance**: Applied PSR-12/PHPCS auto-fixes and normalized line endings to **LF**.
* **Verification**: All style and compliance tests passed.