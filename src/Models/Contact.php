<?php

namespace App\Models;

use App\Models\AbstractPerson;
use App\Models\Traits\CodeNameGeneratorTrait;

class Contact extends AbstractPerson
{
    use CodeNameGeneratorTrait;
    private ?string $codeName = null;

    public function getCodeName(): string
    {
        return $this->codeName;
    }
}
