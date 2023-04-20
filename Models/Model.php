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

    public function all(): array
    {
        $statement = $this->getPDO()->query("SELECT * FROM {$this->table}");
        return $statement->fetchAll();
    }

    protected function getPDO(): PDO
    {
        return static::$pdo;
    }
}
