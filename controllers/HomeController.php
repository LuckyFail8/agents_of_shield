<?php

namespace Controllers;

use App\Renderer;
use Models\Model;
use Models\Person;

class Homecontroller
{
    public function index(): Renderer
    {
        $personModel = new Person();
        $persons = $personModel->all();


        return Renderer::make('home/index', compact('persons'));
    }
}
