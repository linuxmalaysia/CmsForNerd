# 🎨 CmsForNerd v3.3 Template Guide

### Mastering the "Pair Logic" & Context Engine

The `template.php` file acts as the **Front Controller** for your individual pages. In v3.3, it initializes the `CmsContext` object, which securely carries your metadata and configuration from the `src/` engine into the theme's `pager.php`.



---

## 📂 Step 1: Locate the Folders

In the v3.3 Laboratory environment, focus on these key areas:

* **Root Directory:** Where your public `.php` pages (like `search.php`) live.
* **contents/ Directory:** Where the raw "body" HTML for each page is stored.
* **src/ & includes/:** The hybrid engine folders that handle autoloader and security logic.

---

## 📝 Step 2: Create Your Content (.inc file)

Instead of writing a full HTML page, you only need to code what goes inside the `<body>` tag.

1.  Open **Google Antigravity**.
2.  Create a new file inside the `contents/` folder.
3.  **Naming Rule:** If your page is `search.php`, your content file **MUST** be named `search-body.inc`.
4.  Paste only the HTML you want to appear in the middle of the page.

{% hint style="info" %}
**Example: contents/search-body.inc**
```html
<section class="search-results">
    <h1>Search the Lab</h1>
    <form action="search.php" method="GET">
        <input type="text" name="q" placeholder="Search for modules...">
        <button type="submit">Go</button>
    </form>
</section>
