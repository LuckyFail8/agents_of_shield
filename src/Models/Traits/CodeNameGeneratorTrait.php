<?php

namespace App\Models\Traits;

use PDO;

trait CodeNameGeneratorTrait
{
    public function setCodeName(): self
    {
        if ($this->getExistingCodeName() !== null) {
            if (!$this->checkCodeName($this->getExistingCodeName())) {
                $this->createCodeName();
                $this->updateCodeName();
            }
            return $this;
        } else {
            $this->createCodeName();
        }
        return $this;
    }
    private function createCodeName(): string
    {
        $prefix = substr($this->name, 0, 2);
        $suffix = substr($this->lastName, -2, 2);
        $random_number = str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
        return $this->codeName = strtoupper($prefix . $suffix . $random_number . substr($this->table, 0, 1));
    }
    public function getExistingCodeName(): ?string
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

    private function checkCodeName(string $codeName): bool
    {
        $checkFirst4characts = preg_match('/[A-Z]/', substr($codeName, 0, 4));
        $checkLast3characts = preg_match('/[0-9]/', substr($codeName, 4, 3));

        if ($checkFirst4characts && $checkLast3characts) {
            return true;
        }
        return false;
    }
}
