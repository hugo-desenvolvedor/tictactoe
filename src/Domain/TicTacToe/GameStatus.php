<?php
declare(strict_types=1);

namespace App\TicTacToe;

class GameStatus
{
    /**
     * @var int $status
     */
    private $status = 0;

    public function setActualGameStatus(array $board)
    {
           
    }

    /**
     * Set the winner, if has one
     */
    private function setWinner(): void
    {
        $res = $this->executeHorizontalBoardStateWinner();

        if (!$res) {
            $res = $this->executeVerticalBoardStateWinner();
        }

        if (!$res) {
            $res = $this->executeLeftToRightDiagonalBoardStateWinner();
        }
        if (!$res) {
            $this->executeRightToLeftDiagonalBoardStateWinner();
        }
    }

    /**
     * @param int $status
     */
    private function setStatus(int $status)
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * Set horizontal line winner
     *
     * @return bool
     */
    private function executeHorizontalBoardStateWinner(): bool
    {
        $boardState = $this->getBoardState();

        for ($i = 0; $i < 3; $i++) {
            if ($boardState[$i][0] != '' && $boardState[$i][0] == $boardState[$i][1] && $boardState[$i][1] == $boardState[$i][2]) {
                $this->setPlayerUnitGameStatus($boardState[$i][0]);

                return true;
            }
        }

        return false;
    }

    /**
     * Set vertical line winner
     *
     * @return bool
     */
    private function executeVerticalBoardStateWinner(): bool
    {
        for ($i = 0; $i < 3; $i++) {
            if ($this->boardState[0][$i] != '' && $this->boardState[0][$i] == $this->boardState[1][$i] && $this->boardState[1][$i] == $this->boardState[2][$i]) {
                $this->setPlayerUnitGameStatus($this->boardState[0][$i]);

                return true;
            }
        }

        return false;
    }

    /**
     * Set left to right diagonal winner
     *
     * @return bool
     */
    private function executeLeftToRightDiagonalBoardStateWinner(): bool
    {
        if ($this->boardState[0][0] != '' && $this->boardState[0][0] == $this->boardState[1][1] && $this->boardState[1][1] == $this->boardState[2][2]) {
            $this->setPlayerUnitGameStatus($this->boardState[0][0]);

            return true;
        }

        return false;
    }

    /**
     * Set right to left diagonal winner
     *
     * @return bool
     */
    private function executeRightToLeftDiagonalBoardStateWinner(): bool
    {
        if ($this->boardState[2][0] != '' && $this->boardState[2][0] == $this->boardState[1][1] && $this->boardState[1][1] == $this->boardState[0][2]) {
            $this->setPlayerUnitGameStatus($this->boardState[2][0]);

            return true;
        }

        return false;
    }
}