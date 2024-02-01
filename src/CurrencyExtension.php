<?php

namespace Jmf\TwigExtensions;

use Override;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class CurrencyExtension extends AbstractExtension
{
    public final const string PREFIX_DEFAULT = '';

    private const int    DECIMALS_DEFAULT            = 2;
    private const string DECIMAL_SEPARATOR_DEFAULT   = '.';
    private const string THOUSANDS_SEPARATOR_DEFAULT = ' ';

    public function __construct(
        private readonly int $decimals = self::DECIMALS_DEFAULT,
        private readonly string $decimalSeparator = self::DECIMAL_SEPARATOR_DEFAULT,
        private readonly string $thousandSeparator = self::THOUSANDS_SEPARATOR_DEFAULT,
        private readonly string $functionPrefix = self::PREFIX_DEFAULT,
    ) {
    }

    #[Override]
    public function getFilters(): iterable
    {
        return [
            new TwigFilter(
                "{$this->functionPrefix}money_amount",
                $this->moneyAmount(...),
                [
                    'is_safe' => [
                        'html',
                    ],
                ],
            ),
        ];
    }

    public function moneyAmount(float $amount): string
    {
        return number_format(
            $amount,
            $this->decimals,
            $this->decimalSeparator,
            $this->thousandSeparator,
        );
    }
}
