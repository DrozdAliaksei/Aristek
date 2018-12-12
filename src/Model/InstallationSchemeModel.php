<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 10.12.18
 * Time: 17:15
 */

namespace Model;

use Core\DB\Connection;

class InstallationSchemeModel
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * InstallationScheme constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getList(): array
    {
        $sql = "SELECT installation_scheme.id,rooms.name AS room_name,equipments.name AS equipment_name,displayable_name,status,role
        FROM installation_scheme 
        INNER JOIN rooms ON installation_scheme.room_id = rooms.id
        INNER JOIN equipments ON installation_scheme.equipment_id = equipments.id";
        $schems = $this->connection->fetchAll($sql);

        return $schems;
    }

    public function create(array $scheme)
    {
        $sql = "INSERT INTO installation_scheme (room_id, equipment_id, displayable_name, status, role) 
                VALUES (:room_id,:equipment_id,:displayable_name, :status, :role)";
        $this->connection->execute($sql, $scheme);

    }

    public function delete(int $id)
    {
        $sql = 'DELETE FROM installation_scheme 
                WHERE id = :id';
        $this->connection->execute($sql, ['id' => $id]);
    }

    public function edit(array $scheme, int $id)
    {
        $scheme['id'] = $id;
        $sql = 'UPDATE installation_scheme 
                SET room_id=:room_id,equipment_id=:equipment_id,displayable_name=:displayable_name,status=:status,role=:role 
                WHERE id=:id';
        $this->connection->execute($sql, $scheme);
    }

    public function check(string $smth, int $id = null): bool
    {
        $properties = ['smth' => $smth];
        if (null === $id) {
            $sql = 'select id from installation_scheme where smth=:smth';
        } else {
            $sql = 'select id from installation_scheme where smth=:smth and id != :id';
            $properties['id'] = $id;
        }

        return (bool)$this->connection->fetch($sql, $properties, \PDO::FETCH_COLUMN);
    }

    public function getScheme(int $id): array
    {
        $sql = 'select * from installation_scheme where id = :id';
        $scheme = $this->connection->fetch($sql, ['id' => $id]);

        return $scheme;
    }
}