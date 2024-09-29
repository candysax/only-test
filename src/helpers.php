<?php

use Only\Test\Base\View;

function abort(int $code = 404): void
{
    http_response_code($code);
    View::render('404');
    die();
}

function redirect(string $path): void
{
    header("location: {$path}");
    die();
}
