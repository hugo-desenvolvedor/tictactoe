<?php

namespace App\Enum;

abstract class GameStatusEnum
{
    const DEFAULT = 0;
    const PLAYER_X = 1;
    const PLAYER_O = 2;
    const DRAW = 3;
}