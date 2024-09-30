<?php

namespace Only\Test\Middleware;

class Guest
{
    public function handle(): void
    {
        if (isset($_SESSION['user'])) {
            redirect('/');
        }
    }
}
