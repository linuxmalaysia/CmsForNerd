<?php
declare(strict_types=1);

namespace CmsForNerd;

/**
 * SecurityUtils helper class.
 * Encapsulates security logic for unit testing.
 */
class SecurityUtils
{
    /**
     * Validates if a page name is safe to use in a file path.
     * Prevents directory traversal attacks.
     * 
     * @param string $page The page name to validate.
     * @return bool True if the page name is valid/safe.
     */
    public static function isValidPageName(string $page): bool
    {
        // Standard alphanumeric + dash/underscore check
        return (bool) preg_match('/^[a-zA-Z0-9_\-]+$/', $page);
    }
}
