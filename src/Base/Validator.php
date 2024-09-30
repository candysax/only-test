<?php

namespace Only\Test\Base;

abstract class Validator
{
    public array $errors = [];

    public function flashErrors(): array
    {
        $_SESSION['_flash']['errors'] = $this->errors;
        return $this->errors;
    }

    public function stringIsRequired(string $value): bool
    {
        return strlen($value) !== 0;
    }

    public function stringLength(string $value, int $min = 1, int $max = INF): bool
    {
        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public function stringIsEmail(string $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public function stringIsPhone(string $value): bool
    {
        return preg_match('/^[0-9]+$/', $value) === 1;
    }

    public function doPasswordsMatch(string $password, string $passwordRepeat): bool
    {
        return $password === $passwordRepeat;
    }

    public function valueIsUnique(string $column, string $value, ?int $exceptId = null): bool
    {
        $params = ['value' => $value];
        $query = 'SELECT COUNT(*) FROM users WHERE `' . $column . '` = :value';

        if (!is_null($exceptId)) {
            $query .= ' AND `id` != :except';
            $params['except'] = $exceptId;
        }

        $count = DB::query($query, $params)->fetch();

        return $count[array_key_first($count)] === 0;
    }
}
