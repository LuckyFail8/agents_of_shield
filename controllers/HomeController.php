<?php

namespace Controllers;

use App\Renderer;

class Homecontroller
{
    public function index(): Renderer
    {
        return Renderer::make('home/index');
    }
}
