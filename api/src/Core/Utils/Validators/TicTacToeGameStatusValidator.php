<?php
declare(strict_types=1);

namespace App\Validators;


class TicTacToeGameStatusValidator extends ApiValidator
{
    /**
     * @return array
     */
    protected function rules(): array
    {
        return [
            'boardState' => 'required|array'
        ];
    }
}