<?php

use Slim\Routing\RouteCollectorProxy as Group;
// use Slim\Csrf\Guard;
use App\Controllers\{ViewController, UserController};
use App\Middlewares\{UnauthenticatedOnlyMiddleware, LoggedInOnlyMiddleware, AuthenticationMiddleware};

// Routes Accessible Whether Authenticated or Not
$app->group('', function(Group $group) {
    // $group->get('/', ViewController::class.':index')->setName('home');

})->add(AuthenticationMiddleware::class);
// ->add(Guard::class);
// End of Routes Accessible Whether Authenticated or Not


// Routes Inaccessible When Logged In
$app->group('', function (Group $group) {
    // $group->get('/register', ViewController::class.':register')->setName('register');

    // $group->get('/login', ViewController::class.':login')->setName('login');

})->add(UnauthenticatedOnlyMiddleware::class)
->add(AuthenticationMiddleware::class);
// ->add(Guard::class);
// End of Routes Inaccessible When Logged In


//Routes Accessible Only When a User is Logged In
$app->group('', function(Group $group) {
    
    // $group->post('/logout', UserController::class.':logout')->setName('logout');

})->add(LoggedInOnlyMiddleware::class)
->add(AuthenticationMiddleware::class);
// ->add(Guard::class);
//Routes Accessible Only When a User is Logged In