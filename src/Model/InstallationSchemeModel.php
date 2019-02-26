<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 10.12.18
 * Time: 17:15
 */

namespace Model;

use Core\DB\Connection;
use Enum\RolesEnum;

class InstallationSchemeModel
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * InstallationScheme constructor.
     *
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
        $sql = 'SELECT installation_scheme.id,rooms.name AS room_name,equipments.name AS equipment_name,displayable_name,status
        FROM installation_scheme 
        INNER JOIN rooms ON installation_scheme.room_id = rooms.id
        INNER JOIN equipments ON installation_scheme.equipment_id = equipments.id';

        return $this->connection->fetchAll($sql);
    }

    /**
     * @param array $scheme
     *
     * @throws \Exception
     */
    public function create(array $scheme)
    {
        try {
            $this->connection->beginTransaction();
            $sql = 'INSERT INTO installation_scheme (room_id, equipment_id, displayable_name, status)
                VALUES (:room_id,:equipment_id,:displayable_name,:status);';
            $schemeId =
                $this->connection->insert(
                    $sql,
                    [
                        'room_id'          => $scheme['room_id'],
                        'equipment_id'     => $scheme['equipment_id'],
                        'displayable_name' => $scheme['displayable_name'],
                        'status'           => $scheme['status'],
                    ]
                );

            foreach ($scheme['role'] as $role) {
                $sql = ' INSERT INTO installation_scheme_roles (installation_scheme_id, role)
                 VALUES (:installation_scheme_id,:role);';
                $this->connection->execute($sql, ['installation_scheme_id' => $schemeId, 'role' => $role]);
            }

            $this->connection->commitTransaction();
        } catch (\Exception $exception) {
            echo $exception;
            $this->connection->rollbackTransaction();
        }
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        try {
            $this->connection->beginTransaction();

            $sql = 'DELETE FROM installation_scheme_roles
                WHERE installation_scheme_id = :id';
            $this->connection->execute($sql, ['id' => $id]);

            $sql = 'DELETE FROM installation_scheme 
                WHERE id = :id';
            $this->connection->execute($sql, ['id' => $id]);

            $this->connection->commitTransaction();
        } catch (\Exception $exception) {
            echo $exception;
            $this->connection->rollbackTransaction();
        }
    }

    /**
     * @param array $scheme
     * @param int   $id
     */
    public function edit(array $scheme, int $id)
    {
        $scheme['id'] = $id;

        try {
            $this->connection->beginTransaction();

            $sql = 'UPDATE installation_scheme 
                SET room_id=:room_id,equipment_id=:equipment_id,displayable_name=:displayable_name,status=:status
                WHERE id=:id';
            $this->connection->execute(
                $sql,
                [
                    'room_id'          => $scheme['room_id'],
                    'equipment_id'     => $scheme['equipment_id'],
                    'displayable_name' => $scheme['displayable_name'],
                    'status'           => $scheme['status'],
                    'id'               => $scheme['id'],
                ]
            );

            $sql = 'DELETE FROM installation_scheme_roles WHERE installation_scheme_id = :id';
            $this->connection->execute($sql, ['id' => $id]);

            foreach ($scheme['role'] as $role) {
                $sql = ' INSERT INTO installation_scheme_roles (installation_scheme_id, role)
                 VALUES (:installation_scheme_id,:role);';

                $this->connection->execute($sql, ['installation_scheme_id' => $id, 'role' => $role]);
            }

            $this->connection->commitTransaction();
        } catch (\Exception $exception) {
            echo $exception;
        }
    }

    /**
     * @param string   $room_id
     * @param string   $equipment_id
     * @param int|null $id
     *
     * @return bool
     */
    public function checkScheme(string $room_id, string $equipment_id, int $id = null): bool
    {
        $properties = ['room_id' => $room_id, 'equipment_id' => $equipment_id];

        if (null === $id) {
            $sql = 'SELECT id FROM installation_scheme WHERE room_id=:room_id AND equipment_id=:equipment_id';
        } else {
            $sql = 'SELECT id FROM installation_scheme WHERE room_id=:room_id AND equipment_id=:equipment_id AND id != :id';
            $properties['id'] = $id;
        }

        return (bool) $this->connection->fetch($sql, $properties, \PDO::FETCH_COLUMN);
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function getScheme(int $id): array
    {
        $sql = 'SELECT * FROM installation_scheme WHERE id = :id';
        $scheme = $this->connection->fetch($sql, ['id' => $id]);
        if ($scheme) {
            $sql = 'SELECT * FROM installation_scheme_roles WHERE installation_scheme_id = :id';
            $roles = $this->connection->fetchAll($sql, ['id' => $id]);

            $scheme_roles = [];
            foreach ($roles as $role) {
                $scheme_roles[] = $role['role'];
            }
            $scheme['role'] = $scheme_roles;
        }

        return $scheme;
    }

    /**
     * @param int $id
     * @param int $status
     */
    public function changeStatus(int $id, int $status)
    {
        $sql = 'UPDATE installation_scheme
                SET status =:status 
                WHERE id =:id';
        $this->connection->execute($sql, ['id' => $id, 'status' => $status]);
    }

    /**
     * @param string $role
     *
     * @return array
     */
    public function getSchemesAvailableToRoles(string $role): array
    {
        if (RolesEnum::ADMIN === $role) {
            return $this->getList();
        }
        $sql =
            'SELECT installation_scheme.id,rooms.name AS room_name,equipments.name AS equipment_name,displayable_name,status
            FROM installation_scheme
            INNER JOIN rooms ON installation_scheme.room_id = rooms.id
            INNER JOIN equipments ON installation_scheme.equipment_id = equipments.id
            INNER JOIN installation_scheme_roles ON installation_scheme.id = installation_scheme_roles.installation_scheme_id
            WHERE installation_scheme_roles.role =:role
            GROUP BY installation_scheme.id';

        return $this->connection->fetchAll($sql, ['role' => $role]);
    }
}