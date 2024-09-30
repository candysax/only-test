<?php

namespace Only\Test\Controllers;

use Only\Test\Base\DB;
use Only\Test\Base\View;
use Only\Test\Validators\ChangePasswordValidator;
use Only\Test\Validators\UpdateValidator;

class ProfileController
{
    public function index(): View
    {
        return View::render('profile', [
            'title' => 'Профиль',
            'user' => DB::query(
                'SELECT * FROM users WHERE id = ?', [$_SESSION['user']['id']])->fetch(),
            'errors' => $_SESSION['_flash']['errors'] ?? [],
        ]);
    }

    public function update(array $query): void
    {
        $errors = (new UpdateValidator())->validate($query, $_SESSION['user']['id'])->flashErrors();

        if (!empty($errors)) {
            redirect('/profile');
        }

        DB::query(
            'UPDATE users SET phone = :phone, email = :email, username = :username WHERE id = :id',
            [
                'id' => $_SESSION['user']['id'],
                'phone' => $query['phone'],
                'email' => $query['email'],
                'username' => $query['username'],
            ]
        )->fetch();

        redirect('/profile');
    }

    public function changePassword(array $query): void
    {
        $errors = (new ChangePasswordValidator())->validate($query)->flashErrors();

        if (!empty($errors)) {
            redirect('/profile');
        }

        DB::query(
            'UPDATE users SET password = :password WHERE id = :id',
            [
                'id' => $_SESSION['user']['id'],
                'password' => password_hash($query['password'], PASSWORD_DEFAULT),
            ]
        )->fetch();

        redirect('/profile');
    }
}
