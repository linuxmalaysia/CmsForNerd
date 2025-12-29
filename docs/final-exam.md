# 🚩 The Final Exam: Break-Fix Challenge (v3.3)

> **Scenario:** A "junior dev" has pushed code that violates our RFC 2119 standards and breaks PSR-12 compliance. The site is vulnerable, and the tests are failing.

## 🎯 Graduation Requirements
To pass the "Certified Nerd" audit, you must repair the following 5 failures:

### ❌ Challenge 1: The Security Breach (Module 3)
**Vulnerability:** Path Traversal in `index.php`.
**Task:** Refactor the loader using `SecurityUtils::sanitizePageName()`.

### ❌ Challenge 2: The Logic Error (Module 1)
**Vulnerability:** Syntax error in Property Hooks.
**Task:** Fix the `get` hook in the `Project` class—remember that short-arrow hooks (`=>`) do not use the `return` keyword.

### ❌ Challenge 3: The PSR-12 Audit (Module 2)
**Vulnerability:** Style violations.
**Task:** Use `composer fix-style` or manually fix braces and indentation to pass the `phpcs` audit.

### ❌ Challenge 4: The Failing Test (Module 4)
**Vulnerability:** Weak assertions.
**Task:** Change `assertEquals()` to `assertSame()` to enforce strict type safety between strings and integers.

### ❌ Challenge 5: The CSP Leak (Module 3)
**Vulnerability:** XSS Exposure.
**Task:** Restrict the `script-src` directive from `*` to `'self'` plus your specific nonces.
