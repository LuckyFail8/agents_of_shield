<?php

namespace App\Models;

use PDO;

class Safehouse extends Model
{
    public ?int $id = null;
    public ?string $name = null;
    public ?string $code = null;
    public ?string $adress = null;
    public ?array $mission = null;
    public ?int $safehouseTypeId = null;

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

    public function getCode(): ?string
    {
        return $this->code;
    }
    public function setCode(?string $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }
    public function setAdress(?string $adress): self
    {
        $this->adress = $adress;
        return $this;
    }




    public function getMission(): ?array
    {
        $statement = $this->getPDO()->prepare("
            SELECT m.* FROM mission m 
            INNER JOIN mission_safehouse ms ON m.id = ms.mission_id
            WHERE ms.safehouse_id = :id");
        $statement->bindValue(":id", $this->getId());
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function setMission(?array $mission): self
    {
        $this->mission = $mission;
        return $this;
    }


    public function getSafehouseTypeId(): ?int
    {
        return $this->safehouseTypeId;
    }
    public function setSafehouseTypeId(?int $safehouseTypeId): self
    {
        $this->safehouseTypeId = $safehouseTypeId;
        return $this;
    }

    public function getSafehouseType(): ?int
    {
        $statement = $this->getPDO()->prepare("SELECT * FROM safehouse_type WHERE id = :safehouse_type_id");
        $statement->bindValue(":safehouse_type_id", $this->getSafehouseTypeId());
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
