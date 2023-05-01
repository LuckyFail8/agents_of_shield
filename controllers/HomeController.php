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
        foreach ($agents as $agentData) {
            $agent = new Agent();
            $agent->setId($agentData->agent_id);
            $agent->setName($agentData->name);
            $agent->setLastName($agentData->last_name);
            $agent->setCountry($agentData->country_name);
            $agent->setIdentificationCode();
            $agentData->identification_code = $agent->getIdentificationCode();
        }

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
