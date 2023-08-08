<?php

namespace App\Models;

use DateTime;

abstract class AbstractPerson extends Model
{
    protected ?int $id = null;
    protected ?string $name = null;
    protected ?string $lastName = null;
    protected ?DateTime $dateOfBirth = null;
    protected ?int $countryId = null;

    public function getId(): ?int
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

    public function getDateOfBirth(): ?DateTime
    {
        return $this->dateOfBirth;
    }
    /**
     * set the date of birth for the person.
     *
     * @param  string $dateOfBirth The date of birth in the format 'YYYY-mm-dd'.
     * @return self
     */
    public function setDateOfBirth(string $dateOfBirth): self
    {
        $this->dateOfBirth = new DateTime($dateOfBirth);
        return $this;
    }

    public function setCountryID(string|int $countryId): self
    {
        $this->countryId = $countryId;

        return $this;
    }
    public function getCountryId(): string
    {
        return $this->countryId;
    }
}
