<?php

namespace Models;

use PDO;

class Country extends Model
{
    public ?int $id = null;
    public ?string $name = null;
    public ?array $mission = null;
    public ?array $agent = null;
    public ?array $contact = null;
    public ?array $target = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getMission(): ?array
    {
        $statement = $this->getPDO()->prepare("SELECT * FROM mission WHERE country_id = :country_id");
        $statement->bindValue(":country_id", $this->getId());
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function setMission(?array $mission): self
    {
        $this->mission = $mission;
        return $this;
    }

    public function getAgent(): ?array
    {
        $statement = $this->getPDO()->prepare("SELECT * FROM person WHERE country_id = :country_id AND person_type = 'agent'");
        $statement->bindValue(":country_id", $this->getId());
        $statement->execute();
        $agents = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $agents;
    }
    public function setAgent(?array $agent): self
    {
        $this->agent = $agent;
        return $this;
    }

    public function getContact(): ?array
    {
        $statement = $this->getPDO()->prepare("SELECT * FROM person WHERE country_id = :country_id AND person_type = 'contact'");
        $statement->bindValue(":country_id", $this->getId());
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function setContact(?array $contact): self
    {
        $this->contact = $contact;
        return $this;
    }

    public function getTarget(): ?array
    {
        $statement = $this->getPDO()->prepare("SELECT * FROM person WHERE country_id = :country_id AND person_type = 'target'");
        $statement->bindValue(":country_id", $this->getId());
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function setTarget(?array $target): self
    {
        $this->target = $target;
        return $this;
    }
}
