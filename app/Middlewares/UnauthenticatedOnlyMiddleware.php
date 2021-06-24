<?php

namespace App\Middlewares;

use Psr\Http\Server\{MiddlewareInterface, RequestHandlerInterface as Handler};
use Psr\Http\Message\{ServerRequestInterface as Request, ResponseInterface, ResponseFactoryInterface};
use Slim\Interfaces\RouteParserInterface as RouteParser;

class UnauthenticatedOnlyMiddleware implements MiddlewareInterface
{

    private $routeParser;
    private $responseFactory;

    public function __construct(RouteParser $routeParser, ResponseFactoryInterface $responseFactory)
    {
        $this->routeParser = $routeParser;
        $this->responseFactory = $responseFactory;
    }

    public function process(Request $request, Handler $handler) : ResponseInterface
    {
        $user = $request->getAttribute('user');
        
        // Check to see if our application has the user value
        if (isset($user)) {
            return $this->responseFactory()->createResponse()
                                        ->withHeader('Location', $this->routeParser->urlFor('home'))
                                        ->withStatus(302);
        }
        
        return $handler->handle($request);
    }

}