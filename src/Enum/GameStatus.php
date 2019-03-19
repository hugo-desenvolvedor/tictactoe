<?php
declare(strict_types=1);

namespace App\Enum;

abstract class GameStatus
{
    const DEFAULT = 0;
    const PLAYER_X = 1;
    const PLAYER_O = 2;
    const DRAW = 3;
}