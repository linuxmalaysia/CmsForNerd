---
okf_version: 0.1
type: documentation
title: "Project Changelog"
description: "Sovereign log tracking all features, fixes, and architectural upgrades in CMSForNerd."
resource: "file:///CHANGELOG.md"
timestamp: "2026-07-27T12:00:00Z (Planned Handover Date)"
---
# CHANGELOG

All notable changes to this project are documented in this file.
Entries are grouped by date (most recent first).

---

## [4.1.5] - 2026-07-27 (Planned Handover Date) (DSOM Node Bootstrap & OpenSCAP Compliance Hardening)

### 🚀 DSOM Node Bootstrap & OS Baseline Playbook
- **Dual-Play Identity Bootstrapping**: Implemented a transition playbook `playbooks/bootstrap_node.yml` that handles Rootful identity bootstrap (Play 1) followed by Sovereign OS Baseline configuration (Play 2).
- **Sanitized Inventory Blueprint**: Created `inventory/hosts.example.yml` using `localhost` and private IP mappings to securely share configurations without leaking actual server coordinates.

### 🛡️ Dynamic OpenSCAP Auditing & Remediation
- **Latest SCAP Security Guide Retrieval**: Integrated tasks to query and download the latest SCAP guide ZIP dynamically via the GitHub API.
- **CIS Level 2 Auditing**: Configured automatic `oscap xccdf eval` against CIS Level 2 Server profile for Ubuntu 24.04 and RHEL/AlmaLinux systems.
- **OVAL Vulnerability Scanning**: Implemented system patch verification using Canonical's official OVAL streams.
- **Auto-Hardening Remediation**: Automatically generates and executes OpenSCAP-native bash remediation scripts to harden the target VM or node.
- **Unified Security Compliance Report**: Generates a unified report `SECURITY_AUDIT_REPORT.md` compiling both Lynis hardening index and OpenSCAP compliance scores.

## [4.1.4] - 2026-07-27 (Planned Handover Date) (Podman 5 Native Migration & Google Jules Ubuntu 26.04 Setup)

### 🐳 Pure Podman 5 Engine & Configurations
- **Pure Naming Standard**: Fully migrated Dockerfile definitions to native `Containerfile` and Docker-Compose to `compose.yml` across both
  staging and production playbooks.
- **Podman 5+ Supporting Suite**: Upgraded Debian/Ubuntu package specifications to install `uidmap`, `dbus-user-session`, and `catatonit`
  natively on Ubuntu 26.04.
- **Version Reporting**: Integrated automated version printing (`podman --version`) into the playbook infrastructure.

### 🤖 Google Jules Setup Guide
- **Sovereign Guidebook**: Authored `docs/HOWTO-SETUP-GOOGLE-JULES-UBUNTU-26-04.md` detailing unprivileged setups, lingering settings, and
  Cloud SDK integrations.

---

## [4.1.3] - 2026-07-27 (Planned Handover Date) (Feed Sitemaps & Certificate Hardening)

### 🛡️ Security Hardening
- **Dynamic XSS Mitigation**: Fully escaped standalone sitemaps, RSS feeds, and student certificate parameter outputs against XSS.
- **Host Header Poisoning Defense**: Centralised host-header base URL resolution into `SecurityUtils::getSafeBaseUrl()` to remove injection.
- **Centralised Page Scanning**: Created `SecurityUtils::discoverPages()` to parse content fragments, resolving logic duplication.
- **Restrictive CSP Headers**: Deployed robust default Content Security Policies for standalone sitemap generators.

### 🧪 Validation & Automated Testing
- **Security Unit Testing**: Added targeted test cases in `tests/SecurityTest.php` verifying traversal block lists and IPv6 bitmasks.
- **Compliance Audit**: Validated codebase readiness via `composer lab-check` yielding zero static analysis errors.

### 📘 Documentation Sync
- **Palace Protection Guide**: Created `docs/xss-protection-guide.md` tracking all secure practices.
- **Sitemap & SEO Updates**: Revised sitemap manuals to document dynamic paired page logic and host security controls.

## [4.1.0] - 2026-07-26

**Deep State of Mind Integration**

### 🧠 Deep State of Mind (DSOM) Core

- **Workspace Pluralisation**: Successfully migrated the `.agent` workspace to `.agents` plural.
- **Sovereign Rulebook**: Integrated the core rulebook (`AGENTS.md`) enforcing Zero-Global memory, OKF, and Sovereign Signatures.
- **Sovereign Agent Skills**: Deployed all 25 OKF-compliant sovereign skills inside `.agents/skills/`.
- **Spatial Memory Framework**: Configured the Sovereign Markdown Palace Wings and Registry under `.agents/brain/`.

### 🛠️ Tooling & Validation Suite

- **DSOM Tooling Suite**: Deployed high-fidelity scripts (`eod-palace.sh`, `git-ritual.sh`, etc.) to the `tools/` directory.
- **Unified Validation**: Overwrote and merged `tools/audit-pre-flight.sh` to include both PHP 8.4/8.3 environment checks and DSOM.
- **Quality Assurance**: Verified structural and syntactic correctness of the repository using `composer lab-check` passing Level 8 analysis.

## [4.0.0] - 2026-07-26 (Production Stable)

### 🐳 Containerization & Orchestration

- **Rootless Podman Automation**: Introduced secure Ansible playbooks for zero-downtime, rootless container deployment (Nginx & PHP-FPM 8.4).
- **Rootless Port-Binding Configuration**: Configured unprivileged host port-binding via sysctl (enabling unprivileged host-wide binding to port 80), SELinux mapping (`:Z`), and automatic firewall routing (UFW/Firewalld).
- **Orchestration Docs**: Deployed comprehensive deployment guide (`ANSIBLE_PODMAN_GUIDE.md`) to streamline rapid environment spin-ups.

### 🎨 Design & Accessibility

- **Adaptive Dark Mode Contrast**: Implemented responsive CSS overrides and custom variables (`--lab-info-bg`, `--lab-warning-bg`, etc.) globally.
- **Contrast Remediation**: Permanently fixed white-text-on-white-background legibility bugs in all laboratory guidelines and manuals.

### 🛡️ Security & Core Engine

- **Centralized Page Routing**: Extracted redundant request routing logic to `SecurityUtils::resolvePageName` for centralized defense.
- **Robust IPv6 Anti-DoS**: Hardened trusted bot-detection systems by implementing secure IPv6 bitmask logic for IP address verification.

### 🛠️ Quality Control & CI/CD

- **Fault-Tolerant CI/CD**: Hardened GitHub Actions checks to bypass SonarCloud gracefully when token credentials are not present.
- **Vendor Isolation**: Optimized static analysis (`phpcs` and `phpstan` rulesets) to strictly ignore `/vendor/` dependencies.

---

## [4.0.0-alpha] - 2026-03-30 (High-Fidelity & Zero-Debt)

### 🎨 Glassmorphism & UI

- **Phase 11 Compliance**: Integrated high-fidelity glassmorphism CSS tokens across standard and AMP views.
- **Visual Parity**: Achieved 100% color token synchronization between core engine and UI Audit Kit.

### 🛡️ Documentation & Records

- **Global Audit**: Conducted a comprehensive modernization of 40+ Markdown files (`docs/`, root, and `technical-resources/`).
- **Standardization**: Updated all laboratory manuals, guides, and security policies to reflect the v4.0.0 "Zero-Global" baseline.
- **History Synchronization**: Finalized records in `HISTORY.md` and `RELEASE_NOTES.md` to preserve the modernization journey.

## [3.6.0] - 2026-03-30 (Semantic Evolution & Zero-Global)

### 🧠 Semantic Architecture (v3.6)

- **Centralized Intelligence**: Refactored `CmsContext` to include a `readonly schemaType` property.
- **Automated Content Sniffer**: Implemented detection logic in `includes/bootstrap.php` that scans body fragments for
  technical signatures (`<?php`, `<code>`) to dynamically classify content as `TechArticle`, `Course`, or `WebPage`.
- **Zero-Global Registry**: Created `src/Registry.php` and refactored the bootstrap layer to eliminate all `global`
  keywords, reaching 100% architectural compliance.

### 🛡️ Documentation Hardening

- **Zero-Debt Compliance**: Conducted a global audit and remediation of all Markdown artifacts (`README.md`, `docs/`).
- **Lint Resolution**: Resolved over 100 structural violations (`MD013`, `MD022`, `MD024`, `MD032`, `MD036`) across the
  entire repository knowledge base.

### 🛠️ Technical Parity & Quality Control

- **Test Suite Alignment**: Synchronized PHPUnit and Pest test fixtures with the new `CmsContext` constructor signature.
- **Type-Safety Hardening**: Resolved surgical typing regressions in `includes/nav-helper.inc.php` to maintain absolute
  PHPStan Level 8 compliance.
- **PHPStan Optimization**: Increased static analysis memory limit to `512M` to prevent crashes during laboratory audits.

## [3.6.0] - 2026-03-15

### Added
- **SECURITY.md**: Implemented formal security policy defining maintenance stance.
- **PHP 8.4 Support**: Updated environment requirements to PHP 8.4.18.
- **GPG Keyring**: Transitioned to trusted.gpg.d standard.

### Changed
- **Upstream Sync**: Fully merged core engine logic from upstream master.
- **Dependencies**: Updated vendor baseline via Composer.

### Fixed
- **History Divergence**: Resolved legacy vendor conflicts via strategic reset.

---

## [3.5.9] - 2026-03-30 (EOD Stabilization & Tagging)

> "State of Mind Snapshot for Laboratory Review."

### 🧠 Cognitive Sync

- **Brain Artifacts**: Synchronized all `.agents/brain/` artifacts with the latest session intelligence.
- **Release Baseline**: Established `v3.5.9` as the official "Nerd-Lab" baseline for the end of March 2026.

---

## [3.5.8] - 2026-03-30 (JSON-LD Structured Data Audit)

### 🤖 AI-Native Optimization

- **JSON-LD Verification**: Formally audited the structured data engine in `common-headertag.inc`.
- **Dynamic Type-Switching**: Verified that the CMS accurately identifies `Course` vs `WebPage` schemas for enhanced
  indexing.

---

## [3.5.7] - 2026-03-26 (Laboratory & UI Stabilization)

> "Advanced Diagnostics & Workbox Caching."

### 🧪 Laboratory & UI Audit

- **UI Audit Kit**: Introduced `ui-kit.php` as a technical testing ground for CSS tokens, glassmorphism, and contrast levels.
- **AMP Acceleration Guide**: Deployed `amp-acceleration.php` to document the 75KB CSS budget and AMP-bind state management.
- **Absolute Path Security**: Synchronized `CmsContext` to mandate `baseUrl` resolution, fixing asset loading in nested PWA areas.

### 📱 PWA Performance (Workbox)

- **Workbox Migration**: Upgraded `sw.js` from vanilla JS to **Workbox v6**, implementing Stale-While-Revalidate strategies.
- **Offline Resilience**: Pre-cached `offline.php` via Workbox to ensure reliable fallback during network failures.

---

## [3.5.1] - 2026-03-25 (PWA Engine & CSP Hardening)

> "Zero-Refresh Navigation & Absolute Security Alignment."

### 📱 PWA & Mobile Architecture

- **SPA Hybrid Router**: Introduced an advanced vanilla JavaScript history interceptor (`router.js`) that detects
  `XMLHttpRequest` configurations and dynamically hydrates the `<main>` payload without triggering global server layouts.
- **Service Worker Resilience**: Integrated a `Stale-While-Revalidate` offline casing profile (`sw.js`).
- **Instant History (bfcache)**: Optimized memory-restoration by severing active networking paths via `AbortController` bound
  to the `pagehide` event lifecycle.

### 🛡️ CSP Multi-Directive Synchronization

- **AMP Worker Autonomy**: Overrode restrictive backend HTTP headers that were silencing web workers, implementing native
  `blob:` compatibility across `script-src`, `child-src`, and `worker-src`. Cloudflare Turnstile and AMP Component Worker
  executions are now unconditionally stable.

---

## [3.5.0] - 2026-03-14 (The "Zero-Global & State Sync" Milestone)

> "Global-Free Architecture & Persistent AI Symbiosis."

### 🏗️ Architecture & Core Logic

- **Zero-Global Arch**: Completely eliminated the `global` keyword from all 30+ page controllers and the master
  `bootstrap.php` engine, opting exclusively for precise Dependency Injection via factory method (`createCmsContext`).
- **Dual-View Controller**: Implemented a mode-switching engine in `pager.php` that routes users between `standard` and
  `amp` layouts based on URL parameters.
- **AMP Image Processor**: Added a real-time output buffer in the pager to transform standard `<img>` tags into valid
  `<amp-img>` tags with automatic aspect ratio handling.
- **Enhanced Bootstrap**: Updated `includes/bootstrap.php` to support localized laboratory settings and environment-specific
  constants without bleeding scope.

### 📱 Theme & UI (Mobile First)

- **Interactive Sidebar**: Created `themes/CmsForNerd/amp-sidebar.tpl` using the `amp-sidebar` component for zero-JS
  mobile navigation.
- **Active Navigation**: Developed a PHP-driven highlighting system to visually mark the current page within the sidebar.
- **Layout Hardening**: Added z-index management and "tap-fix" styles to ensure the mobile hamburger menu remains
  interactive on all devices.

### 🛡️ Security & Performance

- **CSP Nonce Synchronization**: Updated `includes/nav-helper.inc.php` to propagate unique nonces to all AMP-specific script tags.
- **CSS Size Guard**: Integrated an automated check that validates `amp.css` against the 75,000-byte AMP limit during rendering.
- **Strict Headers**: Hardened the Content Security Policy to explicitly allow the `cdn.ampproject.org` domain for scripts.

---

## [3.4.0] - 2026-01-01 (The "Zero-Debt" Milestone)

> "Engineering Excellence & Static Analysis."

### 🏗️ Architecture & Core Logic

- **Context Factory**: Refactored `CmsContext` instantiation into a central factory method `createCmsContext()` in
  `bootstrap.php` to ensure consistent state across the engine.
- **Immutable State**: Upgraded `CmsContext` to a `readonly` class to prevent runtime state corruption.
- **Installation v3.4**: Redesigned `installation.php` and `contents/installation-body.inc` to focus on
  professional deployment (Composer, PHPStan, and Server Hardening).

### 🛡️ Security & Quality Control

- **PHPStan Level 8**: Integrated **Static Analysis** as a mandatory requirement. Configured `phpstan.neon` to
  enforce strict type-safety and null-checks.
- **Zero-Debt Enforcement**: Added `composer analyze` and `composer lab-check` scripts to automate logic audits.
- **CSP Evolution**: Finalized the Nonce-tracking engine for Content Security Policy, ensuring all laboratory
  themes are XSS-resistant by default.
- **Strict Compliance**: All core files now pass the "Zero-Global" check.

---

## [3.3.0] - 2025-12-30 (The Developer's Laboratory)

> "Refining the Nerd Experience."

### 🚀 PHP 8.4 Deep Integration

- **Property Hooks**: Integrated PHP 8.4 property hooks for dynamic metadata handling within the `CmsContext`.
- **Constructor Promotion**: Refactored core classes to use constructor property promotion for reduced boilerplate.
- **Runtime Badge**: Added dynamic PHP version detection and badges to the Home and Installation pages.

### 🐧 Environment Optimization

- **Cross-Platform Parity**: Improved setup logic for Windows (Herd) and Linux (Nginx/FPM) environments.
- **Laboratory Manual**: Expanded the "Nerd-Stack" recommendation table, including Google Antigravity and Firefox
  Developer Edition.

---

## [3.1.1] - 2025-12-27 (Repository Normalization)

> "The Great Migration from PHP 4 to PHP 8.4."

### 🚀 The PHP 8.4 Foundation

- **Engine Upgrade**: Complete refactor from PHP 4/5 functional style to **PHP 8.4** strict object-oriented patterns.
- **Strict Typing**: Every core file now enforces `declare(strict_types=1);`.
- **State Management**: Eliminated legacy global variables in favor of an immutable **`CmsContext`** object.

### 🛡️ Security Hardening

- **RFC 9116**: Integrated `.well-known/security.txt` and a formal Security Policy.
- **CSP & Nonces**: Implemented Content Security Policy with dynamic nonces to block XSS.
- **Cloudflare Turnstile**: Added invisible bot protection for all forms.

---

## [1.0.0] - 2005-01-10 (The Original Foundation)

- **Initial Release**: A radically simple, flat-file CMS built for PHP 4.


---
*Deep State of Mind (DSOM) For My AI Protocol | Harisfazillah Jamel (LinuxMalaysia) | 2026-07-27 (Planned Handover Date)*
*Standard: UK English | DBP-standard Bahasa Melayu Malaysia (Piawai) | GNU General Public License v3.0*
