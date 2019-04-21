<?php

declare(strict_types=1);

namespace PrzemyslawGlebockiRekrutacjaHRtec\Command;

use PrzemyslawGlebockiRekrutacjaHRtec\Service\RssFetcher;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CsvExtendedCommand extends Command
{
    protected static $defaultName = 'csv:extended';

    protected function configure()
    {
        $this
            ->setDescription('Fetches RSS/Atom data from URL and appends it to PATH.csv file.')
            ->setHelp('Fetches RSS/Atom feed from URL and appends it to PATH.csv file. Data in PATH.csv file is appended')
            ->addArgument('URL', InputArgument::REQUIRED, 'RSS/Atom Feed URL')
            ->addArgument('PATH', InputArgument::REQUIRED, 'Path to CSV file')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fetcher = new RssFetcher();
        $fetcher->extended(
            $input->getArgument('URL'),
            $input->getArgument('PATH')
        );
        $output->writeln("RSS Feed from " . $input->getArgument('URL') . ' has been written to ' . $input->getArgument('PATH'));
    }
}
