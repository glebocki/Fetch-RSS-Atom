<?php
declare(strict_types=1);

namespace PrzemyslawGlebockiRekrutacjaHRtec\Service;

use DateTime;
use IntlDateFormatter;

class DateFormatter
{
    private $intlDateFormatter;

    public function __construct(string $locale = 'pl_PL')
    {
        $this->intlDateFormatter = new IntlDateFormatter(
            $locale,
            IntlDateFormatter::LONG,
            IntlDateFormatter::MEDIUM
        );
    }

    public function format(DateTime $dateTime) : string
    {
        return $this->intlDateFormatter->format($dateTime);
    }
}
