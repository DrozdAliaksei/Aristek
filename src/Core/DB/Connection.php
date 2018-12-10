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
    public function __construct(array $database)
    {
        $pdo = new \PDO(sprintf($database['dsn']), sprintf($database['user']), sprintf($database['password']));
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->pdo = $pdo;
    }

    /**
     * @param string $sql
     * @param array|null $properties
     * @param int $fetchStyle
     * @return mixed
     */
    public function fetch(string $sql, array $properties = null, $fetchStyle = \PDO::FETCH_ASSOC)
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($properties);

        return $statement->fetch($fetchStyle);
    }

    /**
     * @param string $sql
     * @param array|null $properties
     * @return array
     */
    public function fetchAll(string $sql, array $properties = null, $fetchStyle = \PDO::FETCH_ASSOC): array
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($properties);

        return $statement->fetchAll($fetchStyle);
    }

    public function execute(string $sql, array $properties = null)
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($properties);
    }
}