<?php

namespace Models;

use Models\Model;
use Models\Traits\CodeNameGeneratorTrait;

class Target extends Person
{
    use CodeNameGeneratorTrait;
    private ?int $id = null;
    private ?string $name = null;
    private ?string $lastName = null;
    private ?string $country = null;
    private ?string $codeName = null;


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


    public function getCodeName(): ?string
    {
        return $this->codeName;
    }
}
