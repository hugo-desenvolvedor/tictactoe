<?php
declare(strict_types=1);

namespace App\TicTacToe;

class Board
{
    /**
     * @var array $boardState
     */
    private $boardState = [];

    /**
     * @throws \Exception
     */
    private function validate(){
        $boardStateLength = count($this->boardState);

        if ($boardStateLength != 3) {
            throw new \Exception('Invalid number of rows in board');
        }

        foreach ($this->boardState as $value) {
            if (count($value) != 3) {
                throw new \Exception('Invalid number of columns in board');
            }
        }
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getBoardState(): array
    {
        return $this->boardState;
    }

    /**
     * @param array $boardState
     * @throws \Exception
     */
    public function setBoardState(array $boardState): void
    {
        $this->boardState = $boardState;

        $this->validate();
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

    /**
     * Verify if the board state is full
     *
     * @return bool
     */
    public function isFullBoardState(): bool
    {
        $size = 0;
        foreach ($this->boardState as $rowKey => $rowValue) {
            foreach ($rowValue as $columnKey => $columnValue) {
                if ($columnValue == 'X' || $columnValue == 'O') {
                    $size++;
                }
            }
        }

        return $size == 9 ? true : false;
    }
}