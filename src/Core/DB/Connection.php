<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 1.11.18
 * Time: 17.53
 */

namespace Core\DB;

class Connection
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * Connection constructor.
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param string $sql
     * @param array|null $properties
     * @return array
     */
    public function fetchAll(string $sql, array $properties = null): array
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($properties);

        return $statement->fetchAll();
    }
}