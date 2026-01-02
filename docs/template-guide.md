🎨 CmsForNerd v3.4 Laboratory GuideMastering the "Pair Logic" & Context EngineThe template.php file acts as the Master Controller. In v3.4, you don't need to write new PHP logic for every page. You simply duplicate the template and pair it with a content fragment.📂 Step 1: Locate the FoldersFocus on these key areas in the Laboratory environment:Root Directory: Public .php entry points (e.g., index.php, about.php).contents/ Directory: Raw "body" fragments (-body.inc files).src/ & includes/: The core engine, security utilities, and bootstrap logic.📝 Step 2: Create Your Content (.inc file)Code only the internal HTML structure for your page body inside the contents/ folder.🔍 Content Checklist:[ ] Naming: Must end in -body.inc (e.g., services-body.inc).[ ] No Wrappers: Do not include <html>, <head>, or <body> tags.[ ] Scope: Use semantic tags like <section>, <article>, or <div>.[ ] Security: If using inline scripts, ensure they are compatible with the site's Content Security Policy (CSP).🚀 Step 3: Create Your Page (.php file)In CMSForNerd, you never write new engine code. You simply copy, rename, and adjust metadata.Copy: Duplicate template.php in the root folder.Rename: Change the copy to match your content (e.g., services.php).Adjust: Update the $content array metadata.🔍 PHP Template logic Breakdown:/**
 * 1. [PERFORMANCE] Enable GZIP
 * Check: Is output buffering starting correctly? 
 * This reduces bandwidth for mobile lab students.
 */
if (!ob_start("ob_gzhandler")) { ob_start(); }

/**
 * 2. [LAB] BOOTSTRAP PHASE
 * Check: Ensure the path to bootstrap.php is correct.
 */
require_once __DIR__ . '/includes/bootstrap.php';

/**
 * 3. [SEO/AI] Metadata
 * Check: Update 'title', 'description', and 'schemaType'.
 * AI Crawlers use 'schemaType' to categorize your laboratory data.
 */
$content = [
    'title'       => "Service Lab | CmsForNerd v3.4",
    'author'      => "Harisfaz Jamal",
    'description' => "Lab description here.",
    'keywords'    => "PHP 8.4, Lab, CMS",
    'schemaType'  => "WebPage" 
];

/**
 * 4. [LAB] ROUTING & SANITIZATION
 * Check: The 'match' expression automatically detects the filename.
 * SecurityUtils::isValidPageName() prevents Path Traversal attacks.
 */
$rawPage = match (true) {
    !empty($_SERVER['QUERY_STRING']) => (string) $_SERVER['QUERY_STRING'],
    default                          => pathinfo(basename(__FILE__), PATHINFO_FILENAME)
};

$isValid = \CmsForNerd\SecurityUtils::isValidPageName($rawPage);
$page = $isValid ? $rawPage : 'index';
$pageName = pathinfo($page, PATHINFO_FILENAME);

// Check: This 'data' key must match your .inc filename (without the -body.inc part)
$content['data'] = $pageName;

/**
 * 5. [MODERN PHP] CmsContext Initialization
 * Check: We use named arguments for clarity. 
 * This object is the "Single Source of Truth" for the theme.
 */
$ctx = createCmsContext(content: $content, pageName: $pageName);

/**
 * 7. [RENDER] Theme Dispatcher
 * Check: Does themes/[your-theme]/pager.php exist?
 */
$pagerPath = __DIR__ . "/themes/{$ctx->themeName}/pager.php";
if (file_exists($pagerPath)) {
    require_once $pagerPath;
    pager($ctx);
}
🛡️ Step 4: Verify Safety & ComplianceBefore moving to production, perform these three laboratory checks:Static Analysis: Run composer analyze. Your new page must show 0 errors at PHPStan Level 8.CSP Nonce Verification: If you add inline <script>, you must use $ctx->cspNonce to pass the security policy.Sanitization: Ensure your page name is valid and safe using SecurityUtils::isValidPageName().⚖️ Laboratory Standards (v3.4 Update)MUST: Keep declare(strict_types=1); at the top of all .php files.MUST NOT: Modify the Routing Logic or Theme Execution blocks in copied files.REQUIRED: Use the $ctx object to access any page data within your theme.