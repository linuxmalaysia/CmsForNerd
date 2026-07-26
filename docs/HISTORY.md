# 📜 Modernization History

Tracking the evolution of **CMSForNerd** from a legacy flat-file system to a modern educational powerhouse.

## Strategic Phases

### Phase 11: Automated Trust, Theme v4.0 & Orchestration

- **CI/CD Intelligence**: Implemented GitHub Actions for absolute compliance enforcement (Digital Sentry).
- **High-Fidelity Visuals**: Successfully integrated Glassmorphism tokens (--lab-glass-bg, --lab-blur) across both Standard and AMP views.
- **Global Variable Union**: Synchronized all color tokens to `--lab-purple`, achieving 100% parity between core CSS and the UI Audit Kit.
- **Cache-Busting Sentinel**: Implemented CSS versioning (?v=4.0.0) to force high-fidelity rendering across all laboratory interfaces.
- **Rootless Container Orchestration**: Deployed production-grade Ansible playbooks and Dockerfiles for rootless Podman deployment.
- **Adaptive Dark Mode Contrast**: Implemented adaptive CSS custom variables ensuring perfect contrast globally across all documentation.
- **Centralized Security checks**: Restructured request routing logic under `SecurityUtils::resolvePageName` to eliminate duplicates.

### Phase 7: Semantic Evolution & Zero-Global (v3.6.0)

- **Zero-Global Registry**: Reached 100% architectural compliance by eliminating the `global` keyword through the
  implementation of `src/Registry.php`.
- **Automated Content Sniffer**: Implemented detection logic that dynamically classifies content as `TechArticle`,
  `Course`, or `WebPage` based on technical signatures.
- **AI-Readiness**: Expanded the `CmsContext` state machine to support automated Schema.org tagging.
- **Zero-Debt Audit**: Global remediation of over 100 Markdown lint violations to ensure high-fidelity rendering.

### Phase 6: Laboratory & UI Stabilization (v3.5.7)

- **UI Audit Laboratory**: Bootstrapped `ui-kit.php` for technical theme and contrast verification.
- **AMP Acceleration Documentation**: Implemented `amp-acceleration.php` detailing dual-view logic.
- **Workbox Integration**: Migrated vanilla Service Worker to Google Workbox v6 for optimized caching.
- **Path Sovereignty**: Enforced absolute URI resolution (`baseUrl`) site-wide for subdirectory support.

### Phase 5: Modernization Mastery (v3.5.1)

- **Zero-Global Architecture**: Complete elimination of `global` state in 30+ controllers.
- **PWA SPA-Hybrid**: Introduced `Stale-While-Revalidate` caching and memory-instant `bfcache` routing for desktop and
  mobile.
- **CSP Standardization**: Achieved synchronized `nonce` tracking across standard SSR and AMP Blob workers.
- **Factory Pattern**: Refactored context initialization to `createCmsContext()` with explicit dependency injection.

### Phase 4: The Semantic Alignment (v3.4)

- **AI Readiness**: Modernized metadata layer with JSON-LD and Schema.org.
- **Theme Correction**: Standardized theme paths to `themes/CmsForNerd`.
- **Security Auditor**: Introduction of semantic audit tools for students.

## [4.0.0] - 2026-07-26 (Production Stable)

**"Zero-Global Architecture with Containerized Orchestration & High-Contrast Design"**

### 🐳 Rootless Container Orchestration
- **Ansible & Podman Core**: Created secure container recipes supporting user namespace mapping and host port binding optimizations.
- **Enterprise Linux Support**: Tailored playbooks to run seamlessly on modern Enterprise Linux (AlmaLinux) and Debian/Ubuntu systems.

### 🎨 High-Contrast Adaptive Dark Mode
- **Accessibility Parity**: Resolved white-text-on-white-background readability issues globally with targeted, high-specificity overrides.
- **Adaptive Variables**: Bound alerts and info panels to adaptive CSS properties (`--lab-info-bg`, `--lab-warning-bg`, etc.).

### 🛡️ Core Hardening & CI/CD Resilience
- **Centralized Routing**: Streamlined directory routing into `SecurityUtils::resolvePageName` to centralize path security.
- **IPv6 Security**: Hardened bot-detection algorithms with robust IPv6 bitmask operations.
- **CI/CD Resiliency**: Ensured GitHub Actions pipelines gracefully handle missing tokens or specific environment parameters.

---

## The v3.6 Journey: A Case Study

In 2026, **CMSForNerd v3.6** represents the pinnacle of "Radically Simple" engineering. This version finalizes the
transition into a fully synchronized, AI-native developer's laboratory.

### 1. The PHP 8.4/9 foundation

Refactored the 2005 foundation into PHP 8.4+ classes with PHP 9 readiness.
- **Strict Types**: Every file uses `declare(strict_types=1);`.
- **State Management**: **Zero global variable usage** (enforced by `Registry.php`).

### 2. Standards & Compliance

- **PSR-12**: Automated linting and formatting (verified by `composer compliance`).
- **Zero-Debt Docs**: 100% Markdown lint compliance reached on March 30, 2026.

---

## [3.6.0] - 2026-03-30 (Semantic Evolution)

**"Zero-Global & AI-Ready Baseline."**

### 🧠 Semantic Intelligence

- **Content Sniffer**: Automates the promotion of pages to `@type: TechArticle` or `Course` based on `<?php` or
  `<code>` detections.
- **CmsContext v3.6**: Enhanced with `schemaType` and `baseUrl` for absolute semantic fidelity.

### 🏗️ Global-Free Registry

- **Registry Design**: Centralized static store for laboratory tokens, replacing the legacy `global` scope.
- **Bootstrap v3.6**: Completely refactored `includes/bootstrap.php` for immutable state initialization.

### 🛡️ Documentation Hardening

- **Zero-Debt Compliance**: Global remediation of structural debt in `README.md`, `CHANGELOG.md`, and the `docs/` suite.

---

> "Modernization without loss of simplicity." — *Harisfazillah Jamel & Google Gemini, 2026.*