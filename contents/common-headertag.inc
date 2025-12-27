<!-- [SEO] Character encoding. 'utf-8' is the modern standard for supporting all languages. -->
<meta charset="utf-8">

<!-- [MOBILE] Viewport - Makes your site "Responsive" so it looks good on phones and tablets. -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- [SEO] Descriptions used by Google. htmlspecialchars() prevents XSS attacks if text contains code. -->
<meta name="description" content="<?= htmlspecialchars($CONTENT['description'] ?? 'CMSForNerd - A lightweight, flat-file CMS') ?>">

<!-- [SEO] Keywords for older search engines (though less important now, still good practice). -->
<meta name="keywords" content="<?= htmlspecialchars($CONTENT['keywords'] ?? 'CMS, PHP, Flat-file') ?>">

<!-- [SEO] Author and Robot instructions. 'index, follow' tells Google to list this page and follow its links. -->
<meta name="author" content="<?= htmlspecialchars($CONTENT['author'] ?? 'CMSForNerd') ?>">
<meta name="robots" content="index, follow">

<!-- Favicon - The small icon you see in the browser tab. -->
<link rel="icon" type="image/x-icon" href="favicon.ico">

<!-- [UX/SEO] Modern Typography from Google Fonts. 'preconnect' speeds up loading. -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

<!-- [SECURITY] Content Security Policy (CSP). 
     This is your "Force Field". It tells the browser EXACTLY which domains (like Cloudflare or Google Fonts)
     are allowed to load scripts or images. If a hacker tries to inject their own script, the CSP will block it. -->
<meta http-equiv="Content-Security-Policy" content="default-src 'self' 'unsafe-inline' 'unsafe-eval' https://challenges.cloudflare.com https://*.ipinfo.io https://www.google.com https://fonts.googleapis.com; img-src 'self' data: https: https://www.google.com https://groups.google.com https://www.rorweb.com; font-src 'self' https: data: https://fonts.gstatic.com;">

<!-- RSS Feed (If applicable) -->
<!-- <link rel="alternate" type="application/rss+xml" title="RSS Feed" href="xml-sitemap.php"> -->
<meta charset="utf-8" />
<link href="http://cmsfornerd.harisfazillah.info/favicon.ico" type="image/x-icon" rel="shortcut icon" />
<link href="http://cmsfornerd.harisfazillah.info/favicon.ico" type="image/x-icon" rel="icon" />
<link rel="shortcut icon" href="http://cmsfornerd.harisfazillah.info/favicon.ico" />
<link rel="alternate" type="application/rss+xml" title="CmsForNerd SiteMap Feed" href="http://cmsfornerd.harisfazillah.info/rss.xml" />
<link rel="alternate" type="application/rss+xml" title="CmsForNerd ROR Sitemap" href="http://cmsfornerd.harisfazillah.info/ror.xml" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="EN" />
