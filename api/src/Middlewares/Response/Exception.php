<?php
declare(strict_types=1);

namespace App\Middlewares\Response;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class Exception
{
    /**
     * Modify exceptions message
     *
     * @param Request $request
     * @param Response $response
     * @param callable $next
     * @return ResponseInterface
     */
    public function __invoke(Request $request, Response $response, callable $next)
    {
        $error = null;
        try {
            $response = $next($request, $response);
            $status = $response->getStatusCode();
        } catch (\Throwable $e) {
            $error = [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];

            $status = $e->getCode() > 0 ? $e->getCode() : 400;
        }

        $responseData = json_decode($response->getBody()->__toString(), true) ?? [];
        $responseData['error'] = $responseData['error'] ?? $error;

        return $response->withJson($responseData, $status);
    }
}