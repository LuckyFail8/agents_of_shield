<?php

namespace App\Models;

use PDO;

class Country extends Model
{
    public ?int $id = null;
    public ?string $name = null;
    public ?array $mission = null;
    public ?array $agent = null;
    public ?array $contact = null;
    public ?array $target = null;
    public ?array $safehouse = null;

    public function getId(): ?int
    {
        return $this->id;
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
        $statement = $this->getPDO()->prepare("SELECT * FROM agent WHERE country_id = :country_id");
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
        $statement = $this->getPDO()->prepare("SELECT * FROM contact WHERE country_id = :country_id");
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
        $statement = $this->getPDO()->prepare("SELECT * FROM target WHERE country_id = :country_id");
        $statement->bindValue(":country_id", $this->getId());
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function setTarget(?array $target): self
    {
        $this->target = $target;
        return $this;
    }

    public function getSafehouse(): ?array
    {
        $statement = $this->getPDO()->prepare("SELECT * FROM safehouse WHERE country_id = :country_id");
        $statement->bindValue(":country_id", $this->getId());
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function setSafehouse(?array $safehouse): self
    {
        $this->safehouse = $safehouse;
        return $this;
    }
}
