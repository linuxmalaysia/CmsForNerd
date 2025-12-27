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
     */
    public static function isValidPageName(string $page): bool
    {
        // [PHP] preg_match() checks the string against a 'Regular Expression' pattern.
        return (bool) preg_match('/^[a-zA-Z0-9_\-]+$/', $page);
    }
}

