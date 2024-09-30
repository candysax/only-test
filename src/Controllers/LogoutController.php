<?php

namespace Only\Test\Controllers;

class LogoutController
{
    public function logout(): void
    {
        unset($_SESSION['user']);

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);

        session_destroy();

        redirect('/');
    }
}
