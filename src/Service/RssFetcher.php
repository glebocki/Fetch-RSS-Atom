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
    /**
     * Fetches RSS/Atom data and saves it in file provided in $path.
     * Old data in path.csv are overwritten.
     *
     * @param string $url RSS/Atom feed url
     * @param string $path Output csv file
     * @throws CannotInsertRecord
     */
    public function simple($url, $path)
    {
        $rssFeed = $this->importRssFeed($url);
        $items = $this->getItems($rssFeed);

        // TODO: adjust path for output file
        $csv = Writer::createFromPath('../' . $path . '.csv', 'w+');
        $csv->insertOne(['title', 'description', 'link', 'pubDate', 'creator']);
        $csv->insertAll($items);
    }

    /**
     * Fetches RSS/Atom data and saves it in file provided in $path.
     * Old data in path.csv are appended.
     *
     * @param string $url RSS/Atom feed url
     * @param string $path Output csv file
     * @throws CannotInsertRecord
     */
    public function extended($url, $path)
    {
        // TODO: implement me!
    }

    /**
     * @param $url
     * @return FeedInterface
     */
    private function importRssFeed($url): FeedInterface
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
     * @param FeedInterface $rssFeed
     * @return array
     */
    private function getItems(FeedInterface $rssFeed): array
    {
        $dateFormatter = new DateFormatter();
        $items = [];
        foreach ($rssFeed as $item) {
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
