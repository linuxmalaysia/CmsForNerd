<?php

declare(strict_types=1);

namespace CmsForNerd;

/**
 * [EDUCATION] Legacy User Class - Used in Module 1 Lab.
 * Students are tasked to refactor this using PHP 8.4 Constructor Promotion.
 */
class User
{
    public readonly string $username;
    public string $role;
    private int $viewCount = 0;

    public function __construct(string $username, string $role = 'student')
    {
        $this->username = $username;
        $this->role = $role;
    }

    public function getViewCount(): int
    {
        return $this->viewCount;
    }

    public function incrementViews(): void
    {
        $this->viewCount++;
    }
}
