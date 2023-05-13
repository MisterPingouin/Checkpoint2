<?php

namespace App\Model;

use PDO;

class AccessoryManager extends AbstractManager
{
    public const TABLE = 'accessory';

    public function insertAccessory(string $name, string $url): void
    {

        // PDO statements
        $dbFields = '(`name`, `url`)';
        $placeholderFields = '(:name, :url)';
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " $dbFields VALUES $placeholderFields");
        $statement->bindValue('name', $name, PDO::PARAM_STR);
        $statement->bindValue('url', $url, PDO::PARAM_STR);
        $statement->execute();
    }

    
}