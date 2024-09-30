<?php

namespace Only\Test\Controllers;

use Only\Test\Base\DB;
use Only\Test\Base\View;
use Only\Test\Validators\RegisterValidator;

class RegisterController
{
    public function index(): View
    {
        return View::render('register', [
            'title' => 'Регистрация',
            'errors' => $_SESSION['_flash']['errors'] ?? [],
        ]);
    }

    public function register(array $query): void
    {
        $errors = (new RegisterValidator())->validate($query)->flashErrors();

        if (!empty($errors)) {
            redirect('/register');
        }

        DB::query(
            'INSERT INTO users (phone, email, username, password) VALUES (:phone, :email, :username, :password)',
            [
                'phone' => $query['phone'],
                'email' => $query['email'],
                'username' => $query['username'],
                'password' => password_hash($query['password'], PASSWORD_DEFAULT),
            ]
        );

        $_SESSION['_flash']['success'] = 'Регистрация прошла успешно';

        redirect('/login');
    }
}
