<?php
declare(strict_types=1);

namespace App\TicTacToe;

abstract class Move implements MoveInterface
{
    /**
     * The next movement set in board game
     *
     * @var array $nextMove
     */
    private $nextMove;

    /**
     * @param array $boardState
     * @param string $playerUnit
     * @return array
     */
    abstract function makeMove(array $boardState, string $playerUnit  = 'X'): array;
}