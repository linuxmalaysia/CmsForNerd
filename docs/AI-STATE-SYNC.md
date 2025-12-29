# CmsForNerd Project State Sync (v3.1.3)

## 🎯 Current Mission
We are refactoring a legacy flat-file CMS into a **Modern PHP 8.4 Laboratory Environment**. The goal is to teach students PSR standards, Dependency Injection, and Front Controller patterns.

## 🏗️ Architectural Decisions (MUST BE MAINTAINED)
1. **Bootstrap Pattern:** Every root `.php` file is a Front Controller. It MUST NOT load library files directly. It MUST load `includes/bootstrap.php`.
2. **Namespace:** Everything core is under `namespace CmsForNerd;`.
3. **Context Pattern:** Shared state is passed via the `CmsContext` object. No `global` keywords allowed.
4. **PSR Compliance:** - **PSR-12:** Formatting (use `composer fix-style`).
   - **PSR-1:** Separation of concerns. Files in `includes/` declare symbols; root files execute logic.
5. **Strict Typing:** `declare(strict_types=1);` is mandatory at the top of ALL files.

## 🚦 Completed Refactors
- [x] `includes/bootstrap.php` created as the central engine.
- [x] `CmsContext.php` refactored to a namespaced class.
- [x] `composer.json` updated with `lab-check`, `check-strict`, and PSR-4 autoloading.
- [x] `PROJECT_RULES.md` and `.cursorrules` updated for AI Agent guidance.
- [x] `docs/LAB-GUIDE.md` created for student curriculum.

## 🚧 Work In Progress
- **Refactoring Root Entry Points:** We have identified 24 root `.php` files (index, about, installation, sitemap, etc.) that need to be converted to the "Modern Front Controller" template.
- **Side-Effect Cleanup:** `includes/turnstile.php` and others need to be split to satisfy PSR-1 warnings.

## 🧪 Verification Commands
- `composer lab-check`: Verifies environment and strictness.
- `composer compliance`: Verifies PSR-12 and Unit Tests.
