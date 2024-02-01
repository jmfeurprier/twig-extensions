<?php

namespace Jmf\TwigExtensions;

use Override;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class ArrayExtension extends AbstractExtension
{
    public final const string PREFIX_DEFAULT = '';

    public function __construct(
        private readonly string $functionPrefix = self::PREFIX_DEFAULT,
    ) {
    }

    #[Override]
    public function getFilters(): iterable
    {
        return [
            new TwigFilter(
                "{$this->functionPrefix}array_push",
                $this->arrayPush(...),
            ),
            new TwigFilter(
                "{$this->functionPrefix}array_pop",
                $this->arrayPop(...),
            ),
            new TwigFilter(
                "{$this->functionPrefix}array_unshift",
                $this->arrayUnshift(...),
            ),
            new TwigFilter(
                "{$this->functionPrefix}array_shift",
                $this->arrayShift(...),
            ),
            new TwigFilter(
                "{$this->functionPrefix}array_set",
                $this->arraySet(...),
            ),
            new TwigFilter(
                "{$this->functionPrefix}array_unset",
                $this->arrayUnset(...),
            ),
        ];
    }

    /**
     * @param array<int|string, mixed> $array
     *
     * @return array<int|string, mixed>
     */
    public function arrayPush(
        array $array,
        mixed $item,
    ): array {
        $array[] = $item;

        return $array;
    }

    /**
     * @param array<int|string, mixed> $array
     *
     * @return array<int|string, mixed>
     */
    public function arrayPop(
        array $array,
    ): array {
        array_pop($array);

        return $array;
    }

    /**
     * @param array<int|string, mixed> $array
     *
     * @return array<int|string, mixed>
     */
    public function arrayUnshift(
        array $array,
        mixed $item,
    ): array {
        array_unshift($array, $item);

        return $array;
    }

    /**
     * @param array<int|string, mixed> $array
     *
     * @return array<int|string, mixed>
     */
    public function arrayShift(
        array $array,
    ): array {
        array_shift($array);

        return $array;
    }

    /**
     * @param array<int|string, mixed> $array
     *
     * @return array<int|string, mixed>
     */
    public function arraySet(
        array $array,
        int | string $key,
        mixed $value,
    ): array {
        $array[$key] = $value;

        return $array;
    }

    /**
     * @param array<int|string, mixed> $array
     *
     * @return array<int|string, mixed>
     */
    public function arrayUnset(
        array $array,
        int | string $key,
    ): array {
        unset($array[$key]);

        return $array;
    }
}
