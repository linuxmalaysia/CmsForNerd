<?php

declare(strict_types=1);

namespace CmsForNerd\Tests;

use PHPUnit\Framework\TestCase;

/**
 * StandardsTest
 *
 * Verifies that all files in the includes/ directory follow PSR-12
 * and our RFC 2119 'MUST' rules (strict_types).
 */
class StandardsTest extends TestCase
{
    private array $filesToTest = [];

    protected function setUp(): void
    {
        $this->filesToTest = glob(__DIR__ . '/../includes/*.php');
    }

    /**
     * RFC 2119 MUST: All core PHP files MUST have declare(strict_types=1);
     */
    public function testStrictTypesPresence(): void
    {
        foreach ($this->filesToTest as $file) {
            $content = file_get_contents($file);
            $this->assertStringContainsString(
                'declare(strict_types=1);',
                $content,
                "File " . basename($file) . " MUST contain declare(strict_types=1);"
            );
        }
    }

    /**
     * PSR-12: Indentation MUST be 4 spaces. Tabs are MUST NOT.
     */
    public function testIndentationIsFourSpaces(): void
    {
        foreach ($this->filesToTest as $file) {
            $lines = file($file);
            foreach ($lines as $index => $line) {
                // Check for tabs
                $this->assertStringNotContainsString(
                    "\t",
                    $line,
                    "File " . basename($file) . " line " . ($index + 1) . " MUST NOT use tabs."
                );

                // Check for indentation (leading spaces)
                if (preg_match('/^ +/', $line, $matches)) {
                    $spaces = strlen($matches[0]);

                    // Skip lines starting with " * " (part of a multi-line comment)
                    if (str_starts_with(trim($line), '*')) {
                        continue;
                    }

                    $this->assertEquals(
                        0,
                        $spaces % 4,
                        "File " . basename($file) . " line " . ($index + 1) . " MUST use a multiple of 4 spaces (found $spaces)."
                    );
                }
            }
        }
    }

    /**
     * PSR-12: Opening braces for classes/functions MUST be on a new line.
     */
    public function testBracePlacement(): void
    {
        $checked = false;
        foreach ($this->filesToTest as $file) {
            $lines = file($file);
            foreach ($lines as $index => $line) {
                if (preg_match('/(class|function).*\{/', $line)) {
                    $this->fail("File " . basename($file) . " line " . ($index + 1) . " has '{' on the same line as class/function declaration.");
                }
            }
            $checked = true;
        }
        $this->assertTrue($checked, "Should have checked at least one file.");
    }
}
