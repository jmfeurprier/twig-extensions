<?php

namespace perf\TwigExtensions;

use PHPUnit\Framework\TestCase;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class OrderByExtensionTest extends TestCase
{
    private OrderByExtension $extension;

    protected function setUp(): void
    {
        $this->extension = new OrderByExtension(
            new PropertyAccessor()
        );
    }

    public function testOrderByWithEmptyCollection(): void
    {
        $collection = [];

        $result = $this->extension->orderBy($collection, 'foo');

        $this->assertSame([], $result);
    }

    public function testOrderByWithCollectionOfArrays(): void
    {
        $collection = [
            $this->createArray('foo', 234),
            $this->createArray('foo', 345),
            $this->createArray('foo', 123),
        ];

        $result = $this->extension->orderBy($collection, '[foo]');

        $this->assertSame(
            [
                2 => $this->createArray('foo', 123),
                0 => $this->createArray('foo', 234),
                1 => $this->createArray('foo', 345),
            ],
            $result
        );
    }

    public function testOrderByWithCollectionOfObjects(): void
    {
        $collection = [
            $this->createObject('foo', 234),
            $this->createObject('foo', 345),
            $this->createObject('foo', 123),
        ];

        $result = $this->extension->orderBy($collection, 'foo');

        $this->assertEquals(
            [
                2 => $this->createObject('foo', 123),
                0 => $this->createObject('foo', 234),
                1 => $this->createObject('foo', 345),
            ],
            $result
        );
    }

    public function testOrderByReverseWithEmptyCollection(): void
    {
        $collection = [];

        $result = $this->extension->orderByReverse($collection, 'foo');

        $this->assertSame([], $result);
    }

    public function testOrderByReverseWithCollectionOfArrays(): void
    {
        $collection = [
            $this->createArray('foo', 234),
            $this->createArray('foo', 345),
            $this->createArray('foo', 123),
        ];

        $result = $this->extension->orderByReverse($collection, '[foo]');

        $this->assertSame(
            [
                1 => $this->createArray('foo', 345),
                0 => $this->createArray('foo', 234),
                2 => $this->createArray('foo', 123),
            ],
            $result
        );
    }

    public function testOrderByReverseWithCollectionOfObjects(): void
    {
        $collection = [
            $this->createObject('foo', 234),
            $this->createObject('foo', 345),
            $this->createObject('foo', 123),
        ];

        $result = $this->extension->orderByReverse($collection, 'foo');

        $this->assertEquals(
            [
                1 => $this->createObject('foo', 345),
                0 => $this->createObject('foo', 234),
                2 => $this->createObject('foo', 123),
            ],
            $result
        );
    }

    /**
     * @param mixed $value
     */
    private function createObject(
        string $property,
        $value
    ): object {
        return (object) $this->createArray($property, $value);
    }

    /**
     * @param mixed $value
     */
    private function createArray(
        string $property,
        $value
    ): array {
        return [
            $property => $value,
        ];
    }
}
