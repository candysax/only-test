<?php

use Only\Test\Controllers\HomeController;
use Only\Test\Controllers\LoginController;
use Only\Test\Controllers\LogoutController;
use Only\Test\Controllers\ProfileController;
use Only\Test\Controllers\RegisterController;

$router->get('/', HomeController::class, 'index');

$router->get('/login', LoginController::class, 'index');
$router->post('/login', LoginController::class, 'login');

$router->get('/register', RegisterController::class, 'index');
$router->post('/register', RegisterController::class, 'register');

$router->get('/profile', ProfileController::class, 'index');

$router->delete('/logout', LogoutController::class, 'logout');
