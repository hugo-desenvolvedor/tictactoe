<?php
declare(strict_types=1);

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class AuthController
{
    public function auth(Request $request, Response $response)
    {
        $params = $request->getParsedBody();

        print_r($params);
    }
}