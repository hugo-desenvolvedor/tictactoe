<?php
declare(strict_types=1);

namespace App\TicTacToe;

class Game
{
    use Board;
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
    public function __construct($level = 0, string $cpuPlayer)
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
        $this->setBoardState($this->boardState);
        $this->setActualGameStatus($this->boardState);

        $move = null;

        if ($this->getGameStatus() == \App\Enum\GameStatus::DEFAULT) {
            switch ($this->level) {
                case 0 :
                    $move = new SequentialMove();
                    break;
                default :
                    $move = new RandomMove();
            }
            $this->lastCPUMove = $move->makeMove($boardState, $this->getPlayerUnit());
            $this->setMoveInBoardState($this->lastCPUMove);

            $this->setActualGameStatus();
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
     * Verify if some move can be done
     *
     * @return bool
     */
    private function isFullBoardState(): bool
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

    /**
     * @return int
     */
    public function getGameStatus(): int
    {
        return $this->gameStatus->getStatus();
    }
}