<?php
declare(strict_types=1);

namespace App\TicTacToe;

class RandomMove extends Move
{
    /**
     * Set the CPU movement in random cell, like a tiny child - more chances to CPU win
     *
     * @param array $boardState
     * @param string $playerUnit
     * @return array
     */
    public function makeMove($boardState, $playerUnit = 'X'): array
    {
        $res = [];

        foreach ($boardState as $rowKey => $rowValue) {
            foreach ($rowValue as $columnKey => $columnValue) {
                if ($columnValue == '') {
                    array_push($res, [
                        'row' => $rowKey,
                        'column' => $columnKey
                    ]);
                }
            }
        }

        if (count($res) > 0) {
            $nextMove = $res[array_rand($res)];
            $res = [
                $nextMove['row'],
                $nextMove['column'],
                $playerUnit
            ];
        }

        return $res;
    }
}