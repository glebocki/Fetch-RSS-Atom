#!/usr/bin/env php
<?php

declare(strict_types=1);

namespace PrzemyslawGlebockiRekrutacjaHRtec;

require __DIR__ . '/../vendor/autoload.php';

use PrzemyslawGlebockiRekrutacjaHRtec\Command\CsvExtendedCommand;
use PrzemyslawGlebockiRekrutacjaHRtec\Command\CsvSimpleCommand;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new CsvSimpleCommand());
$application->add(new CsvExtendedCommand());

$application->run();
