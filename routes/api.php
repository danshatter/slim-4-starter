<?php

use Slim\Routing\RouteCollectorProxy as Group;
use Slim\Middleware\BodyParsingMiddleware;
// use App\Preflight\Flight;

// For CORS Preflight
// $app->options('/{routes:.+}', Flight::class);

$app->group('/api', function(Group $group) {

	
})->add(BodyParsingMiddleware::class);