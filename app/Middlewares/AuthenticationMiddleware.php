<?php

namespace App\Middlewares;

use Psr\Http\Server\{MiddlewareInterface, RequestHandlerInterface as Handler};
use Psr\Http\Message\{ResponseInterface, ServerRequestInterface as Request};
use App\Models\User;

class AuthenticationMiddleware implements MiddlewareInterface
{

    public function process(Request $request, Handler $handler) : ResponseInterface
    {
        if (!isset($_SESSION['id'])) {
            return $handler->handle($request);
        }

        // Set the user into the session
        $user = User::find($_SESSION['id']);

        $request = $request->withAttribute('user', $user);
        
        return $handler->handle($request);
    }
}