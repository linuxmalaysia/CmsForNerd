<?php

declare(strict_types=1);

namespace CmsForNerd\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Validates the root .htaccess file introduced in the "Apache .htaccess &
 * Docker Alignment" change set (Module 20, v4.1.9).
 *
 * Apache does not permit <Directory> or <DirectoryMatch> directives inside
 * .htaccess files (they are only valid inside the main server/virtual-host
 * configuration); using them causes 500 Internal Server Errors. This suite
 * guards against a regression back to those directives and verifies that the
 * replacement mod_rewrite RewriteRule directives implement equivalent
 * protection by exercising the extracted patterns through PHP's PCRE engine.
 */
final class HtaccessTest extends TestCase
{
    private string $htaccessPath;
    private string $content;

    protected function setUp(): void
    {
        $this->htaccessPath = dirname(__DIR__) . '/.htaccess';
        $this->content = (string) file_get_contents($this->htaccessPath);
    }

    /**
     * Extracts the pattern and flags of the first RewriteRule that appears
     * after the given anchor comment, so the rule's actual matching
     * behaviour can be exercised directly with preg_match().
     *
     * @return array{0: string, 1: string} [pattern, flags]
     */
    private function extractRewriteRuleAfter(string $anchorComment): array
    {
        $anchorPos = strpos($this->content, $anchorComment);
        $this->assertNotFalse($anchorPos, "Expected to find the comment '{$anchorComment}' in .htaccess.");

        $matched = preg_match(
            '/RewriteRule\s+"([^"]+)"\s+-\s+\[([^\]]+)\]/',
            substr($this->content, $anchorPos),
            $matches
        );
        $this->assertSame(1, $matched, "Expected a RewriteRule directly after the comment '{$anchorComment}'.");

        return [$matches[1], $matches[2]];
    }

    public function testHtaccessExists(): void
    {
        $this->assertFileExists($this->htaccessPath);
    }

    public function testHtaccessDoesNotUseDirectoryMatchDirective(): void
    {
        $this->assertDoesNotMatchRegularExpression(
            '/<DirectoryMatch\b/i',
            $this->content,
            'Regression guard: <DirectoryMatch> is not permitted inside .htaccess and causes 500 Internal Server Errors.'
        );
    }

    public function testHtaccessDoesNotUseDirectoryDirective(): void
    {
        $this->assertDoesNotMatchRegularExpression(
            '/<Directory(?!Match)\b/i',
            $this->content,
            'Regression guard: <Directory> is not permitted inside .htaccess and causes 500 Internal Server Errors.'
        );
    }

    public function testHtaccessNoLongerDisablesPhpEngineViaDirectoryBlock(): void
    {
        $this->assertStringNotContainsString(
            'php_flag engine off',
            $this->content,
            'The php_flag directive was only valid inside the removed <Directory> block; the RewriteRule replacement forbids execution instead.'
        );
    }

    public function testHtaccessWrapsSensitiveDirectoryProtectionInRewriteModule(): void
    {
        $this->assertMatchesRegularExpression(
            '/<IfModule mod_rewrite\.c>\s*\n\s*RewriteEngine On/',
            $this->content,
            'The mod_rewrite replacement for sensitive-directory protection must enable the rewrite engine before any RewriteRule.'
        );
    }

    public function testHtaccessDeclaresExactlyTwoRewriteModuleBlocks(): void
    {
        $count = preg_match_all('/<IfModule mod_rewrite\.c>/', $this->content);

        $this->assertSame(
            2,
            $count,
            'Expected one <IfModule mod_rewrite.c> block for sensitive-directory protection and one for upload PHP-execution prevention.'
        );
    }

    public function testHtaccessBlocksUploadPhpExecutionViaRewriteRule(): void
    {
        $this->assertStringContainsString(
            'RewriteRule "^uploads/.*\.php(/|$)" - [F,NC]',
            $this->content,
            'Upload directories must forbid PHP execution via a RewriteRule instead of the removed <Directory "*/uploads/*"> block.'
        );
    }

    public function testHiddenFileRewriteRuleBlocksDotfilesButAllowsWellKnown(): void
    {
        [$pattern, $flags] = $this->extractRewriteRuleAfter('Block access to hidden files');
        $pcre = '#' . $pattern . '#' . (str_contains($flags, 'NC') ? 'i' : '');

        $this->assertSame(1, preg_match($pcre, '.env'), 'A hidden dotfile at the webroot must be blocked.');
        $this->assertSame(1, preg_match($pcre, '.git/config'), 'A hidden directory at the webroot must be blocked.');
        $this->assertSame(1, preg_match($pcre, 'includes/.hidden'), 'A hidden file nested in a subdirectory must be blocked.');
        $this->assertSame(
            0,
            preg_match($pcre, '.well-known/security.txt'),
            '.well-known/security.txt must remain reachable to satisfy the RFC 9116 requirement.'
        );
        $this->assertSame(0, preg_match($pcre, 'index.php'), 'Ordinary non-hidden files must not be blocked.');
    }

    public function testSensitiveDirectoryRewriteRuleBlocksKnownDirectoriesOnly(): void
    {
        [$pattern] = $this->extractRewriteRuleAfter('Block access to sensitive directories');
        $pcre = '#' . $pattern . '#';

        $this->assertSame(1, preg_match($pcre, 'includes/config.php'), 'includes/ must be blocked.');
        $this->assertSame(1, preg_match($pcre, 'tests'), 'tests/ must be blocked even without a trailing slash.');
        $this->assertSame(1, preg_match($pcre, 'vendor/autoload.php'), 'vendor/ must be blocked.');
        $this->assertSame(1, preg_match($pcre, '.vscode/settings.json'), '.vscode/ must be blocked.');
        $this->assertSame(
            0,
            preg_match($pcre, 'src/includes/foo.php'),
            'The rule is anchored to the webroot and must not match "includes" appearing deeper in the path.'
        );
        $this->assertSame(
            0,
            preg_match($pcre, 'includesfoo.php'),
            'The rule must require a path separator or end-of-string boundary after the directory name.'
        );
    }

    public function testUploadPhpExecutionRewriteRuleIsCaseInsensitiveAndScopedToUploads(): void
    {
        [$pattern, $flags] = $this->extractRewriteRuleAfter('If you later add file upload capability');
        $this->assertStringContainsString('NC', $flags, 'The upload PHP-blocking rule must carry the NC (no-case) flag.');
        $this->assertStringContainsString('F', $flags, 'The upload PHP-blocking rule must forbid the request.');

        $pcre = '#' . $pattern . '#i';

        $this->assertSame(1, preg_match($pcre, 'uploads/shell.php'), 'PHP files directly under uploads/ must be blocked.');
        $this->assertSame(1, preg_match($pcre, 'uploads/nested/dir/shell.PHP'), 'Matching must be case-insensitive per the NC flag.');
        $this->assertSame(0, preg_match($pcre, 'uploads/image.png'), 'Non-PHP uploads must not be blocked.');
        $this->assertSame(0, preg_match($pcre, 'notuploads/shell.php'), 'The rule must be anchored to the uploads/ prefix.');
    }

    public function testHtaccessStillAllowsWellKnownSecurityTxtException(): void
    {
        $this->assertMatchesRegularExpression(
            '/<Files "security\.txt">\s*\n\s*Require all granted\s*\n<\/Files>/',
            $this->content,
            'The RFC 9116 security.txt exception must remain intact alongside the new mod_rewrite rules.'
        );
    }

    public function testHtaccessRetainsDirectoryBrowsingProtection(): void
    {
        $this->assertMatchesRegularExpression(
            '/^Options -Indexes$/m',
            $this->content,
            'Directory browsing protection is unrelated to this change and must remain untouched.'
        );
    }

    public function testHtaccessRetainsSecurityHeaders(): void
    {
        $this->assertStringContainsString('X-Frame-Options "SAMEORIGIN"', $this->content);
        $this->assertStringContainsString('X-Content-Type-Options "nosniff"', $this->content);
    }
}