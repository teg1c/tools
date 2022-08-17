<?php

namespace Tegic\Tools\Tests;

use PHPUnit\Framework\TestCase;
use Tegic\Tools\Collection;

class CollectionTest extends TestCase
{
    /**
     * data.
     *
     * @var array
     */
    protected $data = [];

    /**
     * collection.
     *
     * @var Collection
     */
    protected $collection;

    protected function setUp(): void
    {
        $this->data = [
            'name' => 'tegic',
            'age' => 26,
            'sex' => 1,
            'language' => [
                'php',
                'java',
                'rust',
            ],
        ];
        $this->collection = new Collection($this->data);
    }

    public function testToString()
    {
        $json = json_encode($this->data);

        self::assertEquals($json, $this->collection->toJson());
        self::assertEquals($json, $this->collection->__toString());
    }

    public function testMagicGet()
    {
        self::assertEquals('tegic', $this->collection->name);
        self::assertEqualsCanonicalizing(['php', 'java', 'rust'], $this->collection->language);
    }

    public function testMagicSet()
    {
        $this->collection->fuck = 'ok';
        $this->collection->foo = ['bar', 'fuck'];

        self::assertEquals('ok', $this->collection->get('fuck'));
        self::assertEquals(['bar', 'fuck'], $this->collection->get('foo'));
    }

    public function testIsset()
    {
        self::assertTrue(isset($this->collection['name']));
        self::assertFalse(isset($this->collection['notExistKey']));
    }

    public function testUnset()
    {
        unset($this->collection['name']);

        self::assertFalse(isset($this->collection['name']));
    }

    public function testAll()
    {
        self::assertEquals($this->data, $this->collection->all());
    }

    public function testOnly()
    {
        self::assertEquals([
            'name' => 'tegic',
        ], $this->collection->only(['name']));
    }

    public function testExcept()
    {
        self::assertEquals([
            'name' => 'tegic',
            'age' => 26,
            'sex' => 1,
        ], $this->collection->except('language')->all());
    }

    public function testMerge()
    {
        $merge = ['haha' => 'enen'];

        self::assertEqualsCanonicalizing(array_merge($this->data, $merge), $this->collection->merge($merge)->all());
    }
}
