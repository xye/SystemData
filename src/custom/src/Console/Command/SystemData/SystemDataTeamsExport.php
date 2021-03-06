<?php

// Enrico Simonetti
// 2017-01-13

namespace Sugarcrm\Sugarcrm\custom\Console\Command\SystemData;

use Sugarcrm\Sugarcrm\Console\CommandRegistry\Mode\InstanceModeInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class SystemDataTeamsExport extends Command implements InstanceModeInterface {

    // get common code
    protected function data() {
        return new SystemDataTeams();
    }

    protected function configure() {
        $this
            ->setName('systemdata:export:teams')
            ->setDescription('Export Teams into JSON data file')
            ->addArgument(
                'path',
                InputArgument::REQUIRED,
                'Destination path for the JSON data file'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $path = $input->getArgument('path');
        $data = $this->data()->getTeams();
        $file = $this->data()->checkPath($path).'teams.json';
        $this->data()->putData($file, $data);
        $output->writeln(count($data).' Team(s) exported into '.$file);
    }
}
