<?php

namespace App\Models;

use App\Enums\MissionStatus;
use DateTime;
use PDO;

class Mission extends Model
{
    public ?int $id = null;
    public ?string $title = null;
    public ?string $description = null;
    public ?string $codeName = null;
    public ?DateTime $startDate = null;
    public ?DateTime $endDate = null;
    public ?string $status = null;
    public ?int $countryId = null;
    public ?int $missionTypeId = null;
    public ?int $specialityRequiredId = null;
    public array $agent = [];
    public array $contact = [];
    public array $target = [];
    public array $safehouse = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }
    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getCodeName(): ?string
    {
        return $this->codeName;
    }
    public function setCodeName(?string $codeName): self
    {
        $this->codeName = $codeName;
        return $this;
    }

    public function getStartDate(): ?DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(DateTime $startDate): self
    {
        $this->startDate = $startDate;
        return $this;
    }

    public function getEndDate(): ?DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(DateTime $endDate): self
    {
        $this->endDate = $endDate;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }
    public function setStatus(?string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getCountryId(): ?int
    {
        return $this->countryId;
    }
    public function setCountryId(?int $countryId): self
    {
        $this->countryId = $countryId;
        return $this;
    }

    public function getMissionTypeId(): ?int
    {
        return $this->missionTypeId;
    }
    public function setMissionTypeId(?int $missionTypeId): self
    {
        $this->missionTypeId = $missionTypeId;
        return $this;
    }

    public function getSpecialityRequiredId(): ?int
    {
        return $this->specialityRequiredId;
    }
    public function setSpecialityRequiredId(?int $specialityRequiredId): self
    {
        $this->specialityRequiredId = $specialityRequiredId;
        return $this;
    }

    public function getAgent(): array
    {
        if (!$this->agent) {
            $statement = $this->getPDO()->prepare("
            SELECT a.* FROM agent a 
            INNER JOIN mission_agent ma ON a.id = ma.agent_id
            WHERE ma.mission_id = :id");
            $statement->bindValue(":id", $this->getId());
            $statement->execute();
            $fetchedAgents = $statement->fetchAll(PDO::FETCH_ASSOC);

            $this->agent = $fetchedAgents;
        }
        return $this->agent;
    }
    public function setAgent(array $agent): self
    {
        $this->agent = $agent;
        return $this;
    }

    public function getContact(): array
    {
        if (!$this->agent) {
            $statement = $this->getPDO()->prepare("
            SELECT c.* FROM contact c 
            INNER JOIN mission_contact mc ON a.id = mc.contact_id
            WHERE mc.mission_id = :id");
            $statement->bindValue(":id", $this->getId());
            $statement->execute();
            $fetchedContacts = $statement->fetchAll(PDO::FETCH_ASSOC);

            $this->contact = $fetchedContacts;
        }
        return $this->contact;
    }
    public function setContact(array $contact): self
    {
        $this->contact = $contact;
        return $this;
    }

    public function getTarget(): array
    {
        if (!$this->target) {
            $statement = $this->getPDO()->prepare("
            SELECT t.* FROM target t 
            INNER JOIN mission_target mt ON a.id = mt.target_id
            WHERE mt.mission_id = :id");
            $statement->bindValue(":id", $this->getId());
            $statement->execute();
            $fetchedTargets = $statement->fetchAll(PDO::FETCH_ASSOC);

            $this->target = $fetchedTargets;
        }
        return $this->target;
    }
    public function setTarget(array $target): self
    {
        $this->target = $target;
        return $this;
    }

    public function getSafehouse(): array
    {
        if (!$this->safehouse) {
            $statement = $this->getPDO()->prepare("
            SELECT s.* FROM safehouse t 
            INNER JOIN mission_safehouse ms ON a.id = ms.safehouse_id
            WHERE ms.mission_id = :id");
            $statement->bindValue(":id", $this->getId());
            $statement->execute();
            $fetchedSafehouses = $statement->fetchAll(PDO::FETCH_ASSOC);

            $this->safehouse = $fetchedSafehouses;
        }
        return $this->safehouse;
    }
    public function setSafehouse(array $safehouse): self
    {
        $this->safehouse = $safehouse;
        return $this;
    }

    public function withStatus(MissionStatus $missionStatus): array
    {
        return $this->where('status', $missionStatus->value);
    }
}
