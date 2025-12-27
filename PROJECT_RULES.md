# CMSForNerd Project Rules (For AI Agents)

When generating or refactoring code for CmsForNerd, you **MUST** follow these rules:

1.  **PHP 8.4+ & PHP 9 READY:** All code MUST use modern PHP features where appropriate and MUST be forward-compatible with PHP 9 (avoiding deprecated features).

1. **Style:** You **MUST** follow PSR-12 formatting. Use `composer fix-style` to correct any issues.
2. **Strict Typing:** You **MUST** ensure `declare(strict_types=1);` is present at the top of every PHP file.
3. **Namespace:** All core classes **MUST** reside within the `CmsForNerd\` namespace.
4. **State:** All shared data **MUST** be accessed via the `CmsContext` object. Code **MUST NOT** use the `global` keyword.
5. **Logic Requirements:** If a requirement is marked as **SHOULD** in `DOCS_REQUIREMENTS.md`, you may deviate only if you provide a technical justification.
6. **Documentation:** You **MUST** update the `contents/history-body.inc` file whenever you implement a major improvement, security hardening, or architectural refactor.

Run `composer compliance` to verify all standards before submitting your work.

