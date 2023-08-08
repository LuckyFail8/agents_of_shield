<?php

namespace App\Controllers;

use App\Renderer;
use App\Models\Agent;
use App\Models\Target;
use App\Models\Contact;

class Homecontroller
{
    public function index(): Renderer
    {
        $agentModel = new Agent();
        $agents = $agentModel->findAll();
        /* foreach ($agents as $agentData) {
            $agent = new Agent();
            $agent->getId();
            $agent->setName($agentData->name);
            $agent->setLastName($agentData->last_name);
            $agent->setIdentificationCode();
            var_dump($agent);
        } */
        var_dump($agents);

        $contactModel = new Contact();
        $contacts = $contactModel->findAll();
        foreach ($contacts as $contactData) {
            $contact = new Contact();
            $contact->setName($contactData->name);
            $contact->setLastName($contactData->last_name);
            $contact->setCodeName();
            $contactData->code_name = $contact->getCodeName();
        }

        $targetModel = new Target();
        $targets = $targetModel->findAll();
        foreach ($targets as $targetData) {
            $target = new Target();
            $target->setName($targetData->name);
            $target->setLastName($targetData->last_name);
            $target->setCodeName();
            $targetData->code_name = $target->getCodeName();
        }


        return Renderer::make('home/index', [
            'agents' => $agents,
            'contacts' => $contacts,
            'targets' => $targets
        ]);
    }
}
