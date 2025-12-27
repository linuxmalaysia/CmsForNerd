# Copilot / AI assistant instructions for CmsForNerd

This file gives concise, repo-specific guidance for using GitHub Copilot, VS Code Copilot, or other AI coding assistants when contributing to CmsForNerd.

High-level contract
- Inputs: natural-language change requests, small focused code edits, or suggested refactor plans.
- Outputs: small, well-tested commits or PRs that preserve security and style. Avoid large, risky refactors without human review.
- Error modes: failing tests, PHPCS violations, or changes to vendor code.

Before you code
- Run the quick local checks:
  - composer install
  - composer fix-style
  - composer compliance
- Ensure you are on a feature branch with a descriptive name (e.g., `feat/add-about-page`, `fix/sitemap-bug`).

Coding rules for AI suggestions
- Follow PSR-12 and the repository's existing style. Use `phpcbf`/`composer fix-style` to auto-fix before committing.
- Always add or update PHPUnit tests for behavior changes. Tests are required for feature or bugfix PRs.
- Do NOT edit files under `vendor/`. Vendor normalization must be handled separately and only with human consent.
- Preserve `declare(strict_types=1);` in PHP files.
- Avoid introducing global state. Use `CmsForNerd\CmsContext` for shared state.

PR & Commit guidelines
- Commit message format: `type(scope): short description` (e.g., `fix(sitemap): validate url generation`).
- Include a short verification checklist in the PR body, e.g.:
  - [x] composer fix-style
  - [x] composer test
  - [x] composer compliance
- For multi-file or cross-cutting changes, include a migration/rollout note and request a human reviewer.

VS Code + Copilot tips
- Use VS Code workspace settings to enforce LF line endings and format-on-save. Prefer the `.vscode/settings.json` snippet in the README.
- Ask Copilot for small diffs (one feature or fix per PR). Use inline comments to describe desired behavior.

Security & safety
- Do not weaken input validation, CSP, or security headers. Any suggestion that reduces security must be rejected or escalated.
- Avoid adding new third-party services without an explicit dependency and security review.

If you're unsure
- Open a draft PR and request reviewers. Provide a short explanation and the tests you ran.

Thank you for helping keep CmsForNerd secure, simple, and well-tested.

For the full development standards (language, architecture, security, metadata and tools), see `docs/development-standards.md`.
