<?php

namespace App\Middlewares\Request;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Enums\HTTPContentTypeEnum;

class Json
{
    /**
     * Verify if it's a valid header content type
     *
     * @param Request $request
     * @param Response $response
     * @param callable $next
     * @return mixed
     * @throws \Exception
     */
    public function __invoke(Request $request, Response $response, callable $next)
    {
        $requestContentType = $request->getContentType();
        $validContentType = HTTPContentTypeEnum::APPLICATION_JSON;

        if ($requestContentType != $validContentType) {
            throw new \Exception(sprintf("The request Content Type is not valid. It should be '%s'", $validContentType), 400);
        }

        return $next($request, $response);
    }
}