<?php

use Dotenv\Dotenv;

// Environmental Variables Initialization
$dotenv = Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();
$dotenv->required('APP_ENV')->allowedValues(['development', 'production']);