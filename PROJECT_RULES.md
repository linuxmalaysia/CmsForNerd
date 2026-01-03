# # CMSForNerd Project Rules (For AI Agents)

When generating or refactoring code for **CmsForNerd v3.4** and above, you **MUST** follow these rules:

### 1. The "Baseline Sync" Protocol

* **Single Source of Truth:** `index.php` and `template.php` MUST be logically identical at all times.
* **Architecture Baseline:** These two files represent the "Latest and Greatest" state of the engine. All new page controllers created by students MUST be copies of this baseline.
* **Sync Rule:** Any security patch, performance update, or logic change applied to `index.php` MUST be immediately mirrored in `template.php`.

### 2. PSR-1: Basic Coding Standards

* **Side Effects (Section 2.3):** A file SHOULD either declare symbols (classes, functions, constants) or execute logic with side effects (outputting HTML, including files), but **SHOULD NOT do both**.
* *Exception:* Root entry points (e.g., `index.php`) are permitted to execute logic as they are the front controllers.


* **Naming Conventions:**
* Class names MUST be declared in `StudlyCaps`.
* Class constants MUST be in all caps with underscore separators (`CORE_VERSION`).
* Method names MUST be declared in `camelCase`.


* **Encoding:** All files MUST be saved in **UTF-8 without BOM**.

### 3. PSR-12: Extended Coding Style

* **Indentation:** Use **4 spaces** for each indent level. **Tabs MUST NOT** be used.
* **Braces:** * Opening braces for classes and methods MUST go on the **next line**.
* Opening braces for control structures (`if`, `foreach`, `match`) MUST go on the **same line**.


* **Visibility:** MUST be declared on all properties and methods (`public`, `private`, `protected`).
* **Line Length:** Soft limit is **120 characters**; lines SHOULD be 80 characters or less.

### 4. PHP 8.4+ & PHP 9 READY

* Use modern PHP features: `match` expressions, constructor property promotion, and named arguments.
* **Strict Typing:** Every PHP file **MUST** start with `declare(strict_types=1);` immediately after the opening `<?php` tag.
* Ensure forward-compatibility with **PHP 9** by avoiding all deprecated features.

### 5. Architectural Structure: "The Pair Logic"

* **Master Pair:** The `.php` file (e.g., `index.php`, `about.php`) acts as the Controller.
* **Slave Pair:** The `-body.inc` file in the `contents/` directory acts as the UI fragment.
* All logic execution in the Master MUST be separated from declarations as per Rule #2.

### 6. Front Controller & Bootstrapping

* All entry points **MUST** include `includes/bootstrap.php`.
* **Performance:** Implement GZIP compression using `ob_start("ob_gzhandler");`.
* **Bot Hardening:** Use `is_bot.php` checks to serve text-mode content to crawlers.

### 7. State Management: The Context Pattern

* Use the **CmsContext** object for all shared data. **NEVER** use the `global` keyword.
* Initialize via the `createCmsContext()` factory method to ensure **CSP Nonce** and configuration safety.
* Use Null Coalescing (`??`) for configuration extractions to prevent `TypeError`.

### 8. Security & Gateways

* **Path Protection:** Validate all routing inputs via `\CmsForNerd\SecurityUtils::isValidPageName()`.
* **The "Silent Sentry":** Every directory (Core, Themes, Contents) **MUST** contain an `index.php` or `index.html` file that returns a **403 Forbidden** header.
* **Namespacing:** All logic MUST reside in the `\CmsForNerd\` namespace. Use FQCN for global scope calls.

### 9. "Zero-Debt" UI & The Lab Aesthetic

* **Native-First:** Avoid external frameworks (Bootstrap/Tailwind). Use CSS Grid, CSS Variables (`:root`), and Flexbox.
* **Environment:** Optimized for the **Google Antigravity** development stack.

### 10. Educational Integrity & Compliance

* **Instructional Comments:** Add "Laboratory-style" comments to explain "The Why" behind code choices.
* **Verification:** All code must pass `phpstan` **Level 8** and `composer compliance`.

---

### 🚀 Verification Commands for the AI

Before submitting code, the AI agent should "run" these checks mentally (or via CLI):

1. **Style Check:** `vendor/bin/phpcs --standard=PSR12 [file_path]`
2. **Logic Check:** `vendor/bin/phpstan analyse [file_path] --level=8`
3. **Compliance Check:** `composer compliance`
