<?php

namespace Models;

use App\Constant;
use PDO;
use PDOException;

class Model
{
    protected static PDO $pdo;
    protected string $table;

    public function __construct()
    {
        try {
            static::$pdo = new PDO(
                'mysql:dbname=' . Constant::DB_NAME . ';host=' . Constant::DB_HOST,
                Constant::DB_USERNAME,
                Constant::DB_PASSWORD,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                ]
            );
        } catch (PDOException $e) {
            $e->getMessage();
            die();
        }
        $this->table = strtolower(explode('\\', get_class($this))[1]);
    }

    protected function getPDO(): PDO
    {
        return static::$pdo;
    }

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

    public function getAllPersonType(): array
    {
        $query = "SELECT t.id as {$this->table}_id, t.*, p.id as person_id, p.*, c.name AS country_name, c.id AS country_id
                FROM $this->table t
                JOIN person p ON t.person_id = p.id
                LEFT JOIN country c ON p.country_id = c.id
                ";
        $statement = $this->getPDO()->query($query);
        return $statement->fetchAll();
    }

    public function findID()
    {
        $query = "SELECT id FROM $this->table";
        $statement = $this->getPDO()->query($query);
        return $statement->fetchAll();
    }
}
