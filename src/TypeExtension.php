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
                function ($value) {
                    return gettype($value);
                }
            ),
            new TwigFilter(
                'get_class',
                function ($value) {
                    return get_class($value);
                }
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
                function ($value) {
                    return is_array($value);
                }
            ),
            new TwigTest(
                'bool',
                function ($value) {
                    return is_scalar($value);
                }
            ),
            new TwigTest(
                'float',
                function ($value) {
                    return is_float($value);
                }
            ),
            new TwigTest(
                'int',
                function ($value) {
                    return is_int($value);
                }
            ),
            new TwigTest(
                'object',
                function ($value) {
                    return is_object($value);
                }
            ),
            new TwigTest(
                'scalar',
                function ($value) {
                    return is_scalar($value);
                }
            ),
            new TwigTest(
                'string',
                function ($value) {
                    return is_string($value);
                }
            ),
        ];
    }
}
