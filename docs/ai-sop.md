# 📜 SOP: Responsible AI Usage in the Lab (v3.5)

Standard Operating Procedure for the CMSForNerd v3.5 Laboratory.

## 🎯 Objective
To leverage AI agents (Gemini, Antigravity) to accelerate learning while maintaining individual coding integrity and **RFC 2119** compliance within the PHP 8.4 environment.

## 🏛️ The Rules of Engagement

### 1. The "Think First" Rule
* **MUST:** Students **MUST** attempt to solve structural problems using the `SecurityUtils` or `CmsContext` source code for 10 minutes before prompting an AI.

### 2. Verification & Auditing (Trust but Verify)
AI-generated code **MUST NOT** be merged until it passes the compliance suite:
1. **Style:** `composer fix-style` (PSR-12 Check).
2. **Logic:** `composer test` (Unit/Security Logic Check).
3. **Audit:** `composer compliance` (Final "Green Bar" Status).

### 3. Prohibited Actions
* **DO NOT** copy-paste code you cannot explain line-by-line during lab reviews.
* **DO NOT** use AI to bypass the logic-heavy "Break-Fix" challenges in the Final Exam.

## 🎓 Learning Outcome
Mastering this SOP prepares you for a professional environment where AI collaboration is the standard, ensuring you remain the **Architect** of the system, not just a prompter.
