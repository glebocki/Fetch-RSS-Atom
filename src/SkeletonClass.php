<?php

declare(strict_types=1);

namespace PrzemyslawGlebockiRekrutacjaHRtec;

class SkeletonClass
{
    /**
     * Create a new Skeleton instance
     */
    public function __construct()
    {
    }

    /**
     * Friendly welcome
     *
     * @param string $phrase Phrase to return
     * @return string Returns the phrase passed in
     */
    public function echoPhrase($phrase)
    {
        return $phrase;
    }
}