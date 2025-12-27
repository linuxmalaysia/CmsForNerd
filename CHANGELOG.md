# CHANGELOG

All notable changes to this project are documented in this file.

Entries are grouped by date (most recent first).

## 2025-12-27 — merged updates

Summary
- Documentation and AI guidance improvements, a small example page and content partial, minor include/test fixes, and a repository normalization commit were merged.

Files and artifacts changed
- `.github/copilot-instructions.md` — added/updated with repository-specific guidance for AI assistants and contributor rules.
- `about.php` — example entrypoint following the project's paired-entry + partial pattern.
- `contents/about-body.inc` — example content partial for `about.php`.
- `contents/history-body.inc` — history page updated with a "Recent updates (2025-12-27)" changelog section.
- `tests/AboutPageTest.php` — small PHPUnit test added/updated to validate the example page and partial.
- `includes/common.inc.php`, `includes/CmsContext.php`, `includes/SecurityUtils.php`, and related `includes/*` — minor fixes and whitespace cleanups (PSR-12 / phpcbf auto-fixes).
- Line endings normalization: many `*.php`, `*.inc`, and `*.md` files were converted from CRLF to LF to ensure cross-platform consistency.

Verification performed
- `composer install` run successfully; no dependency changes.
- `composer fix-style` (phpcbf) applied automatic fixes for whitespace / end-of-file problems.
- `composer compliance` (style + tests) executed and passed on merge and post-merge checks.
  - PHPUnit: OK (7 or 8 tests depending on pre/post small test changes)

Important notes and guidance
- Vendor files: the LF normalization touched some files under `vendor/` (test fixtures etc.). These are harmless but noisy in diffs; if you prefer, we can revert vendor changes to match upstream vendor packages and keep only project source files normalized.

- Reverting vendor normalization (optional): to revert the vendor files changed by the normalization commit while keeping project files normalized, run these commands locally:

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

If you want this entry shortened or moved into a release-specific section (for example, "v3.1.1"), tell me which release/tag to use and I will update this file accordingly.

---

Generated: 2025-12-27
