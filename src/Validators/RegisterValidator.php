<?php

namespace Only\Test\Validators;

use Only\Test\Base\Validator;

class RegisterValidator extends Validator
{
    public function validate(array $data): Validator
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

        if (!$this->stringLength($data['password'], 6, 20)) {
            $this->errors['password'][] = 'Пароль должен быть от 6 до 20 символов';
        }

        if (!$this->doPasswordsMatch($data['password'], $data['password_repeat'])) {
            $this->errors['password_repeat'][] = 'Пароли не совпадают';
        }

        if (!$this->valueIsUnique('phone', $data['phone'])) {
            $this->errors['phone'][] = 'Пользователь с таким телефоном уже существует';
        }

        if (!$this->valueIsUnique('email', $data['email'])) {
            $this->errors['email'][] = 'Пользователь с таким email уже существует';
        }

        if (!$this->valueIsUnique('username', $data['username'])) {
            $this->errors['username'][] = 'Пользователь с таким никнеймом уже существует';
        }

        return $this;
    }
}
