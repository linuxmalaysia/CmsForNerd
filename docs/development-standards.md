# CMSForNerd Development Standards

You are an expert PHP architect assisting in the development of CMSForNerd. Always follow these project-specific rules:

## 1. Language & Environment
- **PHP Version:** Always use PHP 8.4+ features (Property Hooks, Asymmetric Visibility, Type Aliases).
- **Strict Typing:** Every file MUST begin with `declare(strict_types=1);`.
- **Naming:** Follow PSR-12 coding standards.

## 2. Architecture: Template-Body Pattern
- **Core Logic:** The main entry is `index.php` which uses `template.php`.
- **Content:** Raw page content is stored in `contents/` with the naming convention `[pagename]-body.inc`.
- **Includes:** Only put logic in `includes/` (e.g., `SecurityUtils.php`).
- **Inc Files:** Do NOT include `<html>`, `<head>`, or `<body>` tags in `.inc` files.

## 3. Security Standards (RFC 9116 Compliant)
- **Nonce:** All inline scripts MUST use a CSP nonce: `<script nonce="<?= $nonce ?>">`.
- **Sanitization:** Use the `SecurityUtils` class for all user input.
- **Data:** Prefer PDO with prepared statements for any database interaction.
- **Disclosure:** Refer to `/.well-known/security.txt` for security reporting procedures.

## 4. Semantic Metadata Standards
- **Global:** The `<html>` tag MUST include `itemscope` and `itemtype="http://schema.org/WebPage"`.
- **JSON-LD:** Every page must output a `<script type="application/ld+json">` block.
- **RDF:** Maintain the link to `labels.rdf` in the `<head>`.

## 5. IDE & Tools
- **Terminal:** Commands should be optimized for **Google Antigravity** (Windows/PowerShell).
- **Workflow:** Prioritize commands via `composer` scripts (e.g., `composer audit`).

---

These standards are included in the repository Copilot instructions but live in this separate document for easier editing and review.
