<?php

namespace Only\Test\Controllers;

use Only\Test\Base\View;

class HomeController
{
    public function index($query): View
    {
        return View::render('home');
    }
}
