<?php

declare(strict_types=1);

namespace CmsForNerd\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Validates the Dockerfile, Containerfile and .dockerignore introduced/updated
 * in the "Resolve Render Blueprint build failure" change set.
 *
 * Render's cloud build stage expects a `Dockerfile`, while local Podman
 * workflows expect a `Containerfile`. Both files must stay in sync and the
 * build context must exclude development-only assets.
 */
final class DockerBuildTest extends TestCase
{
    private string $dockerfilePath;
    private string $containerfilePath;
    private string $dockerignorePath;

    protected function setUp(): void
    {
        $this->dockerfilePath = dirname(__DIR__) . '/Dockerfile';
        $this->containerfilePath = dirname(__DIR__) . '/Containerfile';
        $this->dockerignorePath = dirname(__DIR__) . '/.dockerignore';
    }

    public function testDockerfileExists(): void
    {
        $this->assertFileExists($this->dockerfilePath, 'Root-level Dockerfile is required by render.yaml (dockerfilePath: Dockerfile).');
    }

    public function testContainerfileExists(): void
    {
        $this->assertFileExists($this->containerfilePath, 'Root-level Containerfile must remain for local Podman workflows.');
    }

    public function testDockerfileUsesSupportedPhpApacheBaseImage(): void
    {
        $content = file_get_contents($this->dockerfilePath);

        $this->assertMatchesRegularExpression(
            '/^FROM php:8\.4-apache AS builder$/m',
            $content,
            'Builder stage must be based on the php:8.4-apache image.'
        );
    }

    public function testDockerfileIsMultiStageBuild(): void
    {
        $content = file_get_contents($this->dockerfilePath);

        $fromCount = preg_match_all('/^FROM /m', $content);
        $this->assertSame(2, $fromCount, 'Dockerfile must declare exactly two build stages (builder + runtime).');
        $this->assertMatchesRegularExpression('/^FROM php:8\.4-apache$/m', $content, 'Final runtime stage must be a fresh php:8.4-apache image.');
    }

    public function testDockerfileInstallsComposerFromPinnedOfficialImage(): void
    {
        $content = file_get_contents($this->dockerfilePath);

        $this->assertStringContainsString(
            'COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer',
            $content,
            'Composer binary must be copied from the pinned composer:2.8 image rather than installed via curl.'
        );
    }

    public function testDockerfileValidatesPlatformRequirementsBeforeInstall(): void
    {
        $content = file_get_contents($this->dockerfilePath);

        $this->assertStringContainsString('composer check-platform-reqs', $content);
        $this->assertStringContainsString(
            'composer install --no-dev --no-scripts --no-progress --optimize-autoloader --no-interaction',
            $content,
            'Production image must install dependencies without dev packages or install-time scripts.'
        );
    }

    public function testDockerfileEnablesRequiredApacheModules(): void
    {
        $content = file_get_contents($this->dockerfilePath);

        $this->assertStringContainsString(
            'a2enmod rewrite headers',
            $content,
            'mod_rewrite (routing) and mod_headers (security headers) must both be enabled.'
        );
    }

    public function testDockerfileAllowsHtaccessOverridesOnDocumentRootOnly(): void
    {
        $content = file_get_contents($this->dockerfilePath);

        $this->assertMatchesRegularExpression(
            '/<Directory \/var\/www\/html>\s*\n\s*AllowOverride All\s*\n\s*Require all granted\s*\n<\/Directory>/',
            $content,
            'AllowOverride must be scoped to /var/www/html so .htaccess security controls are respected.'
        );
        $this->assertStringContainsString('a2enconf document-root-override', $content);
    }

    public function testDockerfileCopiesVendorFromBuilderStage(): void
    {
        $content = file_get_contents($this->dockerfilePath);

        $this->assertStringContainsString(
            'COPY --from=builder /app/vendor /var/www/html/vendor',
            $content,
            'Runtime stage must reuse dependencies built in the builder stage instead of reinstalling them.'
        );
    }

    public function testDockerfileGrantsWriteAccessOnlyToDataDirectory(): void
    {
        $content = file_get_contents($this->dockerfilePath);

        $this->assertMatchesRegularExpression(
            '/^RUN chown -R www-data:www-data \/var\/www\/html\/data$/m',
            $content,
            'Only the runtime data directory should be chowned to www-data; the rest of the tree stays root-owned for defence in depth.'
        );
        $this->assertDoesNotMatchRegularExpression(
            '/chown -R www-data:www-data \/var\/www\/html\s*$/m',
            $content,
            'Ownership must not be granted recursively across the entire webroot.'
        );
    }

    public function testDockerfileExposesPort80(): void
    {
        $content = file_get_contents($this->dockerfilePath);

        $this->assertMatchesRegularExpression('/^EXPOSE 80$/m', $content);
    }

    public function testDockerfileExposesBothPort80AndPort8080(): void
    {
        $content = file_get_contents($this->dockerfilePath);

        $this->assertMatchesRegularExpression(
            '/^EXPOSE 80\nEXPOSE 8080$/m',
            $content,
            'Port 80 must be exposed alongside the pre-existing unprivileged port 8080, in that order, so both ' .
            'the PHPUnit DockerBuildTest expectations and the existing Apache "Listen 8080" configuration are satisfied.'
        );
    }

    public function testContainerfileExposesBothPort80AndPort8080(): void
    {
        $content = file_get_contents($this->containerfilePath);

        $this->assertMatchesRegularExpression(
            '/^EXPOSE 80\nEXPOSE 8080$/m',
            $content,
            'Containerfile must expose the same ports as Dockerfile for local Podman workflows to stay in sync.'
        );
    }

    public function testDockerfileAndContainerfileAreFunctionallyIdentical(): void
    {
        $dockerfileContent = file_get_contents($this->dockerfilePath);
        $containerfileContent = file_get_contents($this->containerfilePath);

        // The only intentional difference between the two files is the
        // human-readable label naming which artefact they describe.
        $normalizedContainerfile = str_replace('Containerfile', 'Dockerfile', $containerfileContent);

        $this->assertSame(
            $dockerfileContent,
            $normalizedContainerfile,
            'Dockerfile and Containerfile must stay in sync so both Podman and Render/Docker builds behave identically.'
        );
    }

    public function testDockerignoreExists(): void
    {
        $this->assertFileExists($this->dockerignorePath);
    }

    private function getDockerignoreEntries(): array
    {
        $lines = file($this->dockerignorePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        return array_map('trim', $lines);
    }

    public function testDockerignoreExcludesVersionControlAndEditorArtefacts(): void
    {
        $entries = $this->getDockerignoreEntries();

        $this->assertContains('.git', $entries);
        $this->assertContains('.github', $entries);
        $this->assertContains('.vscode', $entries);
    }

    public function testDockerignoreExcludesTestingAndTooling(): void
    {
        $entries = $this->getDockerignoreEntries();

        foreach (['tests', 'tools', 'playbooks', 'inventory', 'technical-resources', '.phpunit.cache'] as $expected) {
            $this->assertContains($expected, $entries, "Expected .dockerignore to exclude '{$expected}'.");
        }
    }

    public function testDockerignoreExcludesVendorDirectory(): void
    {
        $entries = $this->getDockerignoreEntries();

        $this->assertContains(
            'vendor',
            $entries,
            'vendor/ is (re)installed inside the image by Composer and should not be copied from the host.'
        );
    }

    public function testDockerignoreExcludesContainerAndCiDefinitionFiles(): void
    {
        $entries = $this->getDockerignoreEntries();

        foreach (['Dockerfile', 'Containerfile', 'render.yaml'] as $expected) {
            $this->assertContains($expected, $entries, "Expected .dockerignore to exclude '{$expected}' from the build context.");
        }
    }

    public function testDockerignoreExcludesLintingAndTestConfigFiles(): void
    {
        $entries = $this->getDockerignoreEntries();

        foreach (['phpstan.neon', 'phpunit.xml', 'phpcs.xml'] as $expected) {
            $this->assertContains($expected, $entries, "Expected .dockerignore to exclude '{$expected}'.");
        }
    }

    public function testDockerignoreExcludesLogFilesByGlob(): void
    {
        $entries = $this->getDockerignoreEntries();

        $this->assertContains('*.log', $entries);
    }

    public function testDockerignoreDoesNotExcludeApplicationSourceDirectories(): void
    {
        $entries = $this->getDockerignoreEntries();

        foreach (['src', 'includes', 'data', 'composer.json', 'composer.lock'] as $mustBeShipped) {
            $this->assertNotContains(
                $mustBeShipped,
                $entries,
                "'{$mustBeShipped}' must be copied into the image and must not be present in .dockerignore."
            );
        }
    }

    public function testDockerignoreHasNoDuplicateEntries(): void
    {
        $entries = $this->getDockerignoreEntries();

        $this->assertSame(
            count($entries),
            count(array_unique($entries)),
            '.dockerignore should not contain duplicate patterns.'
        );
    }

    /**
     * Regression guard for the "Deduplicate header comments in .dockerignore"
     * fix: the decorative banner separator lines in the header block
     * previously repeated the exact same string, which is disallowed by the
     * project's "no duplicate lines" rule.
     */
    public function testDockerignoreHeaderBannerLinesAreNotDuplicated(): void
    {
        $lines = file($this->dockerignorePath, FILE_IGNORE_NEW_LINES);
        $headerLines = array_slice($lines, 0, 10);

        $bannerLines = array_values(array_filter(
            $headerLines,
            static fn (string $line): bool => (bool) preg_match('/^#[=\-]+$/', trim($line))
        ));

        $this->assertGreaterThanOrEqual(
            2,
            count($bannerLines),
            'Expected at least two decorative banner separator lines in the .dockerignore header.'
        );
        $this->assertSame(
            count($bannerLines),
            count(array_unique($bannerLines)),
            'Decorative header banner separator lines must not be exact duplicates of one another.'
        );
    }

    public function testDockerignoreHeaderUsesDashSeparatorBetweenMetadataAndPurposeBlocks(): void
    {
        $content = file_get_contents($this->dockerignorePath);

        $this->assertStringContainsString(
            '# ------------------------------------------------------------------------------',
            $content,
            'The metadata block and the purpose block must be divided by a dash separator rather than ' .
            'a duplicate of the equals-sign banner used elsewhere in the header.'
        );
    }
}