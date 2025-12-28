# 🎨 CmsForNerd Template Guide
**Mastering the "Pair Logic" Architecture**

The `template.php` file acts as the master frame for your website. It contains the standard HTML structure (the `<head>`, `<nav>`, and global scripts) and uses PHP to "pull in" the content for specific pages.

---

## 📂 Step 1: Locate the Folders
In your project structure, focus on these two areas:

* **Root Directory:** Where `template.php` and your public pages live.
* **contents/ Directory:** Where the raw "body" content for each page is stored in `.inc` files.



---

## 📝 Step 2: Create Your Content (.inc file)
Instead of writing a full HTML page, you only need to code what goes inside the `<body>` tag.

1.  Open **Google Antigravity** (VS Code).
2.  Create a new file inside the `contents/` folder.
3.  **Naming Rule:** If your page will be `search.php`, your content file **MUST** be named `search-body.inc`.
4.  Paste only the HTML you want to appear in the middle of the page.

### Example: `contents/search-body.inc`
```html
<section class="search-results">
    <h1>Search the Lab</h1>
    <form action="search.php" method="GET">
        <input type="text" name="q" placeholder="Search for modules...">
        <button type="submit">Go</button>
    </form>
</section>