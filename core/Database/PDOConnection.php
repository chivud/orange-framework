<?php

namespace Core\Database;

use Core\Services\Config;

class PDOConnection implements ConnectionInterface
{
    
    protected static $instance;

    public function __construct()
    {
        if (self::$instance === null) {
            $this->create();
        }

    }

    public function create()
    {
        $dbConfig = Config::get('database');

        try {
            $connection = new \PDO(
                'mysql:dbname=' . $dbConfig['db_name'] .
                ';host=' . $dbConfig['db_host'],
                $dbConfig['db_user'],
                $dbConfig['db_pass']
            );

            self::$instance = $connection;

        } catch (\PDOException $e) {
            throw $e;
        }

    }

    public static function getInstance()
    {
        return self::$instance;
    }

    public static function closeConnection()
    {
        self::$instance = null;
    }
}
