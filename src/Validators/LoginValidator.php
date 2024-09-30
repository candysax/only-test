<?php

namespace Only\Test\Validators;

use Only\Test\Base\Validator;

class LoginValidator extends Validator
{
    public function validate(array $data): array
    {
        foreach ($data as $key => $value) {
            if (!$this->stringIsRequired($value)) {
                $this->errors[$key][] = 'Поле не заполнено';
            }
        }

        if (!$this->stringLength($data['password'], 6, 20)) {
            $this->errors['password'][] = 'Пароль должен быть от 6 до 20 символов';
        }

        return $this->errors;
    }
}
