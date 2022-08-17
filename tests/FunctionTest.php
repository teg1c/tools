<?php

namespace Tegic\Tools\Tests;

use PHPUnit\Framework\TestCase;

class FunctionTest extends TestCase
{
    public function testNamespace()
    {
        self::assertFalse(function_exists('collect'));
        self::assertFalse(function_exists('value'));
        self::assertFalse(function_exists('data_get'));
        self::assertTrue(function_exists('Tegic\Tools\collect'));
        self::assertTrue(function_exists('Tegic\Tools\value'));
        self::assertTrue(function_exists('Tegic\Tools\data_get'));
    }
}
