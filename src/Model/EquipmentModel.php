<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 10.12.18
 * Time: 15:49
 */

namespace Model;

use Core\DB\Connection;

class EquipmentModel
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * EquipmentModel constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getList(): array
    {
        $sql = "SELECT * FROM equipments";
        $equipments = $this->connection->fetchAll($sql);

        return $equipments;
    }

    public function create(array $equipment)
    {
        $sql = "INSERT INTO equipments (name,description) 
                VALUES (:name,:description)";
        $this->connection->execute($sql, $equipment);

    }

    public function delete(int $id)
    {
        $sql = 'DELETE FROM equipments WHERE id = :id';
        $this->connection->execute($sql, ['id' => $id]);
    }

    public function edit(array $equipment, int $id)
    {
        $equipment['id'] = $id;
        $sql = 'UPDATE equipments SET name=:name,description=:description WHERE id=:id';
        $this->connection->execute($sql, $equipment);
    }

    public function checkName(string $name, int $id = null): bool
    {
        $properties = ['name' => $name];
        if (null === $id) {
            $sql = 'select id from equipments where name=:name';
        } else {
            $sql = 'select id from equipments where name=:name and id != :id';
            $properties['id'] = $id;
        }

        return (bool)$this->connection->fetch($sql, $properties, \PDO::FETCH_COLUMN);
    }

    public function getEquipment(int $id): array
    {
        $sql = 'select * from equipments where id = :id';
        $equipment = $this->connection->fetch($sql, ['id' => $id]);

        return $equipment;
    }
}