# 🎨 Template Guide

Master the **"Pair Logic"** architecture in CmsForNerd v3.1. This system separates your page logic from your HTML content.

---

## 📂 Architecture Overview

CmsForNerd uses a "Pair Logic" system. To create a page, you need two matching files in two specific locations:

| File Type | Location | Example Name |
| :--- | :--- | :--- |
| **Entry Point** | Root Directory `/` | `about.php` |
| **Content Body** | `/contents/` | `about-body.inc` |
## 🚀 How to Create a New Page

### Step 1: Create the Content Body
Create a new file inside the `contents/` folder. Paste **only** the HTML that belongs inside the content area. Do not include `<html>`, `<head>`, or `<body>` tags.

* **File Path:** `contents/my-new-page-body.inc`

### Step 2: Create the Entry Point
Copy `template.php` in the root directory and rename it to match your content file prefix.

* **File Path:** `my-new-page.php`
### Step 3: Customize Metadata
Open your new `.php` file and update the `$content` array. The system will handle the rest automatically.

```php
$content = [
    'title'       => "My New Page - CmsForNerd",
    'description' => "Detailed description for search engines.",
    'author'      => "Your Name",
];



###🛠️ Under the Hood (Technical Logic)

The template uses the Bootstrap Phase to initialize the environment. When you access my-new-page.php, the code performs the following:

    * Bootstrap: Loads includes/bootstrap.php.
    * Routing: Detects the filename using pathinfo().
    * Context: Creates a CmsContext object.
    * Pairing: The pagecontent() function searches for the -body.inc file.

### Part 4: Standards and Requirements
```markdown
## ⚖️ Standards (RFC 2119)

* **MUST:** Every entry point `.php` file MUST call `require_once __DIR__ . '/includes/bootstrap.php';`.
* **MUST:** Content files MUST end with the `-body.inc` suffix.
* **SHOULD:** Use **Google Antigravity** to format your HTML inside the `.inc` files.
* **MUST NOT:** Include global scripts or CSS inside the content body.