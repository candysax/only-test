<?php

namespace Only\Test\Validators;

use Only\Test\Base\Validator;

class UpdateValidator extends Validator
{
    public function validate(array $data, ?int $userId = null): Validator
    {
        foreach ($data as $key => $value) {
            if (!$this->stringIsRequired($value)) {
                $this->errors[$key][] = 'Поле не заполнено';
            }
        }

        if (!$this->stringIsEmail($data['email'])) {
            $this->errors['email'][] = 'Неверный формат email';
        }

        if (!$this->stringIsPhone($data['phone'])) {
            $this->errors['phone'][] = 'Неверный формат номера телефона';
        }

        if (!$this->valueIsUnique('phone', $data['phone'], $userId)) {
            $this->errors['phone'][] = 'Пользователь с таким телефоном уже существует';
        }

        if (!$this->valueIsUnique('email', $data['email'], $userId)) {
            $this->errors['email'][] = 'Пользователь с таким email уже существует';
        }

        if (!$this->valueIsUnique('username', $data['username'], $userId)) {
            $this->errors['username'][] = 'Пользователь с таким никнеймом уже существует';
        }

        return $this;
    }
}
