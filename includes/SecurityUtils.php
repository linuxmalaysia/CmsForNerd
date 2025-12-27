<?php

declare(strict_types=1);

namespace CmsForNerd;

/**
 * [SECURITY] SecurityUtils - A dedicated class for defensive programming.
 * This class MUST be used for all sensitive input validation.
 */
class SecurityUtils
{
    /**
     * [SECURITY] isValidPageName() prevents "Directory Traversal" attacks.
     * All requested page names MUST be validated by this method before use in file paths.
     *
     * @param string $page The page name to validate.
     * @return bool True if the name is valid.
     */
    public static function isValidPageName(string $page): bool
    {
        // [PHP] we only allow simple letters, numbers, and dashes.
        return (bool) preg_match('/^[a-zA-Z0-9_\-]+$/', $page);
    }

    /**
     * [SECURITY] Sanitize the page parameter to prevent directory traversal.
     * Requirement: The 'page' parameter MUST be sanitized using preg_replace.
     *
     * @param string $pageName
     * @return string
     */
    public static function sanitizePageName(string $pageName): string
    {
        // [RFC 2119] Requirement: MUST be sanitized using preg_replace.
        return preg_replace('/[^a-zA-Z0-9_\-]/', '', $pageName);
    }

    /**
     * [SECURITY] Escape HTML special characters to prevent XSS.
     * Requirement: All user-provided strings MUST be escaped before rendering.
     *
     * @param string $content
     * @return string
     */
    public static function escapeHtml(string $content): string
    {
        // [RFC 2119] Requirement: MUST be escaped using htmlspecialchars().
        // ENT_QUOTES ensures both single and double quotes are escaped.
        return htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
    }

    /**
     * [SECURITY] Generate a cryptographically secure nonce for CSP.
     * Nonces MUST be used to prevent inline script XSS attacks.
     *
     * @return string Base64-encoded random nonce
     */
    public static function generateNonce(): string
    {
        // [RFC 2119] Requirement: MUST use cryptographically secure random bytes.
        return base64_encode(random_bytes(16));
    }
}

