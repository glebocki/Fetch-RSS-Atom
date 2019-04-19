<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PrzemyslawGlebockiRekrutacjaHRtec\SkeletonClass;

class SkeletonClassTest extends TestCase
{
    /**
     * Test that true does in fact equal true
     */
    public function testEchoPhrase()
    {
        $myObj = new SkeletonClass();

        $res = $myObj->echoPhrase('foo');
        $this->assertEquals($res, 'foo');
    }
}
