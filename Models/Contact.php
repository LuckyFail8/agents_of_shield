<?php

namespace Models;

use Models\Model;

class Contact extends Model implements Person
{
    private ?int $id = null;
    private ?string $name = null;
    private ?string $lastName = null;
    private ?string $country = null;

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
}
