<?php

declare(strict_types=1);

namespace CmsForNerd;

/**
 * [SECURITY] SecurityUtils - v3.3 Laboratory Standard.
 * This class provides defensive programming utilities to protect the CMS core.
 * Compliance: PHP 8.4+, PSR-12, RFC 2119.
 */
final class SecurityUtils
{
    /**
     * [SECURITY] isValidPageName() prevents "Directory Traversal" attacks.
     * All requested page names MUST be validated before use in file paths.
     * * @param string $page The raw page name from QUERY_STRING.
     */
    public static function isValidPageName(string $page): bool
    {
        // [PHP 8.4] Optimized regex for alphanumeric, dashes, and underscores.
        return (bool) preg_match('/^[a-zA-Z0-9_\-]+$/', $page);
    }

    /**
     * [SECURITY] Sanitize the page parameter.
     * Requirement: Remove any character that is NOT alphanumeric, dash, or underscore.
     */
    public static function sanitizePageName(string $pageName): string
    {
        return preg_replace('/[^a-zA-Z0-9_\-]/', '', $pageName);
    }

    /**
     * [SECURITY] Escape HTML to prevent Cross-Site Scripting (XSS).
     * ENT_QUOTES | ENT_SUBSTITUTE ensures high-level protection for UTF-8.
     */
    public static function escapeHtml(string $content): string
    {
        return htmlspecialchars($content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    /**
     * [SECURITY] Generate a Content Security Policy (CSP) Nonce.
     * MUST be used for inline scripts to comply with v3.3 safety protocols.
     */
    public static function generateNonce(): string
    {
        return base64_encode(random_bytes(16));
    }
}
