<?php
declare(strict_types=1);

namespace App\Middlewares\Response;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class Json
{
    /**
     * Format the JSON response
     *
     * @param Request $request
     * @param Response $response
     * @param callable $next
     * @return ResponseInterface
     */
    public function __invoke(Request $request, Response $response, callable $next)
    {
        $response = $next($request, $response);

        $responseData = json_decode($response->getBody()->__toString(), true);
        $responseData['success'] = $response->getStatusCode() == 200;

        return $response->withJson($responseData);
    }
}