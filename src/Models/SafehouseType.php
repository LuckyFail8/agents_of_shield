<?php

namespace App\Models;

use PDO;

class SafehouseType extends Model
{
    public ?int $id = null;
    public ?string $name = null;
    public array $safehouse = [];

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

    public function getAssociatedSafehouse(): array
    {
        $statement = $this->getPDO()->prepare("SELECT * FROM safehouse WHERE safehouse_type_id = :id");
        $statement->bindValue(":id", $this->getId());
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
