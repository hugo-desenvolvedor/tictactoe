<?php
declare(strict_types=1);

namespace App\TicTacToe;

trait Board
{
    /**
     * @var array $boardState
     */
    private $boardState;

    /**
     * @return array
     * @throws \Exception
     */
    public function getBoardState(): array
    {
        $boardStateLength = count($this->boardState);

        if ($boardStateLength != 3) {
            throw new \Exception('Invalid number of rows in board');
        }

        foreach ($this->boardState as $value) {
            if (count($value) != 3) {
                throw new \Exception('Invalid number of columns in board');
            }
        }

        return $this->boardState;
    }

    /**
     * @param array $boardState
     */
    public function setBoardState(array $boardState): void
    {
        $this->boardState = $boardState;
    }

    /**
     * Set the last CPU move into board state
     *
     * @param $move
     */
    public function setMoveInBoardState($move)
    {
        [$row, $column, $playerUnit] = $move;

        $this->boardState[$row][$column] = $playerUnit;
    }
}