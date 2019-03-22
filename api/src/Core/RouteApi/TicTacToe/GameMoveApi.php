<?php
declare(strict_types=1);

namespace App\RouteApi\TicTacToe;

use App\RouteApi\RouteApi;
use App\TicTacToe\Game;

class GameMove extends RouteApi
{
    /**
     * @param array|mixed[] $params
     * @return mixed|void
     * @throws \Exception
     */
    public function handle($params)
    {
        $board = $params['boardState'];
        $level = $params['level'];

        if ($level != 0 && $level != 1) {
            throw new \Exception('Level should be between 0 and 1', 404);
        }

        $game = new Game($level, 'X');
        $game->makeCPUMove($board);

        $this->setPayload([
            'lastCPUMove' => count($game->getLastCPUMove()) >  0 ? $game->getLastCPUMove() : null,
            'gameStatus' => $game->getStatus(),
            'boardState' => $game->getBoardState()
        ]);
    }
}