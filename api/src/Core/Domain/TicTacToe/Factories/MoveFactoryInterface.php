<?php
declare(strict_types=1);

namespace App\TicTacToe\Factories;

interface MoveFactoryInterface
{
    /**
     * @return mixed
     */
    static function create($level);
}