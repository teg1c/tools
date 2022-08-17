<?php

namespace Tegic\Tools\Tests\Traits;

use PHPUnit\Framework\TestCase;
use Tegic\Tools\Tests\Stubs\TraitStub;

class SerializableTest extends TestCase
{
    protected $class;

    protected function setUp(): void
    {
        $this->class = new TraitStub();
    }

    public function testSerializeFunction()
    {
        self::assertStringContainsString('tegic', serialize($this->class));
        self::assertEquals('tegic', unserialize(serialize($this->class))->getName());
    }

    public function testUnserializeArray()
    {
        $traitStub = $this->class->unserializeArray(['name' => 'tegic-a']);

        self::assertInstanceOf(TraitStub::class, $traitStub);
        self::assertEquals('tegic-a', $traitStub->getName());
    }
}
