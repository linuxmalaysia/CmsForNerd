<?php

declare(strict_types=1);

namespace CmsForNerd\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Validates the .htaccess security configuration after the "Apache
 * .htaccess & Docker Alignment" change set (Module 20, v4.1.9).
 *
 * Apache does not permit <Directory> or <DirectoryMatch> directives inside
 * .htaccess files -- they are only valid in server/virtual-host contexts.
 * Their presence caused 500 Internal Server Errors on Render. They have
 * been replaced with functionally-equivalent mod_rewrite rules.
 */
final class HtaccessTest extends TestCase
{
    private string $htaccessPath;

    protected function setUp(): void
    {
        $this->htaccessPath = dirname(__DIR__) . '/.htaccess';
    }

    public function testHtaccessExists(): void
    {
        $this->assertFileExists($this->htaccessPath);
    }

    public function testHtaccessDoesNotContainDirectoryMatchTag(): void
    {
        $content = file_get_contents($this->htaccessPath);

        $this->assertStringNotContainsString(
            '<DirectoryMatch',
            $content,
            '<DirectoryMatch> is not permitted inside .htaccess files and causes 500 Internal Server Errors.'
        );
    }

    public function testHtaccessDoesNotContainDirectoryTag(): void
    {
        $content = file_get_contents($this->htaccessPath);

        $this->assertDoesNotMatchRegularExpression(
            '/<Directory[\s"]/',
            $content,
            '<Directory> is not permitted inside .htaccess files and causes 500 Internal Server Errors.'
        );
    }

    public function testHtaccessRemovesLegacyDirectoryMatchAndDirectoryPatterns(): void
    {
        $content = file_get_contents($this->htaccessPath);

        $this->assertStringNotContainsString('<DirectoryMatch "^\.|\/\.">', $content);
        $this->assertStringNotContainsString(
            '<DirectoryMatch "^/(includes|tests|vendor|\.vscode|\.well-known)">',
            $content
        );
        $this->assertStringNotContainsString('<Directory "*/uploads/*">', $content);
        $this->assertStringNotContainsString(
            'php_flag engine off',
            $content,
            'The php_flag directive was only valid inside the removed <Directory> block.'
        );
    }

    public function testHtaccessUsesModRewriteToProtectHiddenFilesAndDirectories(): void
    {
        $content = file_get_contents($this->htaccessPath);

        $this->assertStringContainsString('<IfModule mod_rewrite.c>', $content);
        $this->assertStringContainsString('RewriteEngine On', $content);
        $this->assertStringContainsString(
            'RewriteRule "(^|/)\.(?!well-known/)" - [F]',
            $content,
            'Hidden dot-files/directories must be blocked while still allowing .well-known/.'
        );
    }

    public function testHtaccessBlocksSensitiveDirectoriesViaRewriteRule(): void
    {
        $content = file_get_contents($this->htaccessPath);

        $this->assertStringContainsString(
            'RewriteRule "^(includes|tests|vendor|\.vscode)(/|$)" - [F]',
            $content,
            'includes/, tests/, vendor/ and .vscode/ must remain blocked via mod_rewrite instead of DirectoryMatch.'
        );
    }

    public function testHtaccessAllowsWellKnownSecurityTxtException(): void
    {
        $content = file_get_contents($this->htaccessPath);

        $this->assertMatchesRegularExpression(
            '/<Files "security\.txt">\s*\n\s*Require all granted\s*\n<\/Files>/',
            $content,
            'RFC 9116 requires security.txt to remain publicly accessible even though .well-known is otherwise blocked.'
        );
    }

    public function testHtaccessPreventsPhpExecutionInUploadsViaRewriteRule(): void
    {
        $content = file_get_contents($this->htaccessPath);

        $this->assertStringContainsString(
            'RewriteRule "^uploads/.*\.php" - [F,NC]',
            $content,
            'PHP execution inside uploads/ must be blocked via mod_rewrite instead of the removed <Directory> block.'
        );
    }

    public function testHtaccessHasExactlyTwoModRewriteGuardBlocks(): void
    {
        $content = file_get_contents($this->htaccessPath);

        $this->assertSame(
            2,
            substr_count($content, '<IfModule mod_rewrite.c>'),
            'One mod_rewrite guard block protects hidden files/directories; a second protects uploads/.'
        );
    }

    public function testHtaccessIfModuleTagsAreBalanced(): void
    {
        $content = file_get_contents($this->htaccessPath);

        $this->assertSame(
            substr_count($content, '<IfModule'),
            substr_count($content, '</IfModule>'),
            'Every opened <IfModule> block must have a matching closing tag.'
        );
    }

    public function testHtaccessDocumentsWhyDirectoryTagsWereRemoved(): void
    {
        $content = file_get_contents($this->htaccessPath);

        $this->assertStringContainsString(
            'DirectoryMatch is not allowed in .htaccess files and causes 500 errors',
            $content
        );
        $this->assertStringContainsString(
            'Directory is not allowed in .htaccess files and causes 500 errors',
            $content
        );
    }

    /**
     * Regression guard: fixing the Directory/DirectoryMatch syntax errors
     * must not remove the other, unrelated security controls that were
     * already present in the file.
     */
    public function testHtaccessRetainsUnrelatedSecurityControls(): void
    {
        $content = file_get_contents($this->htaccessPath);

        $this->assertStringContainsString('Options -Indexes', $content);
        $this->assertStringContainsString(
            'Header always set X-Frame-Options "SAMEORIGIN"',
            $content
        );
        $this->assertStringContainsString('ErrorDocument 500 "Server Error"', $content);
        $this->assertStringContainsString(
            '<FilesMatch "(composer\.(json|lock)|\.git.*|\.env.*|\.cursorrules|\.gitattributes)$">',
            $content
        );
    }
}