<?php

namespace Tegic\Tools\Tests\Traits;

use PHPUnit\Framework\TestCase;
use Tegic\Tools\Tests\Stubs\TraitStub;

class ArrayAccessTest extends TestCase
{
    protected $class;

    protected function setUp(): void
    {
        $this->class = new TraitStub();
    }

    public function testAccess()
    {
        self::assertEquals('tegic', $this->class->name);

        $this->class->name = 'you';
        self::assertEquals('you', $this->class->name);
    }

    public function testArray()
    {
        self::assertEqualsCanonicalizing(['name' => 'tegic', 'foo_bar' => 'name'], $this->class->toArray());
    }
}
