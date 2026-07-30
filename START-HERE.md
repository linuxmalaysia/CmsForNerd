---
okf_version: 0.1
type: documentation
title: "📍 START-HERE: Master Onboarding Map"
description: "Sovereign roadmap with 12 defined Entry Points mapping code, deployment, rules, and governance."
resource: "file:///START-HERE.md"
topics: [onboarding, entrypoints, map, dsom]
timestamp: 2026-07-27T12:00:00Z
---
# 📍 START-HERE: Master Onboarding Map

Welcome to the **CmsForNerd v4.1.0** Sovereign AI & Human Onboarding Map. This file serves as the master blueprint
linking to all 12 major Entry Points of the platform, enabling instant orientation and semantic traversal.

---

## 🏛️ The 12 Defined Entry Points

| Entry Point | Name | File Path / Link | Semantic Purpose |
| :---: | :--- | :--- | :--- |
| **1** | **Engineering Entry Point** | [`docs/HOWTO-CLONE-DSOM-PROJECT.md`](docs/HOWTO-CLONE-DSOM-PROJECT.md) | Standard developer setup, cloning, and local environments. |
| **2** | **Cognitive Entry Point** | [`.agents/AGENTS.md`](.agents/AGENTS.md) | Full AI Constitution, operational laws, rules, and persona DNA. |
| **3** | **Master Onboarding Map** | [`START-HERE.md`](START-HERE.md) | This index — the global directory and subsystem topological map. |
| **4** | **Daily Operations Entry Point** | [`docs/HOWTO-PALACE-ONBOARDING.md`](docs/HOWTO-PALACE-ONBOARDING.md) | Guided walk of the Sovereign Markdown Palace Wings and Halls. |
| **5** | **Legacy Upgrade Entry Point** | [`docs/HOWTO-UPGRADE-LEGACY-DSOM.md`](docs/HOWTO-UPGRADE-LEGACY-DSOM.md) | Protocols to port and modernize legacy PHP setups to v4+. |
| **6** | **Subagent Swarm Entry Point** | [`docs/governance/MULTI-AGENT-PROTOCOLS.md`](docs/governance/MULTI-AGENT-PROTOCOLS.md) | Orchestration protocols for multi-agent workflows. |
| **7** | **Procedural Skill Entry Point** | [`docs/governance/AI-SKILL-ARCHITECTURE.md`](docs/governance/AI-SKILL-ARCHITECTURE.md) | Structuring of standard operating procedures in `.agents/skills/`. |
| **8** | **Sovereign Knowledge Entry Point**| [`docs/governance/LLM-WIKI-ADOPTION.md`](docs/governance/LLM-WIKI-ADOPTION.md) | Guidelines for Knowledge Compounding and LLM-Wiki workflows. |
| **9** | **Security & Audit Entry Point** | [`docs/governance/GITOPS-AIOPS-ANSIBLE-STRATEGY.md`](docs/governance/GITOPS-AIOPS-ANSIBLE-STRATEGY.md) | Hardening, OpenSCAP auditing, and host compliance. |
| **10** | **Infrastructure Orchestration** | [`playbooks/deploy_prod_compose.yml`](playbooks/deploy_prod_compose.yml) | Ansible playbooks for rootless Podman 5 production stack. |
| **11** | **Local Development Setup** | [`technical-resources/installation-guide.md`](technical-resources/installation-guide.md) | PHP 8.4 runtime config, local composer setup, server execution. |
| **12** | **Core Routing & Theme** | [`themes/CmsForNerd/pager.php`](themes/CmsForNerd/pager.php) | Central routing, Standard vs AMP view, layout controller. |

---

## 🏗️ Structural Map

### 1. The Core Codebase (The Web Stack)
- **`includes/bootstrap.php`:** Core engine. Initializes the immutable `CmsContext` with automated content sniffer.
- **`src/Registry.php`:** Zero-Global registry storage to completely replace the legacy `global` keyword.
- **`src/CmsContext.php`:** Immutability state container holding page parameters, theme metadata, and security nonces.
- **`themes/CmsForNerd/pager.php`:** Front Controller router that splits rendering between Desktop/Standard and AMP views.
- **`contents/`:** UI presentation fragments paired with their controller logic (e.g., `about-body.inc` for `about.php`).

### 2. The Cognitive Workspace (Deep State of Mind - DSOM)
- **`AGENTS.md` (root):** Discovery gateway for platform assistants (Jules, Cursor, Copilot).
- **`.agents/AGENTS.md`:** Sovereign constitution, architectural rules, and writing persona.
- **`.agents/brain/`:** Spatial and chronological memory repository (`task.md`, `walkthrough.md`, `palace_registry.md`).
- **`.agents/skills/`:** Reusable, executable SOP directories providing specialized tools to automation scripts.

### 3. Documentation (The Sovereign Markdown Palace)
- **`docs/`:** Master directory containing guides, tutorials, and security checklists.
- **`docs/governance/`:** Rigid theoretical frameworks establishing absolute operational sovereignty.

---
*Deep State of Mind (DSOM) For My AI Protocol | Harisfazillah Jamel (LinuxMalaysia) | 2026-07-27*
*Standard: UK English | DBP-standard Bahasa Melayu Malaysia (Piawai) | GNU General Public License v3.0*
