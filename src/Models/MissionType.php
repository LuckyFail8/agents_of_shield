<?php

namespace App\Models;

use PDO;

class MissionType extends Model
{
    public ?int $id = null;
    public ?string $name = null;
    public array $mission = [];

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

    public function getAssociatedMission(): array
    {
        $statement = $this->getPDO()->prepare("SELECT * FROM mission WHERE mission_type_id = :id");
        $statement->bindValue(":id", $this->getId());
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
