<?php

namespace Models\Traits;

use PDO;

trait CodeNameGeneratorTrait
{
    public function setCodeName(): self
    {
        if (!isset($this->codeName)) {
            $existingCodeName = $this->getExistingCodeName();
            if ($existingCodeName) {
                $this->codeName = $existingCodeName;
            } else {
                $prefix = substr($this->name, 0, 2);
                $suffix = substr($this->lastName, -2, 2);
                $random_number = str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
                $this->codeName = strtoupper($prefix . $suffix . $random_number . substr($this->table, 0, 1));

                $this->updateCodeName();
            }
        }
        return $this;
    }
    public function getExistingCodeName()
    {
        $statement = $this->getPDO()->prepare("SELECT code_name FROM {$this->table} WHERE id = :id");
        $statement->bindValue(":id", $this->getId());
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['code_name'] : null;
    }
    public function updateCodeName(): void
    {
        $statement = $this->getPDO()->prepare("UPDATE {$this->table} SET code_name = :code_name WHERE id = :id");
        $statement->bindValue(":code_name", $this->codeName);
        $statement->bindValue(":id", $this->getId());
        $statement->execute();
    }
}
