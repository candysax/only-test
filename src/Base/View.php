<?php

namespace Only\Test\Base;

class View
{
    private const string VIEW_PATH = __DIR__ . "/../../views/";

    public static function render(string $view, array $params = []): View
    {
        extract($params);

        include static::VIEW_PATH . "{$view}.php";

        return (new static());
    }
}
