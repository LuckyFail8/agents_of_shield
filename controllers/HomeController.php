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
        $agents = $agentModel->findAll();
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
        $contacts = $contactModel->findAll();
        foreach ($contacts as $contactData) {
            $contact = new Contact();
            $contact->setId($contactData->contact_id);
            $contact->setName($contactData->name);
            $contact->setLastName($contactData->last_name);
            $contact->setCountry($contactData->country_name);
            $contact->setCodeName();
            $contactData->code_name = $contact->getCodeName();
        }

        $targetModel = new Target();
        $targets = $targetModel->findAll();
        foreach ($targets as $targetData) {
            $target = new Target();
            $target->setId($targetData->target_id);
            $target->setName($targetData->name);
            $target->setLastName($targetData->last_name);
            $target->setCountry($targetData->country_name);
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
