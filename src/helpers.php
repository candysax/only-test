<?php

use Only\Test\Base\View;

function abort(int $code = 404): void
{
    http_response_code($code);
    View::render("errors/{$code}");
    die();
}

function redirect(string $path): void
{
    header("location: {$path}");
    die();
}

function base_url(string $path): string
{
    return BASE_URL . $path;
}

function view_url(string $path): string
{
    return VIEW_URL . $path;
}
