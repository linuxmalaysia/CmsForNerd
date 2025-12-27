<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class AboutPageTest extends TestCase
{
    public function testAboutBodyExists(): void
    {
        $path = __DIR__ . '/../contents/about-body.inc';
        $this->assertFileExists($path);

        $content = file_get_contents($path);
        $this->assertStringContainsString('About CMSForNerd', $content);
    }
}
