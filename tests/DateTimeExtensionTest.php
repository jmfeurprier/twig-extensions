<?php

namespace Jmf\TwigExtensions\Tests;

use DateTime;
use Jmf\TwigExtensions\DateTimeExtension;
use Override;
use PHPUnit\Framework\TestCase;

class DateTimeExtensionTest extends TestCase
{
    private DateTimeExtension $extension;

    #[Override]
    protected function setUp(): void
    {
        $this->extension = new DateTimeExtension();
    }

    public function testIntlFormat(): void
    {
        $dateTime = new DateTime('2021-10-11 12:34:56');
        $format   = 'cccc';

        $result = $this->extension->intlFormat($dateTime, $format, 'fr_CA.UTF-8');

        $this->assertSame('lundi', $result);
    }

    public function testMicrotimeReturnsString(): void
    {
        $result = $this->extension->microtime(false);

        $this->assertIsString($result);
    }

    public function testMicrotimeReturnsFloat(): void
    {
        $result = $this->extension->microtime(true);

        $this->assertIsFloat($result);
    }
}
