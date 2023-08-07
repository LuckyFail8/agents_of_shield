<?php

namespace App\Models;

use App\Constant;
use App\Database\DBConnection;
use PDO;
use PDOException;

class Model extends DBConnection
{
    public function findAll(): array
    {
        $statement = $this->getPDO()->query("SELECT * FROM {$this->table}");
        return $statement->fetchAll();
    }
    public function findByID($id): array
    {
        $statement = $this->getPDO()->query("SELECT * FROM {$this->table} WHERE id = $id");
        return [$statement->fetch()];
    }

    public function findID()
    {
        $query = "SELECT id FROM $this->table";
        $statement = $this->getPDO()->query($query);
        return $statement->fetchAll();
    }
}
