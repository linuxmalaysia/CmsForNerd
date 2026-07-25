# 🛡️ Security Policy (SECURITY.md)

This document outlines the procedures for reporting and managing security vulnerabilities within the **CMSForNerd v4.0.0** project.

## Responsible Disclosure
We value the work of security researchers. To encourage responsible disclosure, we promise not to pursue legal action against researchers who:
* Provide us with reasonable time to fix a bug before public disclosure.
* Avoid privacy violations and data destruction.
* Do not interrupt our laboratory services.

## Scope
The following components are in scope for security research:
* **Core Logic:** `src/SecurityUtils.php`, `src/CmsContext.php`, `src/Registry.php`.
* **Path Security:** Protection against directory traversal in routing and `SecurityUtils::resolvePageName()`.
* **XSS Protection:** Correct implementation of CSP Nonces and `SecurityUtils::escapeHtml()`.

## Reporting Channel
Send all reports to `security@cmsfornerd.test`. Use PGP encryption if the vulnerability is critical.
