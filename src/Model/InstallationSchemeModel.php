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
        $schems = array_map(
            function (array $scheme) {
                $scheme['role'] = json_decode($scheme['role']);

                return $scheme;
            },
            $schems
        );

        return $schems;
    }

    public function create(array $scheme)
    {
        $scheme['role'] = json_encode($scheme['role']);
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
        $scheme['role'] = json_encode($scheme['role']);
        $sql = 'UPDATE installation_scheme 
                SET room_id=:room_id,equipment_id=:equipment_id,displayable_name=:displayable_name,status=:status,role=:role 
                WHERE id=:id';
        $this->connection->execute($sql, $scheme);
    }

    public function checkScheme(string $room_id, string $equipment_id, int $id = null): bool
    {
        $properties = ['room_id' => $room_id, 'equipment_id' => $equipment_id];

        if (null === $id) {
            $sql = 'select id from installation_scheme where room_id=:room_id and equipment_id=:equipment_id';
        } else {
            $sql = 'select id from installation_scheme where room_id=:room_id and equipment_id=:equipment_id and id != :id';
            $properties['id'] = $id;
        }

        return (bool)$this->connection->fetch($sql, $properties, \PDO::FETCH_COLUMN);
    }

    public function getScheme(int $id): array
    {
        $sql = 'select * from installation_scheme where id = :id';
        $scheme = $this->connection->fetch($sql, ['id' => $id]);
        if ($scheme) {
            $scheme['role'] = json_decode($scheme['role']);
        }

        return $scheme;
    }

    public function changeStatus(int $id, int $status)
    {
        if ($status === 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        $sql = 'UPDATE installation_scheme
                SET status =:status 
                WHERE id =:id';
        $this->connection->execute($sql, ['id' => $id, 'status' => $status]);
    }

    public function getSchemesAvailableToRoles(array $roles): array
    {
        if (in_array('admin',$roles)) {
            return $this->getList();
        } else {
            $schemes = $this->getList();
            $result = [];
            foreach ($schemes as $scheme) {
                $acces = array_intersect($roles, $scheme['role']);
                if (count($acces) > 0) {
                    $result[] = $scheme;
                }
            }

            return $result;
        }
    }
}