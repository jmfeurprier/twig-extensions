<?php

namespace perf\TwigExtensions;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigTest;

class TypeExtension extends AbstractExtension
{
    /**
     * {@inheritDoc}
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter(
                'gettype',
                'gettype'
            ),
            new TwigFilter(
                'get_class',
                'get_class'
            ),
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getTests(): array
    {
        return [
            new TwigTest(
                'array',
                'is_array'
            ),
            new TwigTest(
                'bool',
                'is_bool'
            ),
            new TwigTest(
                'float',
                'is_float'
            ),
            new TwigTest(
                'int',
                'is_int'
            ),
            new TwigTest(
                'iterable',
                'is_iterable'
            ),
            new TwigTest(
                'numeric',
                'is_numeric'
            ),
            new TwigTest(
                'object',
                'is_object'
            ),
            new TwigTest(
                'scalar',
                'is_scalar'
            ),
            new TwigTest(
                'string',
                'is_string'
            ),
        ];
    }
}
