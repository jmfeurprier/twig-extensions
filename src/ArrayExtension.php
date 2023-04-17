<?php

namespace Jmf\TwigExtensions;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class ArrayExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter(
                'array_push',
                [
                    $this,
                    'arrayPush',
                ]
            ),
            new TwigFilter(
                'array_pop',
                [
                    $this,
                    'arrayPop',
                ]
            ),
            new TwigFilter(
                'array_set',
                [
                    $this,
                    'arraySet',
                ]
            ),
        ];
    }

    public function arrayPush(
        array $array,
        $item
    ): array {
        $array[] = $item;

        return $array;
    }

    public function arrayPop(
        array $array
    ): array {
        array_pop($array);

        return $array;
    }

    public function arraySet(
        array $array,
        $key,
        $value
    ): array {
        $array[$key] = $value;

        return $array;
    }

    public function arrayUnset(
        array $array,
        $key
    ): array {
        unset($array[$key]);

        return $array;
    }
}
