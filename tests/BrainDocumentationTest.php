<?php

declare(strict_types=1);

namespace CmsForNerd\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Validates the .agents/brain/task.md and .agents/brain/walkthrough.md DSOM
 * protocol logs after the "Apache .htaccess & Docker Alignment" session
 * (Module 20, v4.1.9).
 */
final class BrainDocumentationTest extends TestCase
{
    private string $taskMdPath;
    private string $walkthroughMdPath;

    protected function setUp(): void
    {
        $this->taskMdPath = dirname(__DIR__) . '/.agents/brain/task.md';
        $this->walkthroughMdPath = dirname(__DIR__) . '/.agents/brain/walkthrough.md';
    }

    public function testTaskMdExists(): void
    {
        $this->assertFileExists($this->taskMdPath);
    }

    public function testWalkthroughMdExists(): void
    {
        $this->assertFileExists($this->walkthroughMdPath);
    }

    public function testTaskMdDocumentsModule20Checklist(): void
    {
        $content = file_get_contents($this->taskMdPath);

        $this->assertStringContainsString(
            '## [x] Module 20: Apache .htaccess & Docker Alignment (v4.1.9)',
            $content
        );
        $this->assertStringContainsString('removing `<DirectoryMatch>` and `<Directory>` tags', $content);
        $this->assertStringContainsString(
            'exposing port 80 and chowning only `/var/www/html/data`',
            $content
        );
        $this->assertStringContainsString(
            'Synchronise `sonar-project.properties` exclusions with `.github/workflows/build.yml`',
            $content
        );
        $this->assertStringContainsString('Deduplicate header comments in `.dockerignore`', $content);
        $this->assertStringContainsString('composer lab-check', $content);
    }

    public function testTaskMdModule20ChecklistItemsAreAllMarkedComplete(): void
    {
        $content = file_get_contents($this->taskMdPath);

        $moduleStart = strpos($content, '## [x] Module 20: Apache .htaccess & Docker Alignment (v4.1.9)');
        $this->assertNotFalse($moduleStart, 'Module 20 section must exist.');

        $sectionEnd = strpos($content, '---', $moduleStart);
        $moduleBlock = substr(
            $content,
            $moduleStart,
            ($sectionEnd !== false ? $sectionEnd : strlen($content)) - $moduleStart
        );

        $checklistLines = array_values(array_filter(
            explode("\n", $moduleBlock),
            static fn (string $line): bool => str_starts_with(trim($line), '- [')
        ));

        $this->assertNotEmpty($checklistLines, 'Module 20 must contain checklist items.');
        foreach ($checklistLines as $line) {
            $this->assertStringStartsWith(
                '- [x]',
                trim($line),
                "Checklist item must be marked complete: {$line}"
            );
        }
    }

    public function testTaskMdFooterSignatureDateIsUpdated(): void
    {
        $content = file_get_contents($this->taskMdPath);

        $this->assertStringContainsString(
            '*Deep State of Mind (DSOM) For My AI Protocol | Harisfazillah Jamel (LinuxMalaysia) | 2026-07-31*',
            $content
        );
        $this->assertStringNotContainsString(
            '*Deep State of Mind (DSOM) For My AI Protocol | Harisfazillah Jamel (LinuxMalaysia) | 2026-07-30*',
            $content,
            'Stale footer signature date must not remain after the handover update.'
        );
    }

    public function testWalkthroughMdDocumentsSessionAnchorForModule20(): void
    {
        $content = file_get_contents($this->walkthroughMdPath);

        $this->assertStringContainsString(
            '## 🏁 Session Anchor: 2026-07-31 — Apache .htaccess & Docker Alignment (v4.1.9)',
            $content
        );
        $this->assertStringContainsString('### Accomplishments', $content);
        $this->assertStringContainsString('### Why', $content);
        $this->assertStringContainsString('### Mental Anchor', $content);
    }

    public function testWalkthroughMdExplainsHtaccessRewriteReplacement(): void
    {
        $content = file_get_contents($this->walkthroughMdPath);

        $this->assertStringContainsString(
            'Completely removed incompatible `<DirectoryMatch>` and `<Directory>` tags from `.htaccess`',
            $content
        );
        $this->assertStringContainsString('mod_rewrite', $content);
    }

    public function testWalkthroughMdMentionsBothExposedPorts(): void
    {
        $content = file_get_contents($this->walkthroughMdPath);

        $this->assertStringContainsString('exposing both port 80 and port 8080', $content);
    }

    public function testWalkthroughMdMentionsDataDirectoryOwnershipRestriction(): void
    {
        $content = file_get_contents($this->walkthroughMdPath);

        $this->assertStringContainsString(
            'limiting `chown` recursively to only `/var/www/html/data`',
            $content
        );
    }

    public function testWalkthroughMdFooterSignatureDateIsUpdated(): void
    {
        $content = file_get_contents($this->walkthroughMdPath);

        $this->assertStringContainsString(
            '*Deep State of Mind (DSOM) For My AI Protocol | Harisfazillah Jamel (LinuxMalaysia) | 2026-07-31*',
            $content
        );
    }

    public function testWalkthroughMdHasNoDuplicateSessionAnchorHeadings(): void
    {
        $content = file_get_contents($this->walkthroughMdPath);

        preg_match_all('/^## 🏁 Session Anchor:.*$/m', $content, $matches);
        $headings = $matches[0];

        $this->assertNotEmpty($headings, 'Expected at least one session anchor heading.');
        $this->assertSame(
            count($headings),
            count(array_unique($headings)),
            'Each session anchor heading must be unique so history entries are not accidentally duplicated.'
        );
    }
}