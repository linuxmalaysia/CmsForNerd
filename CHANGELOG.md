# CHANGELOG

All notable changes to this project are documented in this file.

Entries are grouped by date (most recent first).

## 2025-12-27 — merged updates

Summary

- Documentation and AI guidance improvements.
- Added a small example page and a content partial.
- Minor include/test fixes were applied.
- A repository normalization commit (line endings and whitespace) was merged.

Files and artifacts changed

- `.github/copilot-instructions.md` — added/updated with repository-specific guidance for AI assistants and contributor rules.

- `about.php` — example entrypoint following the project's paired-entry + partial pattern.

- `contents/about-body.inc` — example content partial for `about.php`.

- `contents/history-body.inc` — history page updated with a "Recent updates (2025-12-27)" changelog section.

- `tests/AboutPageTest.php` — small PHPUnit test added/updated to validate the example page and partial.

- `includes/*` — minor fixes and whitespace cleanups (PSR-12 / phpcbf auto-fixes).

- Line endings normalization: many `*.php`, `*.inc`, and `*.md` files were converted from CRLF to LF to ensure cross-platform consistency.

Verification performed

- `composer install` run successfully; no dependency changes.

- `composer fix-style` (phpcbf) applied automatic fixes for whitespace / end-of-file problems.

- `composer compliance` (style + tests) executed and passed on merge and post-merge checks.

  - PHPUnit: OK (7 or 8 tests depending on pre/post small test changes)

Important notes and guidance

- Vendor files: the LF normalization touched some files under `vendor/` (test fixtures etc.).

  These changes are harmless but noisy in diffs. If you prefer, we can revert vendor
  changes to match upstream vendor packages and keep only project source files normalized.

- Reverting vendor normalization (optional): to revert the vendor files changed by the normalization commit
  while keeping project files normalized, run these commands locally:

```powershell
# Reset vendor to the current remote state (safe, non-destructive to your working tree)
git fetch origin --depth=1
git checkout origin/master -- vendor
git add -A vendor
git commit -m "chore(vendor): revert vendor normalization to upstream state"
git push
```

- Rollback a specific merged branch/PR: If you need to revert the merge that introduced these changes, create a revert commit using:

```powershell
git checkout master
git pull origin master
git revert -m 1 <merge-commit-sha>
git push
```

Developer checklist (what was done)

- [x] Created/updated `.github/copilot-instructions.md` with repository guidance.

- [x] Added example page `about.php` and `contents/about-body.inc`.

- [x] Added/updated `tests/AboutPageTest.php`.

- [x] Fixed PSR-12 issues with `phpcbf` and verified style/test compliance.

- [x] Normalized line endings for project source files to LF and committed the change.

If you want this entry shortened or moved into a release-specific section (for example, "v3.1.1"),
tell me which release/tag to use and I will update this file accordingly.

---

Generated: 2025-12-27

# Changelog: The Great Migration (v1.0 → v3.1)

All notable changes to **CMSForNerd** documenting the journey from PHP 4 (2005) to PHP 8.4 (2025).

---

## [3.1.0] - 2025-12-28 (The "Modern Nerd" Release)
**"Modernization without loss of simplicity."**

### 🚀 The PHP 8.4 Foundation (Migration from v1.0 / PHP 4)
- **Engine Upgrade**: Complete refactor from PHP 4/5 functional style to **PHP 8.4** strict object-oriented patterns.
- **Strict Typing**: Every core file now enforces `declare(strict_types=1);`.
- **State Management**: Eliminated legacy global variables in favor of an immutable **`CmsContext`** object.
- **Modern Syntax**: Implemented **Property Hooks**, **Readonly Classes**, and **Constructor Property Promotion**.

### 🛡️ Security Hardening (Anti-Fragility)
- **RFC 9116**: Integrated `.well-known/security.txt` and a formal Security Policy.
- **CSP & Nonces**: Implemented Content Security Policy with dynamic nonces to block XSS.
- **Cloudflare Turnstile**: Added invisible bot protection for all forms.
- **Input Sanitization**: Introduced `SecurityUtils` to prevent Directory Traversal and SQLi.

### 🤖 AI & Semantic Stack
- **AI-Ready Architecture**: Structured content for Gemini/LLM consumption via `.github/copilot-instructions.md`.
- **Triple-Layer Metadata**: Integrated **Microdata (Schema.org)**, **JSON-LD**, and **RDF** into every page.
- **Static Baking (SSG)**: Developed GitHub Actions (`static-build.yml`) to "bake" PHP into ultra-fast static HTML.

### 🧪 Quality Assurance
- **PHPUnit 12**: Integrated the latest testing framework using **PHP 8 Attributes** (`#[Test]`) for test discovery.
- **Semantic Auditor**: Created `tools/audit-semantics.php` to automate compliance checks.
- **PSR-12**: Enforced universal coding standards via `phpcbf` and `phpcs`.

---

## [2.0.0] - 2025-12-20 (Intermediate Architecture)
### Added
- **CSS Grid**: Replaced 2005-era float layouts with modern Responsive Grid systems.
- **The Developer’s Laboratory**: Rebranding of the project from a "Simple CMS" to an "Educational Lab."
- **Lab Manual**: Created Modules 1-6 and the "Break-Fix Final Exam" for student training.

---

## [1.0.0] - 2005-01-10 (The Original Foundation)
- **Initial Release**: A radically simple, flat-file CMS built for PHP 4.
- **Core Concept**: Paired entry points (`about.php`) with content partials (`about-body.inc`).
