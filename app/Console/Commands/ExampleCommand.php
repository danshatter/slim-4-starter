<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Slim\Console\Command\AbstractCommand;

class ExampleCommand extends AbstractCommand
{

	protected static $defaultName = 'example:name';
	protected static $defaultDescription = 'This will run own user defined code';
	
	/**
	 * SUCCESS - 0
	 * FAILURE - 1
	 * INVALID - 2
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeln('Example Command ran from here');

		return static::SUCCESS;
	}

}