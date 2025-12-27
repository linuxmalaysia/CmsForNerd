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
    public string $baseUrl;
    public string $cspNonce;

    public function __construct(
        public array $content = [],
        public string $themeName = 'CmsForNerd',
        public string $cssPath = '',
        public array $dataFile = [],
        public string $scriptName = '',
        ?string $baseUrl = null,
        ?string $cspNonce = null,
    ) {
        if ($baseUrl === null && isset($_SERVER['HTTP_HOST'])) {
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
            $host = $_SERVER['HTTP_HOST'];
            $path = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $baseUrl = "$protocol://$host$path/";
        }
        $this->baseUrl = $baseUrl ?? '';
        $this->cspNonce = $cspNonce ?? SecurityUtils::generateNonce();
    }
}

