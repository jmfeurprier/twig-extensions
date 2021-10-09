<?php

namespace perf\TwigExtensions;

use DateTime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class DateTimeExtension extends AbstractExtension
{
    private string $locale;

    public function __construct(string $locale)
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
                'strftime',
                function (
                    $value,
                    string $format
                ) {
                    if ($value instanceof DateTime) {
                        $value = $value->getTimestamp();
                    }

                    $oldLocale = setlocale(LC_TIME, 0);

                    setlocale(LC_TIME, $this->locale);

                    $return = strftime($format, $value);

                    setlocale(LC_TIME, $oldLocale);

                    return $return;
                }
            ),
        ];
    }
}
