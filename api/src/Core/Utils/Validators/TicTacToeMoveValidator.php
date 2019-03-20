<?php
declare(strict_types=1);

namespace App\Validators;

class TicTacToeMoveValidator extends ApiValidator
{
    /**
     * @return array
     */
    protected function rules(): array
    {
        return [
            'board' => 'required|array',
            'level' => 'required|integer'
        ];
    }
}