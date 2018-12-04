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
        $sql = "SELECT * FROM users ";
        return $this->connection->fetchAll($sql);
        //ToDo rewrite
    }

    public function create(array $user)
    {
        $user['roles'] = json_encode($user['roles']);
        $sql = "INSERT INTO users  (login,password,roles) 
                VALUES (:login,:password,:roles)";
        $this->connection->execute($sql,$user);

    }

    public function delete($params)
    {
        $sql = sprintf('DELETE FROM users WHERE id = %s', $params);
        $this->connection->execute($sql);
    }

    public function edit(array $user)
    {
        $user['roles'] = json_encode($user['roles']);
        $sql = "UPDATE users (login,password,roles) 
                SET (:login,:password,:roles)
                WHERE id = (:id)";
        $this->connection->execute($sql,$user);
    }

    public function checkLogin (string $login)
    {
        $sql = sprintf("select login from users where login='%s'", $login);
        $login_ = $this->connection->fetchAll($sql);
        if (count($login_) === 0) return false;
        return true;
    }
    public function getUser(int $id)
    {
        $sql = sprintf('select * from users where id = %s', $id);
        $user = $this->connection->fetchAll($sql);
        return $user[0];
    }
}
