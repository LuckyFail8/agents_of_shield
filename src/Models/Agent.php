<?php

namespace App\Models;

use PDO;
use App\Models\AbstractPerson;

class Agent extends AbstractPerson
{

    private ?string $identificationCode = null;

    public function setIdentificationCode(): self
    {
        if (!isset($this->identificationCode)) {
            $ExistingIdentificationCode = $this->getExistingIdentificationCode();
            if ($ExistingIdentificationCode) {
                $this->identificationCode = $ExistingIdentificationCode;
            } else {
                $prefix = substr($this->name, 0, 2);
                $suffix = substr($this->lastName, -2, 2);
                $random_number = str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
                $this->identificationCode = strtoupper($prefix . $suffix . $random_number);

                $this->updateIdentificationCode();
            }
        }
        return $this;
    }
    public function getIdentificationCode(): string
    {
        return $this->identificationCode;
    }
    public function getExistingIdentificationCode(): string
    {
        $statement = $this->getPDO()->prepare("SELECT identification_code FROM agent WHERE id = :id");
        $statement->bindValue(":id", $this->getId());
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['identification_code'] : null;
    }
    public function updateIdentificationCode(): void
    {
        $statement = $this->getPDO()->prepare("UPDATE agent SET identification_code = :identification_code WHERE id = :id");
        $statement->bindValue(":identification_code", $this->identificationCode);
        $statement->bindValue(":id", $this->getId());
        $statement->execute();
    }
}
