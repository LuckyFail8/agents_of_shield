<?php

namespace Models;

use Models\Model;
use PDO;

class Agent extends Model implements Person
{
    private ?int $id = null;
    private ?string $name = null;
    private ?string $lastName = null;
    private ?string $country = null;
    private ?string $identificationCode = null;

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }
    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setCountry(string|int $country): self
    {
        $this->country = $country;

        return $this;
    }
    public function getCountry(): string
    {
        return $this->country;
    }

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
