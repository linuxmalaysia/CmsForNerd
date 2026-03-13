<?php

declare(strict_types=1);

use CmsForNerd\CmsContext;

it('can be created with default values', function (): void {
    $ctx = new CmsContext(
        content: [],
        themeName: 'CmsForNerd',
        cssPath: 'themes/CmsForNerd/style.css',
        dataFile: ['index'],
        scriptName: 'index'
    );

    expect($ctx)
        ->toBeInstanceOf(CmsContext::class)
        ->and($ctx->content)->toBe([])
        ->and($ctx->themeName)->toBe('CmsForNerd');
});

it('can be created with custom values', function (): void {
    $ctx = new CmsContext(
        content: ['title' => 'Test'],
        themeName: 'MyTheme',
        cssPath: 'themes/MyTheme/custom.css',
        dataFile: ['about'],
        scriptName: 'about'
    );

    expect($ctx->content)->toBe(['title' => 'Test'])
        ->and($ctx->themeName)->toBe('MyTheme');
}
);

