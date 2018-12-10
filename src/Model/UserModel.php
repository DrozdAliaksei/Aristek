<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 1.11.18
 * Time: 17.53
 */

namespace Model;

use Core\DB\Connection;

class UserModel implements Model
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * User constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getList(): array
    {
        $sql = "SELECT * FROM users";
        $users = $this->connection->fetchAll($sql);
        $users = array_map(function (array $user) {
            $user['roles'] = json_decode($user['roles']);

            return $user;
        }, $users);

        return $users;
    }

    public function create(array $user)
    {
        $user['roles'] = json_encode($user['roles']);
        $sql = "INSERT INTO users (login,password,roles) 
                VALUES (:login,:password,:roles)";
        $this->connection->execute($sql, $user);

    }

    public function delete(int $id)
    {
        $sql = 'DELETE FROM users WHERE id = :id';
        $this->connection->execute($sql, ['id' => $id]);
    }

    public function edit(array $user, int $id)
    {
        $user['id'] = $id;
        $user['roles'] = json_encode($user['roles']);
        $sql = 'UPDATE users SET login=:login,password=:password,roles=:roles WHERE id=:id';
        $this->connection->execute($sql, $user);
    }

    public function checkLogin(string $login, int $id = null): bool
    {
        $properties = ['login' => $login];
        if (null === $id) {
            $sql = 'select id from users where login=:login';
        } else {
            $sql = 'select id from users where login=:login and id != :id';
            $properties['id'] = $id;
        }

        return (bool)$this->connection->fetch($sql, $properties, \PDO::FETCH_COLUMN);
    }

    public function getUser(int $id): array
    {
        $sql = 'select * from users where id = :id';
        $user = $this->connection->fetch($sql, ['id' => $id]);
        $user['roles'] = json_decode($user['roles']);

        return $user;
    }
}
