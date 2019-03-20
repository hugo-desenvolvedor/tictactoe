<?php
declare(strict_types=1);

namespace App\TicTacToe;

class GameStatus
{
    use Player;

    /**
     * @var int $status
     */
    private $status = 0;
    /**
     * @var bool $hasWinner
     */
    private $hasWinner;

    /**
     * @var array $boardState ;
     */
    private $boardState;

    public function setActualGameStatus(Board $board)
    {
        $this->boardState = $board->getBoardState();
        $this->setWinner();

        if ($this->hasWinner) {
            if ($this->playerUnit == 'X') {
                $this->setStatus(\App\Enums\GameStatusEnum::PLAYER_X);
            } else if ($this->playerUnit == 'O') {
                $this->setStatus(\App\Enums\GameStatusEnum::PLAYER_O);
            }
        } else if ($board->isFullBoardState()) {
            $this->setStatus(\App\Enums\GameStatusEnum::DRAW);
        }
    }

    /**
     * Set the winner, if has one
     */
    private function setWinner(): void
    {
        $hasWinner = $this->executeHorizontalBoardStateWinner();

        if (!$hasWinner) {
            $hasWinner = $this->executeVerticalBoardStateWinner();
        }

        if (!$hasWinner) {
            $hasWinner = $this->executeLeftToRightDiagonalBoardStateWinner();
        }
        if (!$hasWinner) {
            $hasWinner = $this->executeRightToLeftDiagonalBoardStateWinner();
        }

        $this->hasWinner = $hasWinner;
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
     * @throws \Exception
     */
    private function executeHorizontalBoardStateWinner(): bool
    {
        $board = $this->boardState;

        for ($i = 0; $i < 3; $i++) {
            if ($board[$i][0] != '' && $board[$i][0] == $board[$i][1] && $board[$i][1] == $board[$i][2]) {
                $this->setPlayerUnit($board[$i][0]);

                return true;
            }
        }

        return false;
    }

    /**
     * @return bool
     *
     * @throws \Exception
     */
    private function executeVerticalBoardStateWinner(): bool
    {
        $board = $this->boardState;

        for ($i = 0; $i < 3; $i++) {
            if ($board[0][$i] != '' && $board[0][$i] == $board[1][$i] && $board[1][$i] == $board[2][$i]) {
                $this->setPlayerUnit($board[0][$i]);

                return true;
            }
        }

        return false;
    }

    /**
     * Set left to right diagonal winner
     *
     * @return bool
     * @throws \Exception
     */
    private function executeLeftToRightDiagonalBoardStateWinner(): bool
    {
        $board = $this->boardState;

        if ($board[0][0] != '' && $board[0][0] == $board[1][1] && $board[1][1] == $board[2][2]) {
            $this->setPlayerUnit($board[0][0]);

            return true;
        }

        return false;
    }

    /**
     * Set right to left diagonal winner
     *
     * @return bool
     * @throws \Exception
     */
    private function executeRightToLeftDiagonalBoardStateWinner(): bool
    {
        $board = $this->boardState;

        if ($board[2][0] != '' && $board[2][0] == $board[1][1] && $board[1][1] == $board[0][2]) {
            $this->setPlayerUnit($board[2][0]);

            return true;
        }

        return false;
    }
}