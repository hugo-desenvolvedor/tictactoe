<?php
declare(strict_types=1);

namespace App\TicTacToe;

use App\TicTacToe\Factories\MoveFactory;

class Game
{
    use Player;

    /**
     * @var int $level
     */
    private $level;

    /**
     * @var array $lastCPUMove
     */
    private $lastCPUMove;

    /**
     * @var GameStatus $gameStatus
     */
    private $gameStatus;

    /**
     * @var Board $board
     */
    private $board;

    /**
     * Game constructor.
     *
     * @param int $level
     * @param string $cpuPlayer
     * @throws \Exception
     */
    public function __construct(int $level, string $cpuPlayer)
    {
        $this->gameStatus = new GameStatus();
        $this->board = new Board();
        $this->level = $level;

        $this->setPlayerUnit($cpuPlayer);
    }

    /**
     * Make a CPU move
     *
     * @param array $boardState
     * @throws \Exception
     */
    public function makeCPUMove(array $boardState)
    {
        $this->board->setBoardState($boardState);
        $this->gameStatus->setActualGameStatus($this->board);

        if ($this->gameStatus->getStatus() == \App\Enums\GameStatusEnum::DEFAULT) {
            $move = MoveFactory::create($this->level);

            $this->lastCPUMove = $move->makeMove($boardState, $this->getPlayerUnit());
            $this->board->setMoveInBoardState($this->lastCPUMove);
            $this->gameStatus->setActualGameStatus($this->board);
        }
    }

    /**
     * @return array
     */
    public function getLastCPUMove(): array
    {
        return is_array($this->lastCPUMove) ? $this->lastCPUMove : [];
    }

    /**
     * @param array $lastCPUMove
     */
    public function setLastCPUMove(array $lastCPUMove): void
    {
        $this->lastCPUMove = $lastCPUMove;
    }

    /**
     * Get the game status Running | X Wins | CPU Wins | Draw
     *
     * @return int
     */
    public function getStatus(): int
    {
        return $this->gameStatus->getStatus();
    }

    public function getBoardState()
    {
        return $this->board->getBoardState();
    }
}