<?php

use App\App;
use App\Models\Agent;
use App\Models\Target;
use App\Router\Router;

require __DIR__ . '/../vendor/autoload.php';
define('BASE_VIEW_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);


$router = new Router();

$router->register('/', ['App\Controllers\HomeController', 'index']);
$router->register('/country', ['App\Controllers\CountryController', 'index']);
$router->register('/speciality', ['App\Controllers\SpecialityController', 'index']);
(new App($router, $_SERVER['REQUEST_URI']))->run();
