<?php

namespace Only\Test\Controllers;

use Only\Test\Base\View;

class LoginController
{
    public function index(): View
    {
        return View::render('login');
    }

    public function login($query)
    {
        var_dump($query);
    }
}
