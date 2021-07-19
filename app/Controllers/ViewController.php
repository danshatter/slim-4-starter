<?php

namespace App\Controllers;

use Psr\Http\Message\{ServerRequestInterface as Request, ResponseInterface as Response};
use Slim\Views\Twig as View;

class ViewController
{

    private $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function index(Request $request, Response $response)
    {
        $version = \Slim\App::VERSION;

        $response->getBody()->write($version);

        return $response;
    }

}