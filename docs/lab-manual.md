# 🎓 Lab Manual: The Developer’s Laboratory (v3.3)

Welcome to the **v3.3 educational suite**. This CMS is designed to be a **transparent laboratory**. Every line of code is accessible, every architectural choice is documented, and every security feature is a lesson in professional standards.

---

## 📚 Module 1: Modern PHP 8.4+ Architecture
Explore the transition from procedural scripts to modern object-oriented patterns.

### Exercise 1.1: Strict Typing
Observe how `declare(strict_types=1);` prevents incorrect data types, forcing predictable code.

### Exercise 1.2: The Context Pattern
See how the `CmsContext` object replaces "Global Variables," teaching the **Single Source of Truth** principle.
## ⚖️ Module 2: Standards & Compliance
Professional code is defined by its adherence to global standards.

* **RFC 2119 Compliance:** We use *MUST*, *SHOULD*, and *MAY* to define project boundaries.
* **PSR-12 Linting:** Use `composer check-style` to identify inconsistencies.
* **Semantic Web:** Understand how **JSON-LD** helps AI tools categorize content.

## 🛡️ Module 3: Defensive Engineering
Master input hardening and perimeter defense.

* **CSP Nonces:** Learn to configure Content Security Policies with **cryptographic nonces** instead of `unsafe-inline`.
* **RFC 9116:** Establishing protocols for ethical vulnerability reporting via `security.txt`.
## 🧪 Module 4 & 5: TDD and Coverage
Master Test-Driven Development using **PHPUnit 11**.

* **Green-Light Thinking:** If the tests aren't green, the code isn't ready.
* **Coverage Reports:** Use Xdebug to identify "dark spots" in your code logic.

## 🤖 Module 6: AI-Assisted Workflow
Learn to lead an "AI Agent" as your junior developer.

* **Prompt-to-Product:** Describe a change → Review implementation plan → Run `composer compliance`.
* **AI Ethics:** Follow the "Think First" rule and "Trust but Verify" law.

---

## 🚩 Final Exam: Break-Fix Challenge
The ultimate test. Repair 5 deliberate security and logic errors to pass the certification audit.

[🏁 Start Graduation Process](graduation.md)
