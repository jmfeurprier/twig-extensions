<?php

namespace Jmf\TwigExtensions\Tests;

use Jmf\TwigExtensions\CurrencyExtension;
use PHPUnit\Framework\TestCase;

class CurrencyExtensionTest extends TestCase
{
    public function testDefaultFormatting(): void
    {
        $currencyExtension = new CurrencyExtension();

        $result = $currencyExtension->moneyAmount('1234.56');

        $this->assertSame('1 234.56', $result);
    }

    public function testSpecificFormatting(): void
    {
        $currencyExtension = new CurrencyExtension(
            3,
            ',',
            '.'
        );

        $result = $currencyExtension->moneyAmount('1234.56');

        $this->assertSame('1.234,560', $result);
    }
}
