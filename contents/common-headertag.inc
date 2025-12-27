<!-- Modern SEO & Security Headers -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?= htmlspecialchars($CONTENT['description'] ?? 'CMSForNerd - A lightweight, flat-file CMS') ?>">
<meta name="keywords" content="<?= htmlspecialchars($CONTENT['keywords'] ?? 'CMS, PHP, Flat-file') ?>">
<meta name="author" content="<?= htmlspecialchars($CONTENT['author'] ?? 'CMSForNerd') ?>">
<meta name="robots" content="index, follow">

<!-- Favicon (Relative Path) -->
<link rel="icon" type="image/x-icon" href="favicon.ico">

<!-- Security: Content Security Policy (Basic) -->
<meta http-equiv="Content-Security-Policy" content="default-src 'self' 'unsafe-inline' 'unsafe-eval' https://challenges.cloudflare.com https://*.ipinfo.io; img-src 'self' data: https:; font-src 'self' https: data:;">

<!-- RSS Feed (If applicable) -->
<!-- <link rel="alternate" type="application/rss+xml" title="RSS Feed" href="xml-sitemap.php"> -->