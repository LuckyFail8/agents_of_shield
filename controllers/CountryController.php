<?php

namespace Controllers;

use App\Renderer;
use Models\Country;

class CountryController
{
    public function index(): Renderer
    {
        $countryModel = new Country;
        $countries = $countryModel->findAll();
        foreach ($countries as $countryData) {
            $country = new Country;
            $country->setId($countryData->id);
            $country->setName($countryData->name);

            $agents = $country->getAgent();
            $contacts = $country->getContact();
            $targets = $country->getTarget();
            $personByCountry[$country->name] = [
                'agents' => $agents,
                'contacts' => $contacts,
                'targets' => $targets,
            ];
        }

        return Renderer::make('country', [
            'personByCountry' => $personByCountry,
            'countries' => $countries,
        ]);
    }
}
