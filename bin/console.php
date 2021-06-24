<?php

require_once __DIR__.'/../vendor/autoload.php';

use Slim\Console\Config\ConfigResolver;
use Slim\Console\App as ConsoleApplication;
use App\Console\Commands\{ExampleCommand};

// Environmental variables are good to go
require_once __DIR__.'/../config/env.php';

// Dear old slim 4 initialization
require_once __DIR__.'/../config/app.php';

// For our good old dependencies
require_once __DIR__.'/../config/container.php';

// Database is included here just in case we want to interact with the database in our console
require_once __DIR__.'/../config/database.php';

$consoleApp = new ConsoleApplication((new ConfigResolver)->resolve());

$consoleApp->addCommands([
	new ExampleCommand
]);

$consoleApp->run();