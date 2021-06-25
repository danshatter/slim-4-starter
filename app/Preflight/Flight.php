<?php

namespace App\Preflight;

use Psr\Http\Message\{ServerRequestInterface as Request, ResponseInterface as Response};

class Flight
{

	public function __invoke(Request $request, Response $response)
	{
		return $response;
	}

}