<?php

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

// Container Initialization
$builder = new ContainerBuilder;
$container = $builder->build();

// Application Initialization
AppFactory::setContainer($container);
$app = AppFactory::create();

// Route Parser
$routeParser = $app->getRouteCollector()->getRouteParser();

// Response Factory for middlewares
$responseFactory = $app->getResponseFactory();