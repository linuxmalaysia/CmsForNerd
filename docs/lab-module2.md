# 🎨 Lab Module 2: PSR-12 Standards (v3.3)

> **Topic:** PSR-12 and the Art of Clean Code

## 🎯 Learning Objectives
1. Identify common PSR-12 violations (Indentation, Braces, Spacing).
2. Automate code formatting using **PHPCBF**.
3. Integrate style checks into your developer workflow.

---

## 🛠️ Step 1: The "Manual Eye" Test
Before using tools, recognize messy code. In PHP 8.4+, PSR-12 governs everything from basic classes to new features like Enums.

**Common Violations to spot:**
* **Braces:** Opening braces `{` for classes/methods **MUST** be on a new line.
* **Indentation:** Use **4 Spaces**. Never use Tabs.
* **Visibility:** Properties **MUST** have a visibility keyword (`public`, `private`, `protected`).

## 🧪 Step 2: The Automated Audit (Linter)
We use **PHP_CodeSniffer (phpcs)** to enforce rules without the human argument.

**Task:** Run a style audit in your Antigravity terminal:
`composer check-style`
*(This maps to: `./vendor/bin/phpcs --standard=PSR12 includes/`)*

## 🪄 Step 3: The "Magic" Fixer (PHPCBF)
Don't fix spaces manually. Let the computer do it.

**Task:** Run the fixer:
`composer fix-style`
*(This maps to: `./vendor/bin/phpcbf --standard=PSR12 includes/`)*

---

## ⚖️ RFC 2119 Standards for Module 2
* **MUST:** Use 4 spaces for indentation.
* **MUST:** Place the opening brace for classes/methods on a new line.
* **SHOULD:** Keep lines under 120 characters.
* **MUST NOT:** Use "Short Tags" like `<?`. Always use `<?php`.

**Question:** Why does PSR-12 require omitting the closing `?>` tag in pure PHP files?
*(Hint: Think about hidden whitespace causing "Headers already sent" errors).*
