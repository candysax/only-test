<?php

namespace Only\Test\Base;

class View
{
    public static function render(string $view, array $params = []): View
    {
        extract($params);

        include view_url("{$view}.php");

        return (new static());
    }
}
