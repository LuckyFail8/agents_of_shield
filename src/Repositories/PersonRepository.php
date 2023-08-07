<?php

namespace App\Repositories;

use PDO;

class PersonRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function getPersonName(string $tableName): array
    {
        $query = "SELECT p.name, p.last_name
                FROM person p
                JOIN $tableName t ON p.id = t.id_person";

        $statement = $this->pdo->prepare($query);
        return $statement->fetch();
    }
}
