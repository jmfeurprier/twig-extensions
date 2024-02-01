<?php

namespace Jmf\TwigExtensions;

use Override;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class SortingExtension extends AbstractExtension
{
    public final const string PREFIX_DEFAULT = '';

    public function __construct(
        private readonly PropertyAccessorInterface $propertyAccessor,
        private readonly string $functionPrefix = self::PREFIX_DEFAULT,
    ) {
    }

    #[Override]
    public function getFilters(): iterable
    {
        return [
            new TwigFilter(
                "{$this->functionPrefix}ksort",
                $this->ksort(...),
            ),
            new TwigFilter(
                "{$this->functionPrefix}order_by",
                $this->orderBy(...),
            ),
            new TwigFilter(
                'order_by_reverse',
                $this->orderByReverse(...),
            ),
        ];
    }

    /**
     * @param array<int|string, mixed> $array
     *
     * @return array<int|string, mixed>
     */
    public function ksort(
        array $array,
    ): array {
        ksort($array);

        return $array;
    }

    /**
     * @param array<int|string, array<string, mixed>|object> $array
     *
     * @return array<int|string, array<string, mixed>|object>
     */
    public function orderByReverse(
        array $array,
        string $property
    ): array {
        return array_reverse($this->orderBy($array, $property), true);
    }

    /**
     * @param array<int|string, array<string, mixed>|object> $array
     *
     * @return array<int|string, array<string, mixed>|object>
     */
    public function orderBy(
        array $array,
        string $property
    ): array {
        $properties = [];

        foreach ($array as $key => $listItem) {
            $properties[$key] = $this->propertyAccessor->getValue($listItem, $property);
        }

        asort($properties);

        $ordered = [];

        foreach (array_keys($properties) as $key) {
            $ordered[$key] = $array[$key];
        }

        return $ordered;
    }
}
