<?php
declare(strict_types=1);

namespace App\TicTacToe;

class Game
{
    use BoardTrait;
    use Player;
    //use GameStatus;

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
     * Game constructor.
     * @param int $level
     * @param string $cpuPlayer
     * @throws \Exception
     */
    public function __construct($level, string $cpuPlayer)
    {
        $this->gameStatus = new GameStatus();

        $this->level = $level;
        $this->setPlayerUnit($cpuPlayer);

        $this->boardState = [
            ['', '', ''],
            ['', '', ''],
            ['', '', '']
        ];
    }

    /**
     * @param array $boardState
     */
    public function makeCPUMove(array $boardState)
    {
        $this->boardState = $boardState;
        $this->gameStatus->setActualGameStatus($this->boardState);

        $move = null;

        if ($this->gameStatus->getStatus() == \App\Enum\GameStatus::DEFAULT) {
            switch ($this->level) {
                case 0 :
                    $move = new SequentialMove();
                    break;
                default :
                    $move = new RandomMove();
            }
            $this->lastCPUMove = $move->makeMove($boardState, $this->getPlayerUnit());
            $this->setMoveInBoardState($this->lastCPUMove);

            $this->gameStatus->setActualGameStatus($this->boardState);
        }
    }

    /**
     * @return array
     */
    public function getLastCPUMove(): array
    {
        return is_array($this->lastCPUMove) ? $this->lastCPUMove : ['', '', ''];
    }

    /**
     * @param array $lastCPUMove
     */
    public function setLastCPUMove(array $lastCPUMove): void
    {
        $this->lastCPUMove = $lastCPUMove;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->gameStatus->getStatus();
    }
}