<?php

namespace App\Enums;

abstract class BasicEnum
{
    public static function items(): array
    {
        $reflection = new \ReflectionClass(static::class);

        return $reflection->getConstants();
    }
}