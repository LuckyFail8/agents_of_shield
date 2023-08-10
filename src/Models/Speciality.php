<?php

namespace App\Models;

use PDO;
use App\Models\Model;

class Speciality extends Model
{
    public ?int $id = null;
    public ?string $name = null;
    public array $agent = [];
    public array $mission = [];


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

    public function getAgent(): ?array
    {
        return $this->agent;
    }
    public function setAgent(?array $agent): self
    {
        $this->agent = $agent;
        return $this;
    }

    public function getMission(): ?array
    {
        return $this->mission;
    }
    public function setMission(?array $mission): self
    {
        $this->mission = $mission;
        return $this;
    }

    public function getAgentsBySpecialities(array $specialities): ?array
    {
        $placeholders = implode(', ', array_fill(0, count($specialities), ('?')));

        $statement = $this->getPDO()->prepare("
        SELECT a.*, p.*
        FROM agent a
        INNER JOIN speciality_agent AS sa ON a.id = sa.agent_id
        INNER JOIN speciality s ON sa.speciality_id = s.id
        INNER JOIN person p ON a.person_id = p.id
        WHERE s.name IN ($placeholders)
        GROUP BY a.id
        HAVING COUNT(DISTINCT s.id) = ?
        ");
        $statement->execute([...$specialities, count($specialities)]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getAgentsBySpeciality(): array
    {
        $statement = $this->getPDO()->prepare("
            SELECT a.* FROM agent a 
            INNER JOIN speciality_agent sa ON a.id = sa.agent_id
            WHERE sa.speciality_id = :id");
        $statement->bindValue(":id", $this->getId());
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMissionAssociated(): array
    {
        $statement = $this->getPDO()->prepare("SELECT * FROM mission WHERE speciality_required_id = :id");
        $statement->bindValue(":id", $this->getId());
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
