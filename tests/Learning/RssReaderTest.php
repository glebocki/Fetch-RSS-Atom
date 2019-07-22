<?php

declare(strict_types=1);

namespace Learning;

use PHPUnit\Framework\TestCase;
use Zend\Feed\Reader\Exception\RuntimeException;
use Zend\Feed\Reader\Reader;
use Zend\Feed\Reader\Feed\FeedInterface;

class RssReaderTest extends TestCase
{
    /**
     * @test
     */
    public function importFeedFromWeb()
    {
        self::markTestSkipped("Reader::import() Works with internet only!");
        $rssFeed = Reader::import("http://feeds.nationalgeographic.com/ng/News/News_Main");
        self::assertInstanceOf(FeedInterface::class, $rssFeed);
    }

    /**
     * @test
     */
    public function ReaderImportFromLocalResource()
    {
        $rssFeed = Reader::importFile('./resources/rss-nat-geo.xml');
        self::assertInstanceOf(FeedInterface::class, $rssFeed);
    }

    /**
     * @test
     */
    public function ReaderImportFromNotExistingFile()
    {
        $this->expectException(RuntimeException::class);
        $rssFeed = Reader::importFile('./resource/not-existing-rss.xml');
    }

    /**
     * @test
     * @doesNotPerformAssertions
     */
    public function ExtractInformationFromFeed()
    {
        $feed = Reader::importFile('./resources/rss-nat-geo.xml');
        $data = [
            'title' => $feed->getTitle(),
            'link' => $feed->getLink(),
            'dateModified' => $feed->getDateModified(),
            'description' => $feed->getDescription(),
            'language' => $feed->getLanguage(),
            'entries' => [],
        ];

        foreach ($feed as $entry) {
            $edata = [
                'title' => $entry->getTitle(),
                'description' => $entry->getDescription(),
                'dateModified' => $entry->getDateModified(),
                'authors' => $entry->getAuthors(),
                'link' => $entry->getLink(),
                'content' => $entry->getContent(),
            ];
            $data['entries'][] = $edata;
        }
    }
}
