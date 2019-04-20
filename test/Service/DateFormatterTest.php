<?php

declare(strict_types=1);

namespace Service;

use DateTime;
use PHPUnit\Framework\TestCase;
use PrzemyslawGlebockiRekrutacjaHRtec\Service\DateFormatter;

class DateFormatterTest extends TestCase
{

    public function testFormat()
    {
        $dateFormatter = new DateFormatter();
        $date = $dateFormatter->format(new DateTime('16-10-2018T15:31:33'));
        self::assertEquals($date, '16 października 2018 15:31:33');
    }
}
