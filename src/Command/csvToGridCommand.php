<?php

// src/Command/appCommand.php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use App\Services\csvToArrayClass;
use App\Services\formatCsvClass;
use App\Services\csvToJsonClass;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableSeparator;

class csvToGridCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'csvToGrid';

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function configure(): void
    {
        $this
            // configure an argument
            ->addArgument('path', InputArgument::REQUIRED, 'The path to the CSV file')
            ->addArgument('json', InputArgument::REQUIRED, 'translate in json or not')
            // ...
        ;
    }
    /**
     * Undocumented function
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return integer
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var Object */
        $arrayCsvObject = new csvToArrayClass();
        /** @var Object */
        $formatCsvObject = new formatCsvClass();
        /** @var array */
        $csv = $arrayCsvObject->arrayCsv($input->getArgument("path"));
        $csv = $formatCsvObject->formatCsv($csv);

        if ($input->getArgument("json") == "json") { // if second argument is "json"
            /** @var Object */
            $csvToJsonObject = new csvToJsonClass();
            $jsonResult = $csvToJsonObject->csvToJson($csv);
            print($jsonResult);
        } else { // if second argument is not "json"
            /** @var Object */
            $table = new Table($output);
            /** @var array */
            $arrayRows = [];
            for ($i = 1; $i < count($csv); $i++) {
                array_push($arrayRows, $csv[$i]);
            }
            $table->setHeaders($csv[0])
                ->setRows($arrayRows);
            $table->render();
        }

        return 0;
    }
}
