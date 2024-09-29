<?php

use Only\Test\Base\Router;

include_once './vendor/autoload.php';

$router = new Router();

include_once './routes.php';

$router->resolve();
