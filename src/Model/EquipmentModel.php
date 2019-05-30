<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 10.12.18
 * Time: 15:49
 */

namespace Model;

use Core\DB\Connection;
use Core\Form\FormInterface;

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

    /**
     * @return array
     */
    public function getList(): array
    {
        $sql = 'SELECT * FROM equipments';

        return $this->connection->fetchAll($sql);
    }

    /**
     * @param array $equipment
     */
    public function create(array $equipment)
    {
        $sql = 'INSERT INTO equipments (name,description,BCM_GPIO) 
                VALUES (:name,:description,:BCM_GPIO)';
        $this->connection->execute($sql, $equipment);

    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $sql = 'DELETE FROM equipments WHERE id = :id';
        $this->connection->execute($sql, ['id' => $id]);
    }

    /**
     * @param array $equipment
     * @param int   $id
     */
    public function edit(array $equipment, int $id)
    {
        $equipment['id'] = $id;
        $sql = 'UPDATE equipments SET name=:name,description=:description, BCM_GPIO=:BCM_GPIO WHERE id=:id';
        $this->connection->execute($sql, $equipment);
    }

    /**
     * @param string   $name
     * @param int|null $id
     *
     * @return bool
     */
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

    /**
     * @param int $id
     *
     * @return array
     */
    public function getEquipment(int $id): array
    {
        $sql = 'select * from equipments where id = :id';

        return $this->connection->fetch($sql, ['id' => $id]) ?: null;
    }

    /**
     * @return array
     */
    public function getEquipments() : array
    {
        $sql = 'SELECT id,name FROM equipments';

        return $this->connection->fetchAll($sql);
    }
}