<?php

namespace App\Models;

abstract class AbstractPerson extends Model
{
    protected ?int $id = null;
    protected ?string $name = null;
    protected ?string $lastName = null;
    protected ?string $country = null;

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
