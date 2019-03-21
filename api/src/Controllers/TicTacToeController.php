<?php
declare(strict_types=1);

namespace App\Controllers;
use App\RouteApi\TicTacToe\GameMove;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Validators\TicTacToeMoveValidator;
use App\Validators\TicTacToeGameStatusValidator;

class TicTacToeController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws \Exception
     */
    public function move(Request $request, Response $response)
    {
        $params = $request->getParsedBody();

        $validator = new TicTacToeMoveValidator();
        $errors = $validator->validate($params);

        if ($errors) {
            return $response->withJson($errors, 404);
        }

        $gameMove = new GameMove();
        $gameMove->handle($params);

        return $response->withJson($gameMove->getPayload());
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function gameStatus(Request $request, Response $response)
    {
        $params = $request->getParsedBody();

        $validator = new TicTacToeGameStatusValidator();
        $errors = $validator->validate($params);

        if ($errors) {
            return $response->withJson($errors);
        }

        return $response->withJson($params);
    }
}