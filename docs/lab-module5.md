# 📊 Lab Module 5: Coverage & QA (v3.3)

> **Topic:** Test Coverage and Quality Assurance

## 🎯 Learning Objectives
1. Understand the difference between **Execution** and **Coverage**.
2. Generate an interactive **HTML Coverage Report**.
3. Use the **CRAP Index** to identify risky code.

---

## ⚙️ Step 1: The Coverage Engine
PHP needs a driver to track which lines are executed. We use **Xdebug**.

**Task:** Verify your environment:
`php -m | findstr "xdebug"`

## 🧪 Step 2: Generating the Visual Map
We convert raw data into a readable website.

**Task:** Run the coverage command:
`XDEBUG_MODE=coverage ./vendor/bin/phpunit --coverage-html build/coverage`

1. Open `build/coverage/index.html` in your browser.
2. Navigate to `SecurityUtils.php`.
## 🔍 Step 3: Analyzing "Unreachable" Code
* **Green Lines:** Successfully tested.
* **Red Lines:** "Dark spots"—logic that hasn't been verified.

**Exercise:** If `sanitizePageName` shows red on the hyphen regex, add a test case for `about-us` in `SecurityUtilsTest.php`.

## ✅ Step 4: The Quality Audit (CRAP Index)
The **Change Risk Anti-Patterns (CRAP)** index measures how hard code is to maintain.
* **High CRAP:** High complexity + Low coverage = Dangerous.
* **Low CRAP:** Clean code + High coverage = Professional.

**Requirement:** Your `SecurityUtils` class MUST have a CRAP score of less than 5.

---

## ⚖️ RFC 2119 Standards for Module 5
* **MUST:** Generate a coverage report before every production release.
* **SHOULD:** Aim for 90% coverage on core security logic.
* **MAY:** Exclude view files/themes from the report.
