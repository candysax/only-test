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

function base_path(string $path): string
{
    return BASE_PATH . $path;
}

function view_path(string $path): string
{
    return VIEW_PATH . $path;
}

function generateCsrfToken(): void
{
    if (empty($_SESSION['_token'])) {
        $_SESSION['_token'] = bin2hex(random_bytes(32));
    }
}
