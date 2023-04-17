<?php

namespace Jmf\TwigExtensions\Tests;

use Jmf\TwigExtensions\ArrayExtension;
use PHPUnit\Framework\TestCase;

class ArrayExtensionTest extends TestCase
{
    public function testArrayPushWithEmptyArray(): void
    {
        $arrayExtension = new ArrayExtension();

        $oldArray = [];
        $item     = 'foo';

        $result = $arrayExtension->arrayPush($oldArray, $item);

        $this->assertSame([$item], $result);
    }

    public function testArrayPushWithNonEmptyArray(): void
    {
        $arrayExtension = new ArrayExtension();

        $oldArray = ['foo'];
        $item     = 'bar';

        $result = $arrayExtension->arrayPush($oldArray, $item);

        $this->assertSame(
            [
                'foo',
                $item,
            ],
            $result
        );
    }

    public function testArrayPopWithNonEmptyArray(): void
    {
        $arrayExtension = new ArrayExtension();

        $oldArray =
            [
                'foo',
                'bar',
            ];

        $result = $arrayExtension->arrayPop($oldArray);

        $this->assertSame(['foo'], $result);
    }

    public function testArraySetWithEmptyArray(): void
    {
        $arrayExtension = new ArrayExtension();

        $oldArray = [];
        $key      = 'foo';
        $value    = 'bar';

        $result = $arrayExtension->arraySet($oldArray, $key, $value);

        $this->assertSame([$key => $value], $result);
    }

    public function testArraySetWithNonEmptyArray(): void
    {
        $arrayExtension = new ArrayExtension();

        $oldArray = ['foo' => 'bar'];
        $key      = 'baz';
        $value    = 'qux';

        $result = $arrayExtension->arraySet($oldArray, $key, $value);

        $this->assertSame(['foo' => 'bar', $key => $value], $result);
    }

    public function testArrayUnsetWithNonEmptyArray(): void
    {
        $arrayExtension = new ArrayExtension();

        $key      = 'foo';
        $oldArray = [$key => 'bar'];

        $result = $arrayExtension->arrayUnset($oldArray, $key);

        $this->assertSame([], $result);
    }
}
