<?php
declare(strict_types=1);

namespace App\RouteApi\TicTacToe;

use App\RouteApi\RouteApi;
use App\TicTacToe\Board;
use App\TicTacToe\GameStatus;

class GameStatusApi extends RouteApi
{
    /**
     * @param array|mixed[] $params
     * @return mixed|void
     * @throws \Exception
     */
    public function handle($params)
    {
        $board = new Board();
        $board->setBoardState($params['boardState']);

        $gameStatus = new GameStatus();
        $gameStatus->setActualGameStatus($board);

        $this->setPayload([
            'gameStatus' => $gameStatus->getStatus()
        ]);
    }
}