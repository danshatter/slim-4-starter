<?php

use Slim\Routing\RouteCollectorProxy as Group;
use Slim\Middleware\BodyParsingMiddleware;

$app->group('/api', function(Group $group) {

	
})->add(BodyParsingMiddleware::class);