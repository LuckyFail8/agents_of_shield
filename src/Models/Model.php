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

    public function where(string $column, int $value): array
    {
        $query = "SELECT * FROM {$this->table} WHERE $column = ?";
        $statement = $this->getPDO()->prepare($query);
        $statement->execute([$value]);
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

        $query = "INSERT INTO {$this->table} ($fieldsList) VALUES ($interList)";

        return $this->request($query, $values);
    }

    public function update(int $id, Model $model)
    {
        $fields = [];
        $values = [];

        foreach ($model as $field => $value) {
            if ($value !== null && $field !== "db" && $field !== "table") {
                $field = $this->camelCaseToSnakeCase($field);

                if ($value instanceof DateTime) {
                    $value = $value->format('Y-m-d');
                }
                $fields[] = "$field = ?";
                $values[] = $value;
            }
        }
        $values[] = $id;

        $fieldsList = implode(', ', $fields);

        $query = "UPDATE {$this->table} SET $fieldsList WHERE id = ?";

        return $this->request($query, $values);
    }

    public function delete(int $id)
    {
        return $this->request("DELETE FROM {$this->table} WHERE id = ?", [$id]);
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

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $setter = 'set' . ucfirst($key);

            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
        return $this;
    }

    private function camelCaseToSnakeCase(string $string): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $string));
    }
}
