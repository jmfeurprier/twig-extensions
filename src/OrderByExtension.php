<?php

namespace perf\TwigExtensions;

use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class OrderByExtension extends AbstractExtension
{
    private PropertyAccessorInterface $propertyAccessor;

    public function __construct(PropertyAccessorInterface $propertyAccessor)
    {
        $this->propertyAccessor = $propertyAccessor;
    }

    public function getFilters()
    {
        return [
            new TwigFilter(
                'order_by',
                [
                    $this,
                    'orderBy',
                ]
            ),
            new TwigFilter(
                'order_by_reverse',
                [
                    $this,
                    'orderByReverse',
                ]
            ),
        ];
    }

    public function orderByReverse(
        iterable $list,
        string $property
    ): array {
        return array_reverse($this->orderBy($list, $property));
    }

    public function orderBy(
        iterable $list,
        string $property
    ): array {
        $properties = [];

        foreach ($list as $key => $listItem) {
            $properties[$key] = $this->propertyAccessor->getValue($listItem, $property);
        }

        asort($properties);

        $sortedList = [];

        foreach (array_keys($properties) as $key) {
            $sortedList[$key] = $list[$key];
        }

        return $sortedList;
    }
}
