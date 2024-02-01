<?php

namespace Jmf\TwigExtensions;

use DateTimeInterface;
use IntlCalendar;
use IntlDateFormatter;
use Jmf\TwigExtensions\Exception\DateTimeExtensionException;
use Override;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class DateTimeExtension extends AbstractExtension
{
    public final const string PREFIX_DEFAULT = '';

    public function __construct(
        private readonly ?string $locale = null,
        private readonly string $functionPrefix = self::PREFIX_DEFAULT,
    ) {
    }

    #[Override]
    public function getFilters(): iterable
    {
        return [
            new TwigFilter(
                "{$this->functionPrefix}intl_format",
                $this->intlFormat(...),
            ),
        ];
    }

    #[Override]
    public function getFunctions(): iterable
    {
        return [
            new TwigFunction(
                "{$this->functionPrefix}microtime",
                $this->microtime(...),
            ),
        ];
    }

    /**
     * @throws DateTimeExtensionException
     */
    public function intlFormat(
        IntlCalendar | DateTimeInterface $value,
        ?string $format = null,
        ?string $locale = null
    ): string {
        $this->assertIntlPhpExtensionInstalled();

        $locale ??= $this->locale;
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

    /**
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function microtime(bool $asFloat = false): string | float
    {
        return microtime($asFloat);
    }
}
