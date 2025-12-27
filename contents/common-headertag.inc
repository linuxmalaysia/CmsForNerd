<!-- Modern SEO & Security Headers -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?= htmlspecialchars($CONTENT['description'] ?? 'CMSForNerd - A lightweight, flat-file CMS') ?>">
<meta name="keywords" content="<?= htmlspecialchars($CONTENT['keywords'] ?? 'CMS, PHP, Flat-file') ?>">
<meta name="author" content="<?= htmlspecialchars($CONTENT['author'] ?? 'CMSForNerd') ?>">
<meta name="robots" content="index, follow">

<!-- Favicon (Relative Path) -->
<link rel="icon" type="image/x-icon" href="favicon.ico">

<!-- Modern Typography (Open Source) -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

<!-- Security: Content Security Policy (Basic) -->
<meta http-equiv="Content-Security-Policy" content="default-src 'self' 'unsafe-inline' 'unsafe-eval' https://challenges.cloudflare.com https://*.ipinfo.io https://www.google.com https://fonts.googleapis.com; img-src 'self' data: https: https://www.google.com https://groups.google.com https://www.rorweb.com; font-src 'self' https: data: https://fonts.gstatic.com;">

<!-- RSS Feed (If applicable) -->
<!-- <link rel="alternate" type="application/rss+xml" title="RSS Feed" href="xml-sitemap.php"> -->