<?php

use Only\Test\Controllers\HomeController;
use Only\Test\Controllers\LoginController;

$router->get('/', HomeController::class, 'index');
$router->get('/sign-in', LoginController::class, 'index');
$router->post('/login', LoginController::class, 'login');

