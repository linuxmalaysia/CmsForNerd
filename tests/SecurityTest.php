<?php

declare(strict_types=1);

namespace CmsForNerd\Tests;

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
        $this->assertFalse(
            SecurityUtils::isValidPageName('../etc/passwd'),
            'Directory traversal should fail'
        );
        $this->assertFalse(
            SecurityUtils::isValidPageName('page.php'),
            'Extensions should fail validation if not allowed'
        );
        $this->assertFalse(
            SecurityUtils::isValidPageName('page?id=1'),
            'Query characters should fail'
        );
    }

    /**
     * Test Bot Detection
     */
    public function testBotDetection(): void
    {
        // Mock a trusted Googlebot IP to bypass Hybrid Intelligence "Trust but Verify"
        $_SERVER['REMOTE_ADDR'] = '66.249.66.1';

        // Known Bots
        $this->assertTrue(
            is_bot('Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)'),
            'Failed to detect Googlebot with mocked trusted IP'
        );
        $this->assertTrue(
            is_bot('Mozilla/5.0 (compatible; Bingbot/2.0; +http://www.bing.com/bingbot.htm)'),
            'Failed to detect Bingbot with mocked trusted IP'
        );

        // Known Humans
        $humanUa = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) ' .
                   'AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36';
        $this->assertFalse(is_bot($humanUa), 'Human UA incorrectly flagged as bot');

        $mobileUa = 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) ' .
                    'AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1';
        $this->assertFalse(is_bot($mobileUa), 'Mobile Human UA incorrectly flagged as bot');

        // Cleanup
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
    }

    /**
     * Test Hardened IPv6 CIDR Matcher
     */
    public function testIpv6InRange(): void
    {
        // Exact match /128
        $this->assertTrue(ip_in_range('2001:db8::1', '2001:db8::1/128'));
        $this->assertFalse(ip_in_range('2001:db8::2', '2001:db8::1/128'));

        // Subnet boundary match
        $this->assertTrue(ip_in_range('2001:db8::1', '2001:db8::/64'));
        $this->assertTrue(ip_in_range('2001:db8:85a3::8a2e:370:7334', '2001:db8::/32'));
        $this->assertFalse(ip_in_range('2001:db9::1', '2001:db8::/64'));

        // Type mismatches (IPv4 vs IPv6)
        $this->assertFalse(ip_in_range('127.0.0.1', '2001:db8::/64'));
        $this->assertFalse(ip_in_range('2001:db8::1', '127.0.0.1/32'));

        // Edge case: /0 subnet (should match any address in the protocol)
        $this->assertTrue(ip_in_range('2001:db8::1', '::/0'));
        $this->assertTrue(ip_in_range('127.0.0.1', '0.0.0.0/0'));
    }
}
