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
        $sql = "SELECT installation_scheme.id,rooms.name,equipments.name,displayable_name,status,role
        FROM installation_scheme 
        INNER JOIN rooms ON installation_scheme.room_id = rooms.id
        INNER JOIN equipments ON installation_scheme.equipment_id = equipments.id";
        $schems = $this->connection->fetchAll($sql);

        return $schems;
    }

}