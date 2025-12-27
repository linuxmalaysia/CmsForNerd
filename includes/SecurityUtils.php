<?php
declare(strict_types=1);

namespace CmsForNerd;

/**
 * [SECURITY] SecurityUtils - A dedicated class for defensive programming.
 * In modern PHP, we group related security functions into classes for better testing and reusability.
 */
class SecurityUtils
{
    /**
     * [SECURITY] isValidPageName() prevents "Directory Traversal" attacks.
     * A hacker might try to use "../../../etc/passwd" as a page name to steal server secrets.
     * This function blocks that by only allowing simple letters, numbers, and dashes.
     */
    public static function isValidPageName(string $page): bool
    {
        // [PHP] preg_match() checks the string against a 'Regular Expression' pattern.
        // ^[a-zA-Z0-9_\-]+$ means: 
        // Start (^) with Alphanumeric/Dash/Underscore and nothing else until the end ($).
        return (bool) preg_match('/^[a-zA-Z0-9_\-]+$/', $page);
    }
}
