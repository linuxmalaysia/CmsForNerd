<?php

declare(strict_types=1);

namespace CmsForNerd\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Validates the root `.htaccess` file introduced in the "Apache .htaccess &
 * Docker Alignment" (v4.1.9) change set.
 *
 * Apache does not permit `<Directory>` or `<DirectoryMatch>` directives
 * inside directory-level context files (`.htaccess`); using them causes an
 * immediate 500 Internal Server Error. This suite guards against that
 * regression and verifies the replacement `mod_rewrite` rules preserve the
 * original security intent (hidden-file protection, sensitive directory
 * blocking, and PHP execution prevention inside uploads/).
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
     * Extracts the quoted pattern from the first RewriteRule line that
     * contains the given needle, e.g. extracting `(^|/)\.(?!well-known/)`
     * from `RewriteRule "(^|/)\.(?!well-known/)" - [F]`.
     */
    private function extractRewriteRulePattern(string $lineContains): string
    {
        foreach (explode("\n", $this->content) as $line) {
            if (str_contains($line, 'RewriteRule') && str_contains($line, $lineContains)) {
                $start = strpos($line, '"');
                $end = strrpos($line, '"');

                if ($start === false || $end === false || $end <= $start) {
                    continue;
                }

                return substr($line, $start + 1, $end - $start - 1);
            }
        }

        $this->fail("Could not locate a RewriteRule line containing '{$lineContains}'.");
    }

    public function testHtaccessFileExists(): void
    {
        $this->assertFileExists($this->htaccessPath);
    }

    public function testHtaccessDoesNotUseDirectoryMatchTag(): void
    {
        $this->assertStringNotContainsString(
            '<DirectoryMatch',
            $this->content,
            '<DirectoryMatch> is not permitted in .htaccess files and causes 500 Internal Server Errors.'
        );
        $this->assertStringNotContainsString('</DirectoryMatch>', $this->content);
    }

    public function testHtaccessDoesNotUseDirectoryTag(): void
    {
        $this->assertDoesNotMatchRegularExpression(
            '/<Directory[\s">]/',
            $this->content,
            '<Directory> is not permitted in .htaccess files and causes 500 Internal Server Errors.'
        );
        $this->assertStringNotContainsString('</Directory>', $this->content);
    }

    public function testHtaccessNoLongerContainsLegacyBrokenDirectives(): void
    {
        // Regression guard: the exact directives that used to trigger 500s.
        $this->assertStringNotContainsString('<DirectoryMatch "^\.|\/\.">', $this->content);
        $this->assertStringNotContainsString(
            '<DirectoryMatch "^/(includes|tests|vendor|\.vscode|\.well-known)">',
            $this->content
        );
        $this->assertStringNotContainsString('<Directory "*/uploads/*">', $this->content);
    }

    public function testHtaccessWrapsRewriteRulesInModRewriteIfModule(): void
    {
        $this->assertStringContainsString('<IfModule mod_rewrite.c>', $this->content);
        $this->assertStringContainsString('RewriteEngine On', $this->content);

        $openCount = substr_count($this->content, '<IfModule mod_rewrite.c>');

        $this->assertGreaterThanOrEqual(
            2,
            $openCount,
            'Expected at least two mod_rewrite.c blocks (directory protection + upload PHP block).'
        );
    }

    public function testHtaccessIfModuleTagsAreBalanced(): void
    {
        $openCount = preg_match_all('/<IfModule\b[^>]*>/', $this->content);
        $closeCount = preg_match_all('/<\/IfModule>/', $this->content);

        $this->assertSame($openCount, $closeCount, '<IfModule> blocks must be balanced with matching closing tags.');
    }

    public function testHtaccessDeclaresSensitiveDirectoryRewriteRule(): void
    {
        $this->assertStringContainsString(
            'RewriteRule "^(includes|tests|vendor|\.vscode)(/|$)" - [F]',
            $this->content
        );
    }

    public function testHtaccessDeclaresHiddenFileRewriteRule(): void
    {
        $this->assertStringContainsString(
            'RewriteRule "(^|/)\.(?!well-known/)" - [F]',
            $this->content
        );
    }

    public function testHtaccessDeclaresUploadsPhpExecutionBlockRewriteRule(): void
    {
        $this->assertStringContainsString(
            'RewriteRule "^uploads/.*\.php" - [F,NC]',
            $this->content
        );
    }

    public function testHtaccessRetainsSecurityTxtException(): void
    {
        $this->assertMatchesRegularExpression(
            '/<Files "security\.txt">\s*\n\s*Require all granted\s*\n<\/Files>/',
            $this->content,
            'RFC 9116 requires .well-known/security.txt to remain publicly accessible.'
        );
    }

    /**
     * Boundary/negative test: verifies the actual regex semantics of the
     * hidden-file blocking rule, including the well-known negative lookahead
     * exception, by applying the extracted pattern to representative paths.
     */
    public function testHiddenFileRewritePatternBlocksDotPathsExceptWellKnown(): void
    {
        $pattern = $this->extractRewriteRulePattern('well-known');

        foreach (['.env', '.git/config', 'includes/.htpasswd', '.htaccess'] as $blockedPath) {
            $this->assertSame(
                1,
                preg_match('#' . $pattern . '#', $blockedPath),
                "Expected '{$blockedPath}' to be blocked by the hidden-file RewriteRule pattern."
            );
        }

        foreach (['.well-known/security.txt', '.well-known/'] as $allowedPath) {
            $this->assertSame(
                0,
                preg_match('#' . $pattern . '#', $allowedPath),
                "Expected '{$allowedPath}' to remain accessible under the hidden-file RewriteRule pattern (RFC 9116)."
            );
        }

        $this->assertSame(
            0,
            preg_match('#' . $pattern . '#', 'index.php'),
            'Ordinary top-level files without a leading dot must not be blocked.'
        );
    }

    /**
     * Boundary/negative test: verifies the sensitive-directory RewriteRule
     * matches the intended directories exactly and does not over-match
     * similarly-prefixed paths.
     */
    public function testSensitiveDirectoryRewritePatternMatchesOnlyIntendedDirectories(): void
    {
        $pattern = $this->extractRewriteRulePattern('includes|tests|vendor');

        foreach (['includes/config.php', 'tests', 'tests/', 'vendor/autoload.php', '.vscode/settings.json'] as $blockedPath) {
            $this->assertSame(
                1,
                preg_match('#' . $pattern . '#', $blockedPath),
                "Expected '{$blockedPath}' to be blocked by the sensitive-directory RewriteRule pattern."
            );
        }

        foreach (['includesx/file.php', 'assets/includes-like/file.php', 'data/pages/tests.md'] as $allowedPath) {
            $this->assertSame(
                0,
                preg_match('#' . $pattern . '#', $allowedPath),
                "Expected '{$allowedPath}' NOT to be blocked by the sensitive-directory RewriteRule pattern (prefix collision guard)."
            );
        }
    }

    /**
     * Boundary/negative test: verifies the uploads/ PHP execution block only
     * targets PHP files within uploads/, is case-insensitive (NC flag), and
     * does not affect non-PHP assets or files outside uploads/.
     */
    public function testUploadsPhpExecutionRewritePatternIsScopedAndCaseInsensitive(): void
    {
        $pattern = $this->extractRewriteRulePattern('uploads');

        $this->assertSame(1, preg_match('#' . $pattern . '#i', 'uploads/shell.php'));
        $this->assertSame(1, preg_match('#' . $pattern . '#i', 'uploads/evil.PHP'), 'Rule must be case-insensitive to match the [NC] flag.');
        $this->assertSame(0, preg_match('#' . $pattern . '#i', 'uploads/image.jpg'));
        $this->assertSame(0, preg_match('#' . $pattern . '#i', 'other/shell.php'), 'Rule must be anchored to the uploads/ directory only.');
    }

    public function testHtaccessRetainsUnrelatedPreExistingDirectives(): void
    {
        $this->assertStringContainsString('Options -Indexes', $this->content);
        $this->assertStringContainsString(
            '<FilesMatch "(composer\.(json|lock)|\.git.*|\.env.*|\.cursorrules|\.gitattributes)$">',
            $this->content
        );
        $this->assertStringContainsString('Header always set X-Frame-Options "SAMEORIGIN"', $this->content);
        $this->assertStringContainsString('ErrorDocument 403 "Access Denied"', $this->content);
        $this->assertStringContainsString('<IfModule mod_deflate.c>', $this->content);
        $this->assertStringContainsString('<IfModule mod_expires.c>', $this->content);
    }
}