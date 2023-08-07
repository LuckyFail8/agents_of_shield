<?php

namespace App\Controllers;

use App\Renderer;
use App\Models\Country;

class CountryController
{
    public function index(): Renderer
    {
        $countryModel = new Country;
        $countries = $countryModel->findAll();
        foreach ($countries as $countryData) {
            $country = new Country;
            $country
                ->setId($countryData->id)
                ->setName($countryData->name);

            $agents = $country->getAgent();
            $contacts = $country->getContact();
            $targets = $country->getTarget();
            $personByCountry[$country->name] = [
                'agents' => $agents,
                'contacts' => $contacts,
                'targets' => $targets,
            ];
        }

        return Renderer::make('pages/country', [
            'personByCountry' => $personByCountry,
            'countries' => $countries,
        ]);
    }
}
