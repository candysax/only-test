<?php

namespace Only\Test\Middleware;

class Auth
{
    public function handle(): void
    {
        if (!isset($_SESSION['user'])) {
            redirect('/');
        }
    }
}
