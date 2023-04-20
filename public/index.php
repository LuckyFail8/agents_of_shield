<?php

use App\App;
use Router\Router;

require __DIR__ . '/../vendor/autoload.php';
define('BASE_VIEW_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);


echo 'Hello';

$router = new Router();

$router->register('/', ['Controllers\HomeController', 'index']);


(new App($router, $_SERVER['REQUEST_URI']))->run();
