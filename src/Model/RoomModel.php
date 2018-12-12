<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 10.12.18
 * Time: 12:43
 */

namespace Model;

use Core\DB\Connection;

class RoomModel implements Model
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * RoomModel constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getList(): array
    {
        $sql = "SELECT * FROM rooms";
        $rooms = $this->connection->fetchAll($sql);

        return $rooms;
    }

    public function create(array $room)
    {
        $sql = "INSERT INTO rooms (name,description) 
                VALUES (:name,:description)";
        $this->connection->execute($sql, $room);

    }

    public function delete(int $id)
    {
        $sql = 'DELETE FROM rooms WHERE id = :id';
        $this->connection->execute($sql, ['id' => $id]);
    }

    public function edit(array $room, int $id)
    {
        $room['id'] = $id;
        $sql = 'UPDATE rooms SET name=:name,description=:description WHERE id=:id';
        $this->connection->execute($sql, $room);
    }

    public function checkName(string $name, int $id = null): bool
    {
        $properties = ['name' => $name];
        if (null === $id) {
            $sql = 'select id from rooms where name=:name';
        } else {
            $sql = 'select id from rooms where name=:name and id != :id';
            $properties['id'] = $id;
        }

        return (bool)$this->connection->fetch($sql, $properties, \PDO::FETCH_COLUMN);
    }

    public function getRoom(int $id): array
    {
        $sql = 'select * from rooms where id = :id';
        $room = $this->connection->fetch($sql, ['id' => $id]);

        return $room;
    }

    public function getRooms(): array
    {
        $sql = 'SELECT id,name FROM rooms';

        return $this->connection->fetchAll($sql);
    }
}