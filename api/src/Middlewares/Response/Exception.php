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
     * @return Response
     */
    public function __invoke(Request $request, Response $response, callable $next)
    {
        $error = null;
        try {
            $next($request, $response);

            $status = $response->getStatusCode();
        } catch (\Throwable $e) {
            $error = [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];

            $status = $e->getCode() > 0 ? $e->getCode() : 400;
        } finally {
            $responseData = json_decode($response->getBody()->__toString(), true) ?? [];
            $responseData['error'] = $responseData['error'] ?? $error;

            return $response->withJson($responseData, $status);
        }
    }
}