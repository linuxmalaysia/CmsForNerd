# CMSForNerd Project Rules (For AI Agents)

When generating or refactoring code for CmsForNerd, you **MUST** follow these rules:

1. **PHP 8.4+ & PHP 9 READY:** Use modern PHP features (match, constructor property promotion, named arguments) and ensure forward-compatibility with PHP 9 by avoiding deprecated features.

2. **Front Controller & Bootstrap:**
   - All root entry points (e.g., `index.php`, `installation.php`) **MUST** include `includes/bootstrap.php`.
   - Logic execution **MUST** be separated from declarations as per PSR-1.

3. **PSR Compliance:**
   - **PSR-12:** Strict adherence to coding styles.
   - **PSR-1:** Files MUST NOT mix function/class declarations with execution logic (side effects), except in root entry points.

4. **Strict Typing:** Every PHP file **MUST** start with `declare(strict_types=1);`.

5. **Namespacing:**
   - All classes and functions MUST reside in the `CmsForNerd\` namespace.
   - Use Fully Qualified Class Names (FQCN) like `new \CmsForNerd\CmsContext()` when calling from the global scope.

6. **State Management (The Context Pattern):**
   - Access all shared data through the `CmsContext` object.
   - **NEVER** use the `global` keyword.
   - Use the Null Coalescing Operator (`??`) for all configuration extractions to prevent `TypeError`.

7. **Educational Integrity:**
   - Add "Laboratory-style" comments to explain "The Why" behind architectural choices.
   - Maintain and reference `docs/LAB-GUIDE.md` for student-facing modifications.

8. **Verification:** All code must pass `composer lab-check` and `composer compliance`.
