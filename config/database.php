<?php

use Psr\Http\Message\{ServerRequestInterface as Request, ResponseInterface as Response};
use Illuminate\Database\Capsule\Manager;

$capsule = new Manager;
$capsule->addConnection($container->get('settings')['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

// DATABASE TABLE CREATION
$app->get('/migrate', function(Request $request, Response $response) {
    Manager::schema()->create('users', function($table) {
        $table->id();
        $table->string('first_name');
        $table->string('last_name');
        $table->string('email')->unique();
        $table->string('password');
        $table->timestamps();
    });

    echo 'database tables created';

    return $response;
});



// DATABASE TABLE DROPPER 
$app->get('/unmigrate', function(Request $request, Response $response) {
    Manager::schema()->dropIfExists('users');

    echo 'all database tables dropped';

    return $response;
});