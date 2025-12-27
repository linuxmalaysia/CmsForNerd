<?php

declare(strict_types=1);

namespace CmsForNerd;

/**
 * Context object to hold the state of the CMS application.
 * This object MUST be used to replace legacy global variables.
 * It is RECOMMENDED to keep this class immutable using the readonly modifier.
 */
readonly class CmsContext
{
    public function __construct(
        public array $content = [],
        public string $themeName = 'CmsForNerd',
        public string $cssPath = '',
        public array $dataFile = [],
        public string $scriptName = '',
    ) {
    }
}
