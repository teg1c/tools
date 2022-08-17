<?php

namespace Tegic\Tools\Tests;

use PHPUnit\Framework\TestCase;
use Tegic\Tools\Collection;
use Tegic\Tools\Config;

class ConfigTest extends TestCase
{
    public function testBootstrap()
    {
        $config = [];

        self::assertInstanceOf(Collection::class, new Config($config));
    }
}
