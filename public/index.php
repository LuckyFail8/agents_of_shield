<?php

use Exceptions\RouteNotFoundException;
use Router\Router;

require __DIR__ . '/../vendor/autoload.php';
define('BASE_VIEW_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);


echo 'Hello';

$router = new Router();

$router->register('/', ['Controllers\HomeController', 'index']);

try {
    echo $router->resolve($_SERVER['REQUEST_URI']);
} catch (RouteNotFoundException $e) {
    echo $e->getMessage();
}
