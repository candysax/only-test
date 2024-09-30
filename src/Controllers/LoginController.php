<?php

namespace Only\Test\Controllers;

use Only\Test\Base\DB;
use Only\Test\Base\View;
use Only\Test\Validators\LoginValidator;

class LoginController
{
    public function index(): View
    {
        return View::render('login', [
            'title' => 'Вход',
            'errors' => $_SESSION['_flash']['errors'] ?? [],
        ]);
    }

    public function login($query): void
    {
        $errors = (new LoginValidator())->validate($query);

        $user = DB::query(
            'SELECT * FROM users WHERE `phone` = :phone_or_email OR `email` = :phone_or_email',
            ['phone_or_email' => $query['phone_or_email']]
        )->fetch();

        if ($user && password_verify($query['password'], $user['password'])) {
            $_SESSION['user'] = $user;
            redirect('/profile');
        }

        if (empty($errors)) {
            $_SESSION['_flash']['errors']['global'][] = 'Неправильный телефон/email или пароль';
        } else {
            $_SESSION['_flash']['errors'] = $errors;
        }
        redirect('/login');
    }
}
