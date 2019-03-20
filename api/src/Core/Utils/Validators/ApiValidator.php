<?php
declare(strict_types=1);

namespace App\Validators;

use Rakit\Validation\Validator;

abstract class ApiValidator
{
    /**
     * @return array
     */
    abstract protected function rules(): array;

    /**
     * @param array $data
     * @return array
     */
    public function validate(array $data): array
    {
        $validator = new Validator;

        $validation = $validator->validate($data, $this->rules());

        if ($validation->fails()) {
            return $validation->errors()->toArray();
        }

        return [];
    }
}