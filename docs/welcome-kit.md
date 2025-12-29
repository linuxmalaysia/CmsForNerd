# 🚀 Student Welcome Kit (v3.3)

> "Modernization without loss of simplicity."

Welcome to the lab. This document serves as your essential **Cheat Sheet** for managing your environment and passing your laboratory modules. 

---

## 🛠️ The Essential "Nerd Stack"

Before starting, verify your environment meets these standards:

| Tool | Purpose | Verification Command |
| :--- | :--- | :--- |
| **Laravel Herd** | PHP 8.4+ Runtime | `php -v` (Must be 8.4+) |
| **Git** | Version Control | `git --version` |
| **Antigravity** | AI-Native Terminal | Open App |
| **VS Code** | Code Editor / IDE | `code .` |

## 📂 Quick Start Commands

Run these inside your project root directory:

* **Initialize Project:** `composer install`
* **Run Compliance Audit:** `composer compliance`
* **Check PSR-12 Style:** `composer check-style`
* **Auto-Fix Formatting:** `composer fix-style`
* **Run Security Tests:** `composer test`

---

## ⚖️ Our RFC 2119 Standards

To pass your modules, your code must adhere to these strict requirement levels:

* **MUST:** Every file begins with `declare(strict_types=1);`.
* **MUST:** Opening braces for classes/methods are on a new line.
* **MUST NOT:** Use `global` variables. Use `CmsContext` object pattern.
* **SHOULD:** Aim for 90% code coverage in your logic.
* **MAY:** Use PHP 8.4 Property Hooks for simple data transformations.

## 🛡️ Security Laws

1.  **Never Trust User Input:** Always run input through sanitization utilities.
2.  **Escape Output:** Use `escapeHtml()` for all variables rendered in the theme.
3.  **Strict Routing:** Only include files that exist in the `contents/` directory.
4.  **RFC 9116:** Maintain your `security.txt` and [Security Policy](security-policy.md).

---

## 🎓 Path to Certification

1.  **Setup:** Install tools & clone repo.
2.  **Modules 1-3:** Master Architecture, Standards, and Security.
3.  **Modules 4-5:** Write Unit Tests and achieve Coverage.
4.  **Final Exam:** Solve the "Broken Lab" challenge.
5.  **Graduation:** Claim your v3.3 Digital Certificate!

[🚀 Start Laboratory Module 1](lab-module1.md)
