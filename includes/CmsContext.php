<?php
declare(strict_types=1);

namespace CmsForNerd;

/**
 * Context object to hold the state of the CMS application.
 * Replaces global variables.
 * Immutable by design using PHP 8.2+ readonly class.
 */
readonly class CmsContext {
    public function __construct(
        public array $content = [],
        public string $themeName = 'CmsForNerd',
        public string $cssPath = '',
        public array $dataFile = [],
        public string $scriptName = '',
    ) {}
}
