<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 1.11.18
 * Time: 17.53
 */

namespace Model;

use Core\DB\Connection;
use Core\Security\PasswordHelper;
use Core\Security\StringBuilder;
use Enum\RolesEnum;

class UserModel
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var PasswordHelper
     */
    private $passwordHelper;

    /**
     * @var StringBuilder
     */
    private $stringBuilder;

    /**
     * User constructor.
     *
     * @param Connection     $connection
     * @param PasswordHelper $passwordHelper
     * @param StringBuilder  $stringBuilder
     */
    public function __construct(Connection $connection, PasswordHelper $passwordHelper, StringBuilder $stringBuilder)
    {
        $this->connection = $connection;
        $this->passwordHelper = $passwordHelper;
        $this->stringBuilder = $stringBuilder;
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function getList(array $params = []): array
    {
        $sql = 'SELECT * FROM users ';
        $sql = $this->prepareQuery($sql, $params);

        return $this->connection->fetchAll($sql);
    }

    /**
     * @param array $params
     *
     * @return int
     */
    public function getCountOfPages(array $params): int
    {

        $limit = $params['page']['limit'];
        $sql = 'SELECT COUNT(1) FROM users';
        unset($params['page']);
        $sql = $this->prepareQuery($sql, $params);

        return ceil($this->connection->fetch($sql, null, \PDO::FETCH_COLUMN) / $limit);
    }

    /**
     * @param array $user
     */
    public function create(array $user)
    {
        $user = $this->preparePassword($user);
        $sql = 'INSERT INTO users (login,password,role) 
                VALUES (:login,:password,:role)';
        $this->connection->execute($sql, $user);
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        if ($this->getUser($id)['role'] === RolesEnum::ADMIN && (int) $this->getCountOfAdmins() === 1) {
            throw new \LogicException('Can not delete last admin');
        }

        $sql = 'DELETE FROM users WHERE id = :id';
        $this->connection->execute($sql, ['id' => $id]);
    }

    /**
     * @param array $user
     * @param int   $id
     */
    public function edit(array $user, int $id)
    {
        $user = $this->preparePassword($user);
        $user['id'] = $id;
        $sql = 'UPDATE users SET login=:login,password=:password,role=:role WHERE id=:id';
        $this->connection->execute($sql, $user);
    }

    /**
     * @param string   $login
     * @param int|null $id
     *
     * @return bool
     */
    public function checkLogin(string $login, int $id = null): bool
    {
        $properties = ['login' => $login];
        if (null === $id) {
            $sql = 'SELECT id FROM users WHERE login=:login';
        } else {
            $sql = 'SELECT id FROM users WHERE login=:login AND id != :id';
            $properties['id'] = $id;
        }

        return (bool) $this->connection->fetch($sql, $properties, \PDO::FETCH_COLUMN);
    }

    /**
     * @param int $id
     *
     * @return null
     */
    public function getUser(int $id)
    {
        $sql = 'SELECT * FROM users WHERE id = :id';
        $user = $this->connection->fetch($sql, ['id' => $id]);

        return $user ?: null;
    }

    /**
     * @param $login
     *
     * @return null
     */
    public function findByLogin($login)
    {
        $sql = 'SELECT * FROM users WHERE login=:login';
        $user = $this->connection->fetch($sql, ['login' => $login]);

        return $user ?: null;
    }

    /**
     * @param array $user
     * @param int   $id
     */
    public function changePassword(array $user, int $id)
    {
        $user['id'] = $id;
        $user = $this->preparePassword($user);
        $sql = 'UPDATE users SET password=:password WHERE id=:id';
        $this->connection->execute($sql, $user);
    }

    /**
     * @param array $user
     *
     * @return array
     */
    private function preparePassword(array $user): array
    {
        if ($user['plain_password']) {
            $password = $user['password'] ?? null;
            if ($password) {
                $salt = $this->passwordHelper->getSaltPart($password);
            } else {
                $salt = $this->stringBuilder->build(5);
            }
            $hash = $this->passwordHelper->getHash($user['plain_password'], $salt);
            $user['password'] = $this->passwordHelper->createToken($salt, $hash);
        }
        unset($user['plain_password']);

        return $user;
    }

    /**
     * @return int
     */
    public function getCountOfAdmins()
    {
        $sql = 'SELECT COUNT(1) FROM users WHERE role =:role';

        return $this->connection->fetch($sql, ['role' => RolesEnum::ADMIN], \PDO::FETCH_COLUMN);
    }

    /**
     * @param string $sql
     * @param array  $params
     *
     * @return string
     */
    private function prepareQuery(string $sql, array $params): string
    {
        $where = [];
        if ($params['filter']['role']) {
            $where[] = sprintf('role= %s ', $this->connection->quote($params['filter']['role']));
        }
        if ($params['filter']['login']) {
            $where[] = sprintf(
                '(login like %s ) ',
                $this->connection->quote('%'.$params['filter']['login'].'%')
            );
        }
        if ($where) {
            $sql .= ' where '.implode(' AND ', $where);
        }
        if ($params['order_by']) {
            $sql .= sprintf(' order by %s %s ', $params['order_by'], $params['order_dir']);
        }
        if ($params['page']['limit']) {
            $sql .= sprintf(' limit %s offset %s ', (int) $params['page']['limit'], (int) $params['page']['offset']);
        }

        return $sql;
    }
}
