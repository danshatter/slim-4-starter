<?php

use Psr\Log\LoggerInterface;
use Slim\Views\{TwigMiddleware, Twig};
use Slim\Middleware\MethodOverrideMiddleware;
use App\Error\HtmlErrorRenderer;
use App\Middlewares\TwigMiddleware as CustomTwigMiddleware;

// Custom Twig Middleware
$app->add(CustomTwigMiddleware::class);

// Twig Middleware
$app->add(TwigMiddleware::createFromContainer($app, Twig::class));

// Routing Middleware
$app->addRoutingMiddleware();

// Method Override Middleware
$app->add(MethodOverrideMiddleware::class);

// Error Middleware
$errorMiddleware = $app->addErrorMiddleware(true, true, true, $container->get(LoggerInterface::class));

if ($_ENV['APP_ENV'] === 'production') {
    $errorMiddleware->getDefaultErrorHandler()->registerErrorRenderer('text/html', HtmlErrorRenderer::class);
}