<?php
declare(strict_types=1);

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Validators\AuthValidator;

class AuthController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function auth(Request $request, Response $response)
    {
        $params = $request->getParsedBody();

        $validator = new AuthValidator();
        $errors = $validator->validate($params);

        if ($errors) {
            return $response->withJson($errors);
        }

        return $response->withJson($params);
    }
}