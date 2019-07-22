<?php

declare(strict_types=1);

namespace PrzemyslawGlebockiRekrutacjaHRtec\Service;

use League\Csv\CannotInsertRecord;
use League\Csv\Writer;
use Zend\Feed\Reader\Exception\RuntimeException;
use Zend\Feed\Reader\Feed\FeedInterface;
use Zend\Feed\Reader\Reader;

class RssFetcher
{
    /** @var FeedInterface */
    private $feed;

    /**
     * Fetches RSS/Atom data and saves it in file provided in $path.
     * Old data in path.csv are overwritten.
     *
     * @param string $url RSS/Atom feed url
     * @param string $path Output csv file
     */
    public function simple(string $url, string $path): void
    {
        self::fetch($url, $path);
    }

    /**
     * Fetches RSS/Atom data and saves it in file provided in $path.
     * New data is appended at the end of file.
     *
     * @param string $url RSS/Atom feed url
     * @param string $path Output csv file
     */
    public function extended(string $url, string $path): void
    {
        self::fetch($url, $path, true);
    }

    private function fetch(string $url, string $path, bool $append = false): void
    {
        $this->feed = $this->importRssFeed($url);

        if ($append) {
            $csv = Writer::createFromPath('../' . $path . '.csv', 'a+');
        } else {
            $csv = Writer::createFromPath('../' . $path . '.csv', 'w+');
        }
        try {
            if (empty($csv->getContent())) {
                $csv->insertOne($this->getCsvHeader());
            }
            $csv->insertAll($this->getItems());
        } catch (CannotInsertRecord $e) {
            echo "Exception caught writing feed to file: {$e->getMessage()}\n";
            exit;
        }
    }

    /**
     * @param $url
     * @return FeedInterface
     */
    private function importRssFeed(string $url): FeedInterface
    {
        try {
            $rssFeed = Reader::import($url);
        } catch (RuntimeException $e) {
            echo "Exception caught importing feed: {$e->getMessage()}\n";
            exit;
        }
        return $rssFeed;
    }

    /**
     * Returns field names in CSV file
     *
     * @return array
     */
    private function getCsvHeader(): array
    {
        return ['title', 'description', 'link', 'pubDate', 'creator'];
    }

    /**
     * Returns RSS items for saving
     *
     * @return array
     */
    private function getItems(): array
    {
        $dateFormatter = new DateFormatter();
        $items = [];
        /** @var FeedInterface $item */
        foreach ($this->feed as $item) {
            $items[] = [
                'title' => $item->getTitle(),
                'description' => HtmlTagsStripper::strip($item->getDescription()),
                'link' => $item->getLink(),
                'pubDate' => $dateFormatter->format($item->getDateModified()),
                'creator' => $item->getAuthor()['name'],
            ];
        }
        return $items;
    }
}
