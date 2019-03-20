<?php
declare(strict_types=1);

namespace App\Validators;

class AuthValidator extends ApiValidator
{
    /**
     * @return array
     */
    protected function rules(): array
    {
        return [
          'user' => 'required|email',
          'password' => 'required|alpha_num'
        ];
    }
}