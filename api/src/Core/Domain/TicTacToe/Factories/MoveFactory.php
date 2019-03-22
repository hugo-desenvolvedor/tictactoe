<?php
declare(strict_types=1);

namespace App\TicTacToe\Factories;

use App\Enums\LevelEnum;
use App\TicTacToe\RandomMove;
use App\TicTacToe\SequentialMove;

class MoveFactory implements MoveFactoryInterface
{
    /**
     * @param $level
     * @return RandomMove|SequentialMove|mixed
     * @throws \Exception
     */
    static function create($level)
    {
        $items = LevelEnum::items();
        if (in_array($level, $items) == false) {
            throw new \Exception(sprintf('The %s is invalid', $level));
        };

        switch ($level) {
            case 0 :
                return new SequentialMove();
                break;
            case 1 :
                return new RandomMove();
                break;
            default:
                return new RandomMove();
        }
    }
}