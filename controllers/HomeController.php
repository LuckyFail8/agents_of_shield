<?php

namespace Controllers;

use App\Renderer;
use Models\Agent;
use Models\Contact;
use Models\Target;

class Homecontroller
{
    public function index(): Renderer
    {
        $agentModel = new Agent();
        $agents = $agentModel->getAllPersonType();

        $contactModel = new Contact();
        $contacts = $contactModel->getAllPersonType();

        $targetModel = new Target();
        $targets = $targetModel->getAllPersonType();


        return Renderer::make('home/index', [
            'agents' => $agents,
            'contacts' => $contacts,
            'targets' => $targets
        ]);
    }
}
