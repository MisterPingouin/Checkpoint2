<?php

namespace App\Model;

use PDO;

class CupcakeManager extends AbstractManager
{
    public const TABLE = 'cupcake';

    public function insertCupcake(string $name, string $color1, string $color2, string $color3, int $accessory_id): void
    {
        $created_at = date('Y-m-d H:i:s');

        // PDO statements
        $dbFields = '(`name`, `color1`, `color2`, `color3`, `accessory_id`, `created_at`)';
        $placeholderFields = '(:name, :color1, :color2, :color3, :accessory_id, :created_at)';
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " $dbFields VALUES $placeholderFields");
        $statement->bindValue('name', $name, PDO::PARAM_STR);
        $statement->bindValue('color1', $color1, PDO::PARAM_STR);
        $statement->bindValue('color2', $color2, PDO::PARAM_STR);
        $statement->bindValue('color3', $color3, PDO::PARAM_STR);
        $statement->bindValue('accessory_id', $accessory_id, PDO::PARAM_INT);
        $statement->bindValue('created_at', $created_at, PDO::PARAM_STR);
        $statement->execute();
    }

    public function selectAllCupcake(string $orderBy = '', string $direction = 'DESC'): array
{
    $query = 'SELECT cupcake.*, accessory.name AS accessory_name, accessory.url AS url FROM ' . static::TABLE;
    $query .= ' JOIN accessory ON cupcake.accessory_id = accessory.id';
    if ($orderBy) {
        $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
    }

    return $this->pdo->query($query)->fetchAll();
}

public function selectCupcakeById(int $id): array
{
    $query = 'SELECT cupcake.*, accessory.name AS accessory_name, accessory.url AS url FROM ' . static::TABLE;
    $query .= ' JOIN accessory ON cupcake.accessory_id = accessory.id';
    $query .= ' WHERE cupcake.id = :id';
    $statement = $this->pdo->prepare($query);
    $statement->bindValue('id', $id, PDO::PARAM_INT);
    $statement->execute();

    return $statement->fetch();
}
}
