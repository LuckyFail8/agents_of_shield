<?php

namespace App;

use App\Router\Router;
use App\Exceptions\RouteNotFoundException;

class App
{
    public function __construct(private Router $router, private string $requestUri)
    {
    }
    public function run()
    {
        try {
            echo $this->router->resolve($this->requestUri);
        } catch (RouteNotFoundException $e) {
            echo $e->getMessage();
        }
    }
}
