<?php

use Slim\Routing\RouteCollectorProxy as Group;
use Slim\Middleware\BodyParsingMiddleware;
// use Slim\Csrf\Guard;
use App\Controllers\{ViewController, UserController};
use App\Middlewares\{UnauthenticatedOnlyMiddleware, LoggedInOnlyMiddleware, AuthenticationMiddleware};
// use App\Preflight\Flight;

// For CORS Preflight
// $app->options('/{routes:.*}', Flight::class);


// Routes Accessible Whether Authenticated or Not
$app->group('', function(Group $group) {
    
    $group->get('/', ViewController::class.':index')->setName('home');

})->add(AuthenticationMiddleware::class);
// ->add(Guard::class);
// End of Routes Accessible Whether Authenticated or Not


// Routes Inaccessible When Logged In (e.g Login and Register)
$app->group('', function (Group $group) {


})->add(UnauthenticatedOnlyMiddleware::class)
->add(AuthenticationMiddleware::class);
// ->add(Guard::class);
// End of Routes Inaccessible When Logged In


//Routes Accessible Only When a User is Logged In (e.g Logout)
$app->group('', function(Group $group) {
    

})->add(LoggedInOnlyMiddleware::class)
->add(AuthenticationMiddleware::class);
// ->add(Guard::class);
//Routes Accessible Only When a User is Logged In


// For API Routes
$app->group('/api', function(Group $group) {

	
})->add(BodyParsingMiddleware::class);