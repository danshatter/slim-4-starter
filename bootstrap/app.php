<?php

session_start();

require_once __DIR__.'/../vendor/autoload.php';

require_once __DIR__.'/../config/env.php';

if ($_ENV['APP_ENV'] === 'production') {
    ini_set('display_errors', '0');
}

// The Slim Application Initialization and Application Extracts
require_once __DIR__.'/../config/app.php';

// Container Dependencies
require_once __DIR__.'/../config/container.php';

// Database Initialization
require_once __DIR__.'/../config/database.php';

// Global Middleware Stack
require_once __DIR__.'/../config/middleware.php';

// Web Routes
require_once __DIR__.'/../routes/web.php';