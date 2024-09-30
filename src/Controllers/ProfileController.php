<?php

namespace Only\Test\Controllers;

use Only\Test\Base\DB;
use Only\Test\Base\View;

class ProfileController
{
    public function index(): View
    {
        return View::render('profile', [
            'title' => 'Профиль',
            'user' => DB::query(
                'SELECT * FROM users WHERE id = ?', [$_SESSION['user']['id']])->fetch(),
        ]);
    }

    public function update()
    {

    }
}
