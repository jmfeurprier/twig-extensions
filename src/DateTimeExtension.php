<?php

namespace perf\TwigExtensions;

use DateTimeInterface;
use IntlCalendar;
use IntlDateFormatter;
use perf\TwigExtensions\Exception\DateTimeExtensionException;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class DateTimeExtension extends AbstractExtension
{
    private ?string $locale;

    public function __construct(?string $locale = null)
    {
        $this->locale = $locale;
    }

    /**
     * {@inheritDoc}
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter(
                'intl_format',
                [
                    $this,
                    'intlFormat',
                ]
            ),
        ];
    }

    /**
     * @param IntlCalendar|DateTimeInterface $value
     *
     * @throws DateTimeExtensionException
     */
    public function intlFormat($value, ?string $format = null, ?string $locale = null): string
    {
        $this->assertIntlPhpExtensionInstalled();

        if (!($value instanceof IntlCalendar) && !($value instanceof DateTimeInterface)) {
            throw new DateTimeExtensionException('Invalid parameter provided.');
        }

        $locale = $locale ?? $this->locale;
        $result = IntlDateFormatter::formatObject($value, $format, $locale);

        if (false === $result) {
            throw new DateTimeExtensionException('Failed to format date and time.');
        }

        return $result;
    }

    /**
     * @throws DateTimeExtensionException
     */
    private function assertIntlPhpExtensionInstalled(): void
    {
        if (!class_exists(IntlCalendar::class)) {
            throw new DateTimeExtensionException('PHP intl extension must be installed.');
        }
    }
}
