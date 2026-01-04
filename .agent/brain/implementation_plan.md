# Implementation Plan - Master Protocol Propagation

The goal is to integrate references to the newly formalized `docs/AI-MASTER-PROTOCOL.md` into key documentation files to ensure all AI agents and developers are aware of the "Intelligence Handshake".

## User Review Required
> [!NOTE]
> `docs/bot-intelligence.md` is primarily technical documentation for the `is_bot.php` module. The reference to the Master Protocol will be added as a "Developer Note" to ensure agents working on this module adhere to the protocol.

## Proposed Changes

### Documentation Updates

#### [MODIFY] [ai-dev.md](file:///d:/Users/LinuxMalaysia/CMSForNerd-Project/CmsForNerd/docs/ai-dev.md)
- **Action**: Add new section `## 📜 Layer 3: The Master Protocol` between "Antigravity" and "Triple Threat".
- **Content**: Explain that all agents must follow the Master Protocol and link to it.

#### [MODIFY] [ai-sop.md](file:///d:/Users/LinuxMalaysia/CMSForNerd-Project/CmsForNerd/docs/ai-sop.md)
- **Action**: Add item to "Rules of Engagement".
- **Content**: "Must adhere to [AI-MASTER-PROTOCOL.md](AI-MASTER-PROTOCOL.md) for session start/end."

#### [MODIFY] [AI-STATE-SYNC.md](file:///d:/Users/LinuxMalaysia/CMSForNerd-Project/CmsForNerd/docs/AI-STATE-SYNC.md)
- **Action**: Update "Current Mission" or add to "Architectural Decisions".
- **Content**: Explicitly list the Master Protocol as the governance document.

#### [MODIFY] [bot-intelligence.md](file:///d:/Users/LinuxMalaysia/CMSForNerd-Project/CmsForNerd/docs/bot-intelligence.md)
- **Action**: Add "Note to AI Agents" at the bottom.
- **Content**: Remind agents that changes here require strict adherence to the Master Protocol due to security implications.

#### [MODIFY] [AI-MASTER-PROTOCOL.md](file:///d:/Users/LinuxMalaysia/CMSForNerd-Project/CmsForNerd/docs/AI-MASTER-PROTOCOL.md)
- **Action**: Add "Connected Intelligence" or "Ecosystem" section.
- **Content**: Link back to `ai-dev.md` (Roles), `ai-sop.md` (Ethics), `AI-STATE-SYNC.md` (State), and `bot-intelligence.md` (Security) to form a complete knowledge graph.

## Verification Plan

### Automated Tests
- `composer lab-check` (Standard environment check).
- `git diff` to verify the insertion points.

### Manual Verification
- Review the rendered Markdown (via `view_file` or diffs) to ensure links are correct and context is appropriate.
