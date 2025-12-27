<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use CmsForNerd\SecurityUtils;

require_once 'includes/is_bot.php';

final class SecurityTest extends TestCase
{
    /**
     * Test Input Validation (Directory Traversal Protection)
     */
    public function testPageNameValidation(): void
    {
        $this->assertTrue(SecurityUtils::isValidPageName('about'));
        $this->assertTrue(SecurityUtils::isValidPageName('my-page_123'));
        
        // Security checks
        $this->assertFalse(SecurityUtils::isValidPageName('../etc/passwd'), 'Directory traversal should fail');
        $this->assertFalse(SecurityUtils::isValidPageName('page.php'), 'Extensions should fail validation if not allowed');
        $this->assertFalse(SecurityUtils::isValidPageName('page?id=1'), 'Query characters should fail');
    }

    /**
     * Test Bot Detection
     */
    public function testBotDetection(): void
    {
        // Known Bots
        $this->assertTrue(is_bot('Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)'));
        $this->assertTrue(is_bot('Mozilla/5.0 (compatible; Bingbot/2.0; +http://www.bing.com/bingbot.htm)'));
        
        // Known Humans
        $this->assertFalse(is_bot('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36'));
        $this->assertFalse(is_bot('Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1'));
    }
}

