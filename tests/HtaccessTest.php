<?php

declare(strict_types=1);

namespace CmsForNerd\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Validates the root `.htaccess` file after the "Apache .htaccess & Docker
 * Alignment (v4.1.9)" fix, which removed `<DirectoryMatch>` and `<Directory>`
 * container directives (illegal inside `.htaccess` and previously caused
 * 500 Internal Server Errors on Render) and replaced them with equivalent
 * `mod_rewrite` based `RewriteRule` directives.
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

    public function testHtaccessFileExists(): void
    {
        $this->assertFileExists($this->htaccessPath);
    }

    public function testHtaccessDoesNotUseDirectoryMatchDirective(): void
    {
        $this->assertStringNotContainsStringIgnoringCase(
            '<DirectoryMatch',
            $this->content,
            'Regression guard: <DirectoryMatch> is not permitted inside .htaccess context and previously caused 500 errors.'
        );
    }

    public function testHtaccessDoesNotUseDirectoryContainerDirective(): void
    {
        $this->assertDoesNotMatchRegularExpression(
            '/<Directory[\s"]/i',
            $this->content,
            'Regression guard: <Directory> containers are not permitted inside .htaccess context and previously caused 500 errors.'
        );
    }

    public function testHtaccessDoesNotUsePhpFlagDirective(): void
    {
        $this->assertStringNotContainsString(
            'php_flag engine off',
            $this->content,
            'The old php_flag-inside-<Directory> approach for disabling PHP execution was removed in favour of a RewriteRule.'
        );
    }

    public function testHtaccessBlocksHiddenFilesAndDirectoriesViaRewriteRule(): void
    {
        $this->assertStringContainsString(
            'RewriteRule "(^|/)\.(?!well-known/)" - [F]',
            $this->content,
            'Hidden files/directories (dotfiles) must be blocked via RewriteRule, mirroring the removed <DirectoryMatch "^\.|\/\."> behaviour, while exempting .well-known/.'
        );
    }

    public function testHtaccessBlocksSensitiveDirectoriesViaRewriteRule(): void
    {
        $this->assertStringContainsString(
            'RewriteRule "^(includes|tests|vendor|\.vscode)(/|$)" - [F]',
            $this->content,
            'includes/tests/vendor/.vscode must remain blocked, mirroring the removed <DirectoryMatch> directive.'
        );
    }

    public function testHtaccessDeclaresRewriteEngineOn(): void
    {
        $this->assertStringContainsString('RewriteEngine On', $this->content);
    }

    public function testHtaccessHiddenFileAndSensitiveDirectoryRulesAreWrappedInModRewriteIfModule(): void
    {
        $ifModuleOpen = strpos($this->content, '<IfModule mod_rewrite.c>');
        $this->assertNotFalse($ifModuleOpen, 'A mod_rewrite IfModule guard must exist.');

        $rewriteEngineOn = strpos($this->content, 'RewriteEngine On', $ifModuleOpen);
        $hiddenRule = strpos(
            $this->content,
            'RewriteRule "(^|/)\.(?!well-known/)" - [F]',
            $ifModuleOpen
        );
        $sensitiveRule = strpos(
            $this->content,
            'RewriteRule "^(includes|tests|vendor|\.vscode)(/|$)" - [F]',
            $ifModuleOpen
        );
        $ifModuleClose = strpos($this->content, '</IfModule>', $ifModuleOpen);

        $this->assertNotFalse($rewriteEngineOn, 'RewriteEngine On must follow the IfModule guard.');
        $this->assertNotFalse($hiddenRule, 'The hidden-file RewriteRule must follow the IfModule guard.');
        $this->assertNotFalse($sensitiveRule, 'The sensitive-directory RewriteRule must follow the IfModule guard.');
        $this->assertNotFalse($ifModuleClose, 'The IfModule guard must be closed.');

        $this->assertTrue(
            $ifModuleOpen < $rewriteEngineOn
            && $rewriteEngineOn < $hiddenRule
            && $hiddenRule < $sensitiveRule
            && $sensitiveRule < $ifModuleClose,
            'RewriteEngine On and both directory-protection RewriteRules must be declared, in order, inside the ' .
            'same <IfModule mod_rewrite.c> ... </IfModule> guard.'
        );
    }

    public function testHtaccessRetainsSecurityTxtException(): void
    {
        $filesOpen = strpos($this->content, '<Files "security.txt">');
        $this->assertNotFalse($filesOpen, 'security.txt must remain publicly reachable per RFC 9116.');

        $filesClose = strpos($this->content, '</Files>', $filesOpen);
        $this->assertNotFalse($filesClose, 'The security.txt Files block must be closed.');

        $block = substr($this->content, $filesOpen, $filesClose - $filesOpen);
        $this->assertStringContainsString(
            'Require all granted',
            $block,
            'security.txt must be explicitly allowed even though sibling hidden files are blocked.'
        );
    }

    public function testHtaccessBlocksPhpExecutionInUploadsDirectoryViaRewriteRule(): void
    {
        $this->assertStringContainsString(
            'RewriteRule "^uploads/.*\.php" - [F,NC]',
            $this->content,
            'PHP execution inside an uploads/ directory must be blocked via RewriteRule instead of the removed <Directory "*/uploads/*"> block.'
        );
    }

    public function testHtaccessUploadsPhpRewriteRuleIsWrappedInModRewriteIfModule(): void
    {
        $uploadsRule = strpos($this->content, 'RewriteRule "^uploads/.*\.php" - [F,NC]');
        $this->assertNotFalse($uploadsRule, 'Uploads PHP-blocking RewriteRule must exist.');

        $precedingContent = substr($this->content, 0, $uploadsRule);
        $nearestIfModuleOpen = strrpos($precedingContent, '<IfModule mod_rewrite.c>');
        $this->assertNotFalse(
            $nearestIfModuleOpen,
            'The uploads RewriteRule must be preceded by an <IfModule mod_rewrite.c> guard.'
        );

        $ifModuleClose = strpos($this->content, '</IfModule>', $uploadsRule);
        $this->assertNotFalse($ifModuleClose, 'The uploads RewriteRule guard must be closed with </IfModule>.');

        $nearestClosePriorToRule = strpos($precedingContent, '</IfModule>', $nearestIfModuleOpen);
        $this->assertFalse(
            $nearestClosePriorToRule,
            'The uploads RewriteRule must be directly enclosed by its nearest <IfModule mod_rewrite.c> guard, not nested outside it.'
        );
    }

    public function testHtaccessHasBalancedIfModuleTags(): void
    {
        $opens = preg_match_all('/<IfModule\b/', $this->content);
        $closes = preg_match_all('/<\/IfModule>/', $this->content);

        $this->assertSame($opens, $closes, '<IfModule> tags must be balanced after replacing <DirectoryMatch>/<Directory> blocks.');
        $this->assertGreaterThanOrEqual(2, $opens, 'At least the two mod_rewrite guards introduced in this fix must be present.');
    }

    public function testHtaccessStillProtectsConfigurationFilesViaFilesMatch(): void
    {
        $this->assertStringContainsString(
            '<FilesMatch "(composer\.(json|lock)|\.git.*|\.env.*|\.cursorrules|\.gitattributes)$">',
            $this->content,
            'Unrelated FilesMatch-based configuration file protection must remain intact.'
        );
    }

    public function testHtaccessStillDisablesDirectoryBrowsing(): void
    {
        $this->assertStringContainsString('Options -Indexes', $this->content);
    }

    public function testHtaccessStillDeclaresSecurityHeaders(): void
    {
        $this->assertStringContainsString('X-Frame-Options', $this->content);
        $this->assertStringContainsString('X-Content-Type-Options', $this->content);
        $this->assertStringContainsString('Referrer-Policy', $this->content);
    }

    public function testHtaccessStillDeclaresCustomErrorDocuments(): void
    {
        $this->assertStringContainsString('ErrorDocument 403', $this->content);
        $this->assertStringContainsString('ErrorDocument 404', $this->content);
        $this->assertStringContainsString('ErrorDocument 500', $this->content);
    }
}