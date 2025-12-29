# 🗺️ Sitemap Guide

The Sitemap in **CmsForNerd v3.1** serves as the navigational backbone for both human visitors and search engine crawlers. It automatically reflects the state of your flat-file laboratory.

---

## 📂 The Sitemap Logic

The sitemap uses the same **Pair Logic** as the rest of the CMS:
* **Entry Point:** `sitemap-page.php` (Root)
* **Content Body:** `contents/sitemap-page-body.inc` (Data source)

### Automated Discovery
The system scans the `contents/` folder for files ending in `-body.inc`. It then strips the suffix and generates a clean link (e.g., `about-body.inc` becomes `about.php`).

## ⚖️ Standards (RFC 2119)

* **MUST:** The sitemap MUST include all core laboratory modules (`lab-module1.php`, etc.).
* **SHOULD:** Include the `lastmod` (last modified) date to help search engines prioritize crawling.
* **MUST NOT:** List private include files or vendor directories.

## 🚀 SEO Best Practices
CmsForNerd v3.1 generates two types of sitemaps:
1. **HTML Sitemap:** For user navigation (this page).
2. **XML Sitemap:** Located at `sitemap.xml` for Google Search Console and Bing Webmaster Tools.