<?php

declare(strict_types=1);

namespace CmsForNerd\Tests;

use PHPUnit\Framework\TestCase;
use CmsForNerd\CmsContext;

final class CmsContextTest extends TestCase
{
    public function testCanBeCreatedWithDefaultValues(): void
    {
        $ctx = new CmsContext(
            content: [],
            themeName: 'CmsForNerd',
            cssPath: 'themes/CmsForNerd/style.css',
            dataFile: ['index'],
            scriptName: 'index'
        );

        $this->assertInstanceOf(CmsContext::class, $ctx);
        $this->assertSame([], $ctx->content);
        $this->assertSame('CmsForNerd', $ctx->themeName);
    }

    public function testCanBeCreatedWithCustomValues(): void
    {
        $ctx = new CmsContext(
            content: ['title' => 'Test'],
            themeName: 'MyTheme',
            cssPath: 'themes/MyTheme/custom.css',
            dataFile: ['about'],
            scriptName: 'about'
        );

        $this->assertSame(['title' => 'Test'], $ctx->content);
        $this->assertSame('MyTheme', $ctx->themeName);
    }
}
