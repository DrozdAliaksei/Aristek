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
        #echo 'User_method_get_list'.PHP_EOL;
        return $this->connection->fetchAll($sql);
    }
}
