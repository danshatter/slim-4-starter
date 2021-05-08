<?php

namespace App\Controllers;

use Psr\Http\Message\{ServerRequestInterface as Request, ResponseInterface as Response};
use Respect\Validation\Validator as V;
use App\Models\User;
use App\Validation\Validator;

class UserController
{
    
    private $validator;

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

}