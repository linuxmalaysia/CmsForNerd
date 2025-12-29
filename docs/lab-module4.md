# 🧪 Lab Module 4: Automated Testing (v3.3)

> **Topic:** Automated Testing with PHPUnit 11

## 🎯 Learning Objectives
1. Understand the **Arrange-Act-Assert (AAA)** pattern.
2. Write a unit test for the `SecurityUtils` class.
3. Master the terminal-based test runner.

---

## 📂 Step 1: The Test Anatomy
In PHPUnit, every test file **MUST** end with the suffix `Test.php` and its class **MUST** extend `TestCase`.

### The AAA Pattern:
* **Arrange:** Set up the objects and data needed for the test.
* **Act:** Execute the specific function you want to test.
* **Assert:** Check if the result matches your expectations.

## 🛠️ Step 2: Writing Your First Test
Write a test for `SecurityUtils::escapeHtml` to ensure it correctly prevents XSS.

**Task:** Create `tests/SecurityUtilsTest.php`:
```php
public function testEscapesHtmlSpecialCharacters(): void
{
    // 1. Arrange
    $input = '<script>alert("hack");</script>';
    $expected = '&lt;script&gt;alert(&quot;hack&quot;);&lt;/script&gt;';

    // 2. Act
    $result = SecurityUtils::escapeHtml($input);

    // 3. Assert
    $this->assertSame($expected, $result);
}
```

## 🚀 Step 3: Running the Lab

Open your terminal and execute: ./vendor/bin/phpunit tests/SecurityUtilsTest.php

    . (Dot): Passed!

    F (Failure): Something went wrong.

## ⚖️ RFC 2119 Standards for Module 4

    MUST: Every test method name MUST start with the word test.

    MUST: Test classes MUST be marked as final.

    SHOULD: Use assertSame() instead of assertEquals() for strict type checking.

