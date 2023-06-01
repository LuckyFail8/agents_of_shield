<?php

namespace Controllers;

use App\Renderer;
use Models\Speciality;

class SpecialityController
{
    public function index(): Renderer
    {
        $specialityModel = new Speciality;
        $specialities = $specialityModel->findAll();
        foreach ($specialities as $specialityData) {
            $speciality = new Speciality;
            $speciality
                ->setId($specialityData->id)
                ->setName($specialityData->name);

            $agents = $speciality->getAgentBySpeciality([$speciality->name]);
            $agentsBySpeciality[$speciality->name] = [
                'agents' => $agents,
            ];
        }

        return Renderer::make('pages/speciality', [
            'specialities' => $specialities,
            'agentsBySpeciality' => $agentsBySpeciality,
        ]);
    }
}
