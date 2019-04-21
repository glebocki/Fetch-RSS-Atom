<?php

declare(strict_types=1);

namespace Service;

use PHPUnit\Framework\TestCase;
use PrzemyslawGlebockiRekrutacjaHRtec\Service\HtmlTagsStripper;

/**
 * Class HtmlUrlStripperTest
 * @package Service
 * @covers \PrzemyslawGlebockiRekrutacjaHRtec\Service\HtmlTagsStripper
 */
class HtmlTagsStripperTest extends TestCase
{
    /**
     * @covers \PrzemyslawGlebockiRekrutacjaHRtec\Service\HtmlTagsStripper::strip
     */
    public function testStripHtmlTags()
    {
        $res = HtmlTagsStripper::strip('<p>Test paragraph.</p><!-- Comment --> <a href="#fragment">Other text</a>');
        self::assertEquals('Test paragraph. Other text', $res);
    }
}
