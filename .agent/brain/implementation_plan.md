# Implementation Plan: Dual Testing Guide (PHPUnit + Pest)

## Objective
To provide clear, student-friendly documentation explaining how to utilize the newly implemented Dual Testing architecture (PHPUnit and Pest) within the CMSForNerd v3.5 laboratory environment.

## Proposed Changes

### 1. Create the Testing Guide
#### [NEW] [docs/testing-guide.md](file:///d:/Users/LinuxMalaysia/CMSForNerd-Project/CmsForNerd/docs/testing-guide.md)
- **Action**: Create a comprehensive guide for students.
- **Sections**:
    1. **Introduction to Dual Testing**: Why we have both (Legacy security validation vs. Modern feature testing).
    2. **How to Run Legacy Tests (PHPUnit)**: Examples using `composer test:phpunit`.
    3. **How to Run Modern Tests (Pest)**: Examples using `composer test:pest` and writing `it()` syntax.
    4. **The `composer compliance` Pipeline**: Explaining how testing fits into the "Zero-Error" gateway.
    5. **Architecture Rule (Zero Cross-Contamination)**: Why we keep `CmsForNerd\Tests` completely separated from `Tests\Unit`.

### 2. Update the GitBook Summary
#### [MODIFY] [docs/SUMMARY.md](file:///d:/Users/LinuxMalaysia/CMSForNerd-Project/CmsForNerd/docs/SUMMARY.md)
- **Action**: Add a link to the new guide.
- **Location**: Insert `* [Testing Guide (Pest + PHPUnit)](testing-guide.md)` under the `## 📘 The Manuals` section, right after the "Sitemap & SEO Guide".

### 3. Track Progress
#### [MODIFY] [.agent/brain/task.md](file:///d:/Users/LinuxMalaysia/CMSForNerd-Project/CmsForNerd/.agent/brain/task.md)
- **Action**: Add a new sub-task tracking the creation and propagation of `testing-guide.md`.

## Verification Plan
1. Check that `docs/testing-guide.md` perfectly encapsulates the `test:pest` and `test:phpunit` behaviors.
2. Verify `docs/SUMMARY.md` correctly renders the Markdown link.
3. Commit and push the new documentation.
