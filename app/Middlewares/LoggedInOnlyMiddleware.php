<?php

namespace App\Middlewares;

use Psr\Http\Server\{Middleware, RequestHandlerInterface as Handler};
use Psr\Http\Message\{ServerRequestInterface as Request, ResponseInterface, ResponseFactoryInterface};
use Slim\Flash\Messages as Flash;
use Slim\Interfaces\RouteParserInterface as RouteParser;

class LoggedInOnlyMiddleware implements MiddlewareInterface {

    private $flash;
    private $routeParser;
    private $responseFactory;

    public function __construct(Flash $flash, RouteParser $routeParser, ResponseFactoryInterface $responseFactory)
    {
        $this->flash = $flash;
        $this->routeParser = $routeParser;
        $this->responseFactory = $responseFactory;
    }

    public function process(Request $request, Handler $handler) : ResponseInterface
    {
        $user = $request->getAttribute('user');

        if (!isset($user)) {
            // Flash message to show to the user
            $this->flash->addMessage('not-logged-in', 'You must be logged in to view that page');

            $_SESSION['next'] = $request->getRequestTarget();

            return $this->responseFactory->createResponse()
                                        ->withHeader('Location', $this->routeParser->urlFor('login'))
                                        ->withStatus(302);
        }

        return $handler->handle($request);
    }

}