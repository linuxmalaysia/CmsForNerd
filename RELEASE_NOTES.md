# 🚀 Release v3.4.0: The "Zero-Debt" Milestone

We are proud to announce the release of **CMSForNerd v3.4**, a major leap forward in our mission to provide the ultimate learning environment for modern PHP engineering. This update moves beyond simple features, introducing **Static Analysis** and **Zero-Trust Security** as the new laboratory standards.



---

## 🌟 What's New in v3.4?

### 🏗️ Engineering Excellence (Zero-Debt Architecture)
* **PHPStan Level 8 Integration**: Every core file is now audited for strict type-safety, null-pointer prevention, and logical consistency. The laboratory now enforces "Zero-Debt" coding.
* **Immutable Context Factory**: We have transitioned the `CmsContext` to a `readonly` pattern, initialized via a central factory in `includes/bootstrap.php`. This eliminates global state corruption and teaches students the power of **Immutability**.

### 🛡️ Hardened Security (Zero-Trust)
* **Native CSP Engine**: Full implementation of Content Security Policy (CSP) with dynamic nonces. Your laboratory site is now inherently resistant to Cross-Site Scripting (XSS).
* **Path & Input Sanitization**: Enhanced protection against Directory Traversal and LFI (Local File Inclusion) through strict filename normalization and path validation.

### 📦 Professional Tooling
* **Composer-First Workflow**: v3.4 requires Composer for PSR-4 autoloading and development tools. Use `composer analyze` to run a professional-grade security audit on your code.
* **v3.4 Laboratory Suite**: New `installation.php` and `index-body.inc` files designed to guide new developers through the "Nerd-Stack" (PHP 8.4, PHPStan, Nginx, and Google Antigravity).



---

## 🧪 Educational Impact
This release is not just a CMS update; it is a **curriculum update**. Students will now learn:
1. **Static Analysis Mastery**: How to pass PHPStan Level 8 (Industry Standard).
2. **Dependency Management**: Handling modern libraries and autoloading via Composer.
3. **Decoupled Architecture**: Building Global-free PHP applications using the Context Factory pattern.

---

## 📥 Installation & Upgrade

### New Laboratory Setup:
```bash
git clone [https://github.com/CMSForNerd/CmsForNerd.git](https://github.com/CMSForNerd/CmsForNerd.git)
cd CmsForNerd
composer install
composer lab-check

```

### Upgrading from v3.3:

1. **Core Logic**: Replace `includes/bootstrap.php` and `src/CmsContext.php` with the v3.4 versions.
2. **Configuration**: Update your `composer.json` and `phpstan.neon` to match the new laboratory standards.
3. **Audit**: Run `composer update` followed by `composer analyze` to verify your code passes the Level 8 audit.

---

## 💖 Credits

* **Lead Architect**: [Harisfazillah Jamel](https://github.com/linuxmalaysia)
* **Engineering Partner**: Google Gemini & Google Antigravity
* **Community**: Special thanks to the PHP 8.4 Early Adopters and the Malaysian Open Source community.

*"Modernization without loss of simplicity. Security without the bloat."*
