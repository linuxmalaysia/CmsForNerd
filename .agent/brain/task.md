# Task: Sync GitBook Documentation with v3.5

- [x] Research & Audit
    - [x] Analyze `.gitbook.yaml` and `docs/SUMMARY.md`
    - [x] Identify stale version references (v3.4 -> v3.5)
    - [x] Map `docs/*.md` files to `contents/*.inc` functionality
- [x] Update Documentation Content
    - [x] Bump version to v3.5 in all `docs/` files
    - [x] Update "Pair Logic" descriptions to reflect `CmsContext` factory patterns
    - [x] Align architecture diagrams/descriptions with v3.5
- [x] Align Table of Contents
    - [x] Verify all new features (e.g., Turnstile, Hybrid Security) are documented
    - [x] Update `docs/SUMMARY.md` if new pages were added
- [x] Final Review & Notify
    - [x] Report major changes to user
    - [x] Final compliance check

# Task: Sitemap & SEO Synchronization (v3.5)
- [x] Sitemap Logic Sync
    - [x] Audit `sitemap.php` and `sitemap-generator.php`
    - [x] Refactor `sitemap-generator.php` to use "Pair Logic"
    - [x] Sync exclusion lists between generators
- [x] Metadata & Protocol Update
    - [x] Audit `robots.txt` and `labels.rdf`
    - [x] Bump versions to v3.5
    - [x] Link `common-headertag.inc` to dynamic RSS/ROR generators
- [x] Implement Syndication (RSS/ROR)
    - [x] Create `rss.php` (RSS 2.0)
    - [x] Create `ror.php` (ROR XML)
    - [x] Ensure "Pair Logic" consistency across all XML outputs
- [x] Verification
    - [x] Verify XML/HTML page list parity
    - [x] confirm no 404s for SEO assets

# Task: AI Agent Synchronization (v3.5)
- [x] Audit instruction sets
    - [x] Review `.github/copilot-instructions.md`
    - [x] Review `ai-dev.php` and `ai-sop.php`
    - [x] Identify outdated `AI-STATE-SYNC.md` (v3.1.3)
- [x] Update Configuration & Documentation
    - [x] Bump `AI-STATE-SYNC.md` to v3.5
    - [x] Modernize Copilot instructions for v3.5 & Antigravity
    - [x] Sync `docs/ai-dev.md` and `docs/ai-sop.md` with v3.5 content
    - [x] Create `.cursorrules` targeting `PROJECT_RULES.md`
- [x] Final Verification
    - [x] Verify agent-specific triggers (e.g., Copilot @-tags)
    - [x] Ensure consistent "Pair Logic" references across all guides

# Task: Persistence & Protocol (v3.5)
- [x] Create `.agent/workflows/nerd-lab-protocol.md`
- [x] Finalize State of Mind documentation
- [x] Notify user of persistent state capture

# Task: Intelligence Audit & State Sync (v3.5)
- [x] Restore "State of Mind" from persistent artifacts
- [x] Identity PSR-12 compliance failures (File-level docblocks)
- [x] Standardize headers (Docblock -> Declare)
    - [x] index.php, template.php, bootstrap.php
    - [x] SecurityUtils.php, common.inc.php, global-control.inc.php
    - [x] is_bot.php, nav-helper.inc.php
    - [x] sitemap_generator.php, turnstile.php, User.php
    - [x] CmsContext.php and other src/ files
- [x] Expand Protocol for "External Reality Checks"
    - [x] Add Git fetch/diff/log to `nerd-lab-protocol.md`
    - [x] Update `blog-state-sync.md` with VCS sync logic
- [x] Update `CONTRIBUTING.md` with "State of Mind" guidelines
- [x] Sync `DIRECTORY_SECURITY.md` and `DOCS_REQUIREMENTS.md` to v3.5 and GitBook
- [x] Debug & Fix `ror.php` (Fatal error: strict_types)
- [x] Final composer lab-check verification
    - [x] Fix `CmsContextTest` (ArgumentCountError)
    - [x] Fix `global-control.inc.php` indentation
    - [x] Fix `bootstrap.php` brace placement
