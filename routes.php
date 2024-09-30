<?php

use Only\Test\Controllers\HomeController;
use Only\Test\Controllers\LoginController;
use Only\Test\Controllers\LogoutController;
use Only\Test\Controllers\ProfileController;
use Only\Test\Controllers\RegisterController;
use Only\Test\Middleware\Auth;
use Only\Test\Middleware\Guest;

$router->get('/', HomeController::class, 'index');

$router->get('/login', LoginController::class, 'index', [Guest::class]);
$router->post('/login', LoginController::class, 'login', [Guest::class]);

$router->get('/register', RegisterController::class, 'index', [Guest::class]);
$router->post('/register', RegisterController::class, 'register', [Guest::class]);

$router->get('/profile', ProfileController::class, 'index', [Auth::class]);

$router->delete('/logout', LogoutController::class, 'logout', [Auth::class]);
