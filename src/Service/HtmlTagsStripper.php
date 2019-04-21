<?php

declare(strict_types=1);

namespace PrzemyslawGlebockiRekrutacjaHRtec\Service;

class HtmlTagsStripper
{
    public static function strip($string): string
    {
        return strip_tags($string);
    }
}
