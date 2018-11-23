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
        $sql = "SELECT * FROM users WHERE 1";
        #echo 'UserModel_method_get_list'.PHP_EOL;
        return $this->connection->fetchAll($sql);
        //ToDo rewrite
    }

    public function create(array $user)
    {
        $user['roles'] = json_encode($user['roles']);
        $sql = "INSERT INTO users  (login,password,roles) 
                VALUES (:login,:password,:roles)";
        #echo 'UserModel_addUser'.PHP_EOL;
        $this->connection->execute($sql,$user);

    }
}
