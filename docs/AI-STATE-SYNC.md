# CmsForNerd Project State Sync (v3.5)

## 🎯 Current Mission
We are maintaining a **Modern PHP 8.4 Laboratory Environment**. The core engine is fully refactored, and we are now focused on documentation synchronization, AI agent discovery, and architectural finalization.

## 🚧 Architectural Decisions (MUST BE MAINTAINED)
1. **Strict Pre-Flight:** Mandates `composer audit-pre-flight` and `git status` checks.
2. **Git-Delta Awareness:** The agent MUST verify local vs. remote state at start-of-day via `git fetch` and `git log` before assuming the persistent "Brain" artifacts are absolute.
2. **Bootstrap Pattern:** Every root `.php` file is a Front Controller. It MUST NOT load library files directly. It MUST load `includes/bootstrap.php`.
3. **Zero-Global Architecture:** (Critical v3.5 Law)
   - **NO** `global` keywords are allowed in Page Controllers or Functions.
   - **ALL** core dependencies (`$themeName`, `$cssPath`, etc.) MUST be passed explicitly via Factory Methods (e.g., `createCmsContext(..., themeName: $themeName)`).
4. **Namespace:** Everything core is under `namespace CmsForNerd;`.
5. **Context Pattern:** Shared state is passed via the `CmsContext` object. Initialize via `createCmsContext()` factory.
6. **PSR Compliance:** 
   - **PSR-12:** Formatting enforced via `composer fix-style`.
   - **PSR-1:** Separation of concerns (Logic vs. Symbols).
7. **Strict Typing:** `declare(strict_types=1);` is mandatory at the top of ALL PHP files.
8. **Pair Logic:** Every public page MUST consist of a `.php` controller and a `contents/*-body.inc` fragment.

## 🚦 Completed Refactors
- [x] **Zero-Global v3.5:** Refactored `includes/bootstrap.php` and 30+ controllers to eliminate implicit Global State.
- [x] `CmsContext.php` namespaced with Property Hooks (PHP 8.4).
- [x] **v3.4 Sync:** JSON-LD 2.0 and Theme normalization completed.
- [x] **v3.5 Milestone:** Sitemap "Pair Logic" refactor, dynamic RSS 2.0 (`rss.php`), and ROR XML (`ror.php`) implemented.
- [x] **AI Synergy:** Synchronized instructions for Google Gemini, Copilot, and Cursor.
- [x] **Nerd Lab Protocol:** Codified the persistent "State of Mind" workflow in `.agent/workflows/nerd-lab-protocol.md`.

## 🚧 Work In Progress
- **Documentation Finalization:** Syncing `docs/` with the latest v3.5 code examples.
- **GitBook Deployment:** Ensuring all markdown files reflect the "Laboratory" aesthetic.

## 🧪 Verification Commands
- `composer lab-check`: Verifies environment and strictness.
- `composer compliance`: Verifies PSR-12, Static Analysis (Level 8), and Unit Tests.
