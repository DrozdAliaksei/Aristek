<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 1.11.18
 * Time: 17.53
 */

namespace Core\DB;

use RuntimeException;

class Connection
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * Connection constructor.
     *
     * @param array $database
     */
    public function __construct(array $database)
    {
        $pdo = new \PDO(sprintf($database['dsn']), sprintf($database['user']), sprintf($database['password']));
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->pdo = $pdo;
    }

    /**
     * @param string     $sql
     * @param array|null $properties
     * @param int        $fetchStyle
     *
     * @return mixed
     */
    public function fetch(string $sql, array $properties = null, $fetchStyle = \PDO::FETCH_ASSOC)
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($properties);

        return $statement->fetch($fetchStyle);
    }

    /**
     * @param string     $sql
     * @param array|null $properties
     *
     * @param int        $fetchStyle
     *
     * @return array
     */
    public function fetchAll(string $sql, array $properties = null, $fetchStyle = \PDO::FETCH_ASSOC): array
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($properties);

        return $statement->fetchAll($fetchStyle);
    }

    /**
     * @param string     $sql
     * @param array|null $properties
     */
    public function execute(string $sql, array $properties = null)
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($properties);
    }

    /**
     * @param            $sql
     * @param array|null $properties
     *
     * @return string
     * @throws \Exception
     */
    public function insert($sql, array $properties = null) :string
    {
        $statement = $this->pdo->prepare($sql);
        if($statement->execute($properties) ===  false){
            throw new RuntimeException(); //TODO rewrite
        }

        return $this->pdo->lastInsertId();
    }

    public function beginTransaction()
    {
        $this->pdo->beginTransaction();
    }

    public function commitTransaction()
    {
        $this->pdo->commit();
    }

    public function rollbackTransaction()
    {
        $this->pdo->rollBack();
    }

    /**
     * @return string
     */
    public function lastInsertId(): string
    {
        return $this->pdo->lastInsertId();
    }
}