<?php

namespace App\Middlewares;

use Psr\Http\Server\{MiddlewareInterface, RequestHandlerInterface as Handler};
use Psr\Http\Message\{ResponseInterface, ServerRequestInterface as Request};
use Slim\Flash\Messages as Flash;
use Slim\Csrf\Guard as Csrf;
use Slim\Views\Twig as View;
use App\Base\{TwigRuntimeLoader, TwigExtension};

class TwigMiddleware implements MiddlewareInterface
{

    private $flash;
    private $csrf;
    private $view;

    public function __construct(Flash $flash, Csrf $csrf, View $view)
    {
        $this->flash = $flash;
        $this->csrf = $csrf;
        $this->view = $view;
    }

    public function process(Request $request, Handler $handler) : ResponseInterface
    {
        // Add Runtime Loader for the runtime twig extension class
        $runtimeLoader = new TwigRuntimeLoader; 
        $this->view->addRuntimeLoader($runtimeLoader);

        // Add the Twig extension
        $extension = new TwigExtension($this->flash, $this->csrf);
        $this->view->addExtension($extension);
        
        return $handler->handle($request);
    }
}