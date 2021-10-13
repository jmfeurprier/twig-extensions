<?php

namespace perf\TwigExtensions;

use DateTime;
use PHPUnit\Framework\TestCase;

class DateTimeExtensionTest extends TestCase
{
    public function testIntlFormat()
    {
        $extension = new DateTimeExtension();

        $dateTime = new DateTime('2021-10-11 12:34:56');
        $format   = 'cccc';

        $result = $extension->intlFormat($dateTime, $format, 'fr_CA.UTF-8');

        $this->assertSame('lundi', $result);
    }
}
