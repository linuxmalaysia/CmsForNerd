# # CMSForNerd Project Rules (For AI Agents)

When generating or refactoring code for **CmsForNerd v3.5** and above, you **MUST** follow these rules:

### 1. The "Baseline Sync" Protocol

* **Single Source of Truth:** `index.php` and `template.php` MUST be logically identical at all times.
* **Architecture Baseline:** These two files represent the "Latest and Greatest" state of the engine. All new page controllers created by students MUST be copies of this baseline.
* **Sync Rule:** Any security patch, performance update, or logic change applied to `index.php` MUST be immediately mirrored in `template.php`.

### 2. PSR-1: Basic Coding Standards

* **Side Effects (Section 2.3):** A file SHOULD either declare symbols (classes, functions, constants) or execute logic with side effects (outputting HTML, including files), but **SHOULD NOT do both**.
* *Exception:* Root entry points (e.g., `index.php`) and theme pagers are permitted to execute logic as front controllers/renderers.
* **Naming Conventions:** Class names in `StudlyCaps`, constants in `ALL_UPPER`, and methods in `camelCase`.
* **Encoding:** All files MUST be saved in **UTF-8 without BOM**.

### 3. PSR-12: Extended Coding Style

* **Indentation:** Use **4 spaces** for each indent level. **Tabs MUST NOT** be used.
* **Braces:** Opening braces for classes/methods on the **next line**. Opening braces for control structures (`if`, `match`) on the **same line**.
* **Visibility:** MUST be declared on all properties and methods.

### 4. PHP 8.4+ & PHP 9 READY

* **Strict Typing:** Every PHP file **MUST** start with `declare(strict_types=1);` immediately after the opening tag.
* **Modern Features:** Prioritize `match` expressions, constructor property promotion, and named arguments.
* **Deprecation Watch:** Avoid any features marked for removal in PHP 9 (e.g., implicit nullable types).

### 5. Architectural Structure: "The Pair Logic"

* **Master Pair:** The `.php` file acts as the Controller.
* **Slave Pair:** The `-body.inc` file in `contents/` acts as the UI fragment.
* **Content Parity (AMP Rule):** One fragment MUST serve all views. Never create separate content files for mobile/AMP. Use the Pager to transform the fragment dynamically.

### 6. Dual-View Routing & AMP

* **The Pager Dispatcher:** The theme's `pager.php` MUST handle view switching via the `view` parameter.
* **AMP Compliance:** AMP views MUST use `pageheader_amp()` from `nav-helper.inc.php` to ensure strict boilerplate validation.
* **Transformation:** Use output buffering (`ob_start`) in the Pager to convert standard tags to AMP tags (e.g., `<img>` to `<amp-img>`) to maintain fragment reuse.

### 7. Front Controller & Bootstrapping

* All entry points **MUST** include `includes/bootstrap.php`.
* **Performance:** Implement GZIP compression using `ob_start("ob_gzhandler");`.
* **Bot Hardening:** Use `is_bot.php` checks to serve text-mode content to crawlers.

### 8. State Management: The Context Pattern

* Use the **CmsContext** object for all shared data. **NEVER** use the `global` keyword.
* Initialize via `createCmsContext()` factory to ensure **CSP Nonce** and configuration safety.

### 9. Security & Gateways

* **Path Protection:** Validate all routing inputs via `\CmsForNerd\SecurityUtils::isValidPageName()`.
* **The "Silent Sentry":** Every directory MUST contain an `index.php` or `index.html` file returning a **403 Forbidden** header.
* **Namespacing:** All core logic MUST reside in the `\CmsForNerd\` namespace.

### 10. "Zero-Debt" UI & The Lab Aesthetic

* **Native-First:** Avoid external frameworks. Use CSS Grid, CSS Variables (`:root`), and Flexbox.
* **AMP Styles:** Custom AMP CSS MUST be placed in `themes/[theme]/css/amp.css` and injected via `<style amp-custom>`.

### 11. Educational Integrity & Compliance

* **Instructional Comments:** Add "Laboratory-style" comments to explain "The Why" behind code choices.
* **Verification:** All code must pass `phpstan` **Level 8** and `composer compliance`.

---

### 🚀 Verification Commands for the AI

1. **Style Check:** `vendor/bin/phpcs --standard=PSR12 [file_path]`
2. **Logic Check:** `vendor/bin/phpstan analyse [file_path] --level=8`
3. **AMP Check:** Use `amp-html` validator logic mentally on the `renderAmpLayout` output.
4. **Compliance Check:** `composer compliance`
