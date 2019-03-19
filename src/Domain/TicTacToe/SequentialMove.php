<?php
declare(strict_types=1);

namespace App\TicTacToe;

class SequentialMove extends Move
{
    /**
     * Set the CPU movement in the first empty cell - less chances the CPU wins
     *
     * @param array $boardState
     * @param string $playerUnit
     * @return array
     */
    public function makeMove($boardState, $playerUnit = 'X'): array
    {
        foreach ($boardState as $rowKey => $rowValue) {
            foreach ($rowValue as $columnKey => $columnValue) {
                if ($columnValue == '') {
                    return [
                        $rowKey,
                        $columnKey,
                        $playerUnit
                    ];
                }
            }
        }
    }
}