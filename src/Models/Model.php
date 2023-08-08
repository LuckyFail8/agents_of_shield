<?php

namespace App\Models;

use DateTime;
use App\Database\DBConnection;

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

    public function findBy(array $criteria)
    {
        $fields = [];
        $values = [];

        foreach ($criteria as $field => $value) {
            $fields[] = "$field = ?";
            $values[] = $value;
        }
        $fieldsList = implode(' AND ', $fields);
        $query = "SELECT * FROM {$this->table} WHERE $fieldsList";
        $statement = $this->getPDO()->prepare($query);
        $statement->execute($values);
        return $statement->fetchAll();
    }

    public function find(int $id)
    {
        return $this->getPDO()->query("SELECT * FROM {$this->table} WHERE id = $id")->fetchAll();
    }

    public function findID()
    {
        $query = "SELECT id FROM $this->table";
        $statement = $this->getPDO()->query($query);
        return $statement->fetchAll();
    }

    public function create(Model $model)
    {
        $fields = [];
        $inter = [];
        $values = [];

        foreach ($model as $field => $value) {
            if ($value !== null && $field !== "db" && $field !== "table") {
                $field = $this->camelCaseToSnakeCase($field);

                if ($value instanceof DateTime) {
                    $value = $value->format('Y-m-d');
                }
                $fields[] = $field;
                $inter[] = "?";
                $values[] = $value;
            }
        }
        $fieldsList = implode(', ', $fields);
        $interList = implode(', ', $inter);
        var_dump($fieldsList);

        $query = "INSERT INTO {$this->table} ($fieldsList) VALUES ($interList)";

        return $this->request($query, $values);
    }

    public function request(string $sql, array $attributs = null)
    {
        if ($attributs !== null) {
            $query = $this->getPDO()->prepare($sql);
            $query->execute($attributs);
            return $query;
        } else {
            return $this->getPDO()->query($sql);
        }
    }

    private function camelCaseToSnakeCase(string $string): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $string));
    }
}
