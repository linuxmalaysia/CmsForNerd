<!--
  CMSForNerd — AI assistant instructions
  Purpose: give an AI coding agent the concise, project-specific knowledge it needs to be productive.
  Keep this file short and actionable. Reference concrete files and commands that exist in the repo.
-->

# Quick instructions for AI coding agents

This repository is a flat-file, database-free PHP CMS (PHP 8.4+) that uses a "pair logic" template pattern and a Context object. Use the notes below to make safe, consistent changes.

- Project root: contains `composer.json` (PSR-4 autoload -> `includes/`) and page entry points like `index.php`.
- Key directories:
  - `includes/` — PHP classes (PSR-4 namespace `CmsForNerd\`) — e.g. `includes/CmsContext.php`, `includes/SecurityUtils.php`.
  - `contents/` — page content partials; pattern: each page has `{page}.php` and `contents/{page}-body.inc` ("pair logic").
  - `tests/` — PHPUnit tests. See `tests/CmsContextTest.php` for examples.

Rules to follow (strict and discoverable from repo):

1. Always add `declare(strict_types=1);` at the top of new PHP files.
2. Do NOT introduce `global` variables; use `CmsContext` (`includes/CmsContext.php`) for passing shared state.
3. Sanitize user input with `SecurityUtils::sanitizePage()` or existing helpers before use.
4. Use `$ctx->baseUrl` for domain/URL portability; avoid hard-coded hostnames.
5. Follow PSR-12 style (project enforces via `phpcs.xml`). Use `composer check-style` and `composer fix-style` scripts.

Build, test, and lint (examples):

- Install: `composer install`
- Run tests: `composer test` (invokes `phpunit`) or `vendor\bin\phpunit` on Windows
- Check style: `composer check-style` (invokes `phpcs` using `phpcs.xml`)
- Auto-fix style: `composer fix-style` (invokes `phpcbf`)
- Full compliance: `composer compliance` (runs check-style then test)

Notes about CI and analysis:

- GitHub Actions workflow: `.github/workflows/build.yml` runs SonarCloud scan. Keep changes small and test locally before pushing PRs.
- Vendor tools are available under `vendor/bin/` (the repo includes the expected dev dependencies).

Where to change page content safely:

- If you add or change a page, update both `page.php` (entrypoint) and `contents/{page}-body.inc`.
- Update `contents/history-body.inc` with a short note when you change behavior or public APIs — the project treats that file as the human-visible changelog.

Testing and coverage guidance:

- Unit tests live in `tests/`. The `phpunit.xml` bootstrap uses `vendor/autoload.php`.
- New non-trivial logic needs a focused unit test (happy path + one edge case) placed under `tests/` and using the `CmsContext` where appropriate.

Conventions and pitfalls observed in the codebase:

- Template pattern: many pages are minimal bootstrappers that compose content partials from `contents/`. Avoid moving rendering logic into the templates; keep controllers in `includes/`.
- Naming: content partials use `-body.inc` suffix (e.g., `contents/index-body.inc`). Follow that exact pattern.
- Namespace and autoload: classes under `includes/` use `CmsForNerd\` namespace per `composer.json` PSR-4 mapping.

If you are editing code:

1. Run `composer test` and `composer check-style` locally. Fix failing tests or style violations before making the commit.
2. Keep changes small and add or update a unit test for behavior changes.
3. Add `declare(strict_types=1);` to any new PHP file and include a short comment referencing the RFC or reason when the change affects security or public behavior.

When unsure, reference these files for intent and examples:

- `includes/CmsContext.php` — how shared state is passed.
- `includes/SecurityUtils.php` — input sanitization helpers.
- `contents/*-body.inc` — content partials and naming conventions.
- `phpcs.xml` and `composer.json` — style and scripts.
- `.cursorrules` — project-specific AI guidance and priorities.

After making edits, please ask the human maintainer for a quick review and confirm CI (SonarCloud) run results on the PR.

---
If this file already existed, merge any unique, high-value lines from it into this version and preserve author guidance. Ask me (the repo maintainer) for clarification where the code or history is ambiguous.

## Project rules & installation notes (from PROJECT_RULES.md / INSTALL)

Additions drawn directly from the project rules and install notes — follow these strictly when coding or changing the repo:

- PHP version: MUST target PHP 8.4 or newer and avoid deprecated features so code is forward-compatible with PHP 9.
- PSR-12 and strict typing: Every PHP file MUST begin with `declare(strict_types=1);` and conform to PSR-12 (`composer fix-style` helps).
- Namespace: Core classes MUST live under the `CmsForNerd\` namespace (PSR-4 autoload -> `includes/`).
- Shared state: All shared data MUST be accessed via the `CmsContext` object. DO NOT use `global`.
- Documentation: When you implement major features, security hardening, or architectural refactors, update `contents/history-body.inc`.
- Pre-submission check: Run `composer compliance` before creating a PR.
- Server requirements: Target hosts MUST have cURL and OpenSSL enabled for security features.
- File system: If you add web-based content upload, the web directory MUST be writable by the server user.
- Theme & pages:
  - Configure theme via `includes/global-control.inc.php`.
  - When adding a page `about.php`, also add its content partial `contents/about-body.inc` (pair-logic pattern).
- Turnstile: If your change touches forms, consider configuring Cloudflare Turnstile keys in `includes/turnstile.php`.
- Recommended local dev: Laravel Herd is recommended for Windows development; use Firefox Developer Tools for CSS/Grid debugging.

Keep these paired with the smaller rules above — they are enforced by CI or expected by maintainers.

## Contents includes (pair-logic and shared partials)

The `contents/` folder contains the content partials used by page entrypoints. When adding or updating pages, use the pair-logic pattern: create/update `page.php` and `contents/{page}-body.inc`.

Files in `contents/` (reference list):

- `ai-dev-body.inc`
- `ai-sop-body.inc`
- `common-headertag.inc` (meta/head tags shared across pages)
- `csp-nonce-guide-body.inc`
- `exam-answers-body.inc`
- `final-exam-body.inc`
- `footer.inc` (site footer partial)
- `graduation-body.inc`
- `hall-of-fame-body.inc`
- `header.inc` (site header partial)
- `history-body.inc` (also used as changelog target)
- `index-body.inc`
- `installation-body.inc`
- `lab-manual-body.inc`
- `lab-module1-body.inc`
- `lab-module2-body.inc`
- `lab-module3-body.inc`
- `lab-module4-body.inc`
- `lab-module5-body.inc`
- `left-side.inc` (left column partial)
- `linux-setup-body.inc`
- `right-side.inc` (right column partial)
- `security-policy-body.inc`
- `sitemap-page-body.inc`
- `template-body.inc` (theme/template example)
- `welcome-kit-body.inc`
- `windows-setup-body.inc`

Quick notes for working with these files:

- Prefer changing behavior in `includes/` classes rather than editing many content partials; content partials are for markup and page-specific text.
- `common-headertag.inc`, `header.inc`, `footer.inc`, `left-side.inc`, and `right-side.inc` are shared layout fragments — keep them small and avoid adding business logic.
- Use `$ctx` values (from `CmsContext`) inside partials when dynamic data is needed. Sanitize any user-supplied values via `SecurityUtils`.

---

## Quick example — add a page + test

Use this minimal checklist when adding a new page so AI agents follow project conventions and CI checks:

1. Create the entrypoint `about.php` (copy an existing page such as `windows-setup.php`) and keep it minimal — load `includes/global-control.inc.php`, `includes/common.inc.php`, create a `CmsContext`, and call `pager($ctx)`.
2. Add the content partial `contents/about-body.inc` (markup only — avoid business logic). Use `$ctx` for dynamic values and sanitize with `SecurityUtils`.
3. Add a focused test under `tests/`, for example `tests/AboutPageTest.php` that verifies the partial exists and contains expected text. Keep tests fast and local (bootstrap uses `vendor/autoload.php`).
4. Run `composer compliance` locally to ensure PSR-12 style and unit tests pass before pushing.

Example minimal test checklist (what to assert):
- The content file exists: `assertFileExists(__DIR__ . '/../contents/about-body.inc')`
- The content contains expected header text: `assertStringContainsString('About CMSForNerd', $content)`

When ready, push your branch and open a PR. Include a one-line description and note that you ran `composer compliance` locally.

