<?php

namespace perf\TwigExtensions;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class CurrencyExtension extends AbstractExtension
{
    private const DECIMALS_DEFAULT            = 2;
    private const DECIMAL_SEPARATOR_DEFAULT   = '.';
    private const THOUSANDS_SEPARATOR_DEFAULT = ' ';

    private int $decimals;

    private string $decimalSeparator;

    private string $thousandSeparator;

    public function __construct(
        int $decimals = self::DECIMALS_DEFAULT,
        string $decimalSeparator = self::DECIMAL_SEPARATOR_DEFAULT,
        string $thousandSeparator = self::THOUSANDS_SEPARATOR_DEFAULT
    ) {
        $this->decimals          = $decimals;
        $this->decimalSeparator  = $decimalSeparator;
        $this->thousandSeparator = $thousandSeparator;
    }

    /**
     * {@inheritDoc}
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter(
                'money_amount',
                [
                    $this,
                    'moneyAmount',
                ],
                [
                    'is_safe' => [
                        'html',
                    ],
                ]
            ),
        ];
    }

    public function moneyAmount(string $amount): string
    {
        return number_format($amount, $this->decimals, $this->decimalSeparator, $this->thousandSeparator);
    }
}
