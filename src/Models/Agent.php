<?php

namespace App\Models;

use PDO;
use App\Models\AbstractPerson;

class Agent extends AbstractPerson
{
    public ?string $identificationCode = null;

    public function getIdentificationCode(): ?string
    {
        return $this->identificationCode;
    }

    public function setIdentificationCode(): self
    {
        if ($this->getExistingIdentificationCode() !== null) {
            if (!$this->checkIdentificationCode($this->getExistingIdentificationCode())) {
                $this->createIdentificationCode();
                $this->updateIdentificationCode();
            }
            return $this;
        } else {
            $this->createIdentificationCode();
        }

        return $this;
    }

    private function checkIdentificationCode(string $identificationCode): bool
    {
        $checkFirst4characts = preg_match('/[A-Z]/', substr($identificationCode, 0, 4));
        $checkLast3characts = preg_match('/[0-9]/', substr($identificationCode, 4, 3));

        if ($checkFirst4characts && $checkLast3characts) {
            return true;
        }
        return false;
    }

    private function createIdentificationCode(): string
    {
        $prefix = substr($this->name, 0, 2);
        $suffix = substr($this->lastName, -2, 2);
        $random_number = str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
        return $this->identificationCode = strtoupper($prefix . $suffix . $random_number);
    }

    private function getExistingIdentificationCode(): ?string
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
