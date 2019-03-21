<?php
declare(strict_types=1);

namespace App\RouteApi\TicTacToe;

use App\TicTacToe\Game;

class GameMove extends RouteApi
{
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
            'lastCPUMove' => $game->getLastCPUMove(),
            'gameStatus' => $game->getStatus(),
            'boardState' => $game->getBoardState()
        ]);
    }
}