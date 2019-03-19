<?php
declare(strict_types=1);

namespace App\TicTacToe;

trait Player
{
    /**
     * @var string $playeUnit
     */
    private $playerUnit;

    /**
     * @return string
     */
    public function getPlayerUnit(): string
    {
        return $this->playerUnit;
    }

    /**
     * @param string $playerUnit
     * @throws \Exception
     */
    public function setPlayerUnit(string $playerUnit): void
    {
        if($playerUnit != 'X' && $playerUnit != 'O') {
            throw new \Exception('Invalid player unit.');
        }

        $this->playerUnit = $playerUnit;
    }
}