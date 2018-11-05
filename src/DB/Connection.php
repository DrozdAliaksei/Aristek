<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 1.11.18
 * Time: 17.53
 */
namespace DB;

class Connection
{
    public function fetchAll(string $sql, array $properties): array
    {   $host = 'localhost';
        $db = 'smart_home';
        $user = 'root';
        $pass = '1967';
        $charset = 'utf-8';
        try{
            $pdo = new PDO(
                "mysql:host=$host;dbname=$db;charset=$charset",
                $user,
                $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $result = $pdo->prepare(sql)->execute();
            return $result;
        }catch (PDOException $e){
            echo $e->getMessage();
        }

    }
}