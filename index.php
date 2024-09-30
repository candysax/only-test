<?php

use Only\Test\Base\Router;

const BASE_URL = __DIR__ . '/';
const VIEW_URL = BASE_URL . '/views/';

session_start();

include_once './vendor/autoload.php';
include_once './src/helpers.php';

$router = new Router();

include_once './routes.php';

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
$query = $method === 'GET' ? $_GET : $_POST;
$path = parse_url($_SERVER['REQUEST_URI'])['path'];
$path = ($path !== '/')? rtrim($path, '/') : $path;

$router->resolve($method, $path, $query);
