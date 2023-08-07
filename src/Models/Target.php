<?php

namespace App\Models;

use App\Models\AbstractPerson;
use App\Models\Traits\CodeNameGeneratorTrait;

class Target extends AbstractPerson
{
    use CodeNameGeneratorTrait;
    private ?string $codeName = null;

    public function getCodeName(): ?string
    {
        return $this->codeName;
    }
}
