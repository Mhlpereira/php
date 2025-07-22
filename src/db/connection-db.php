<?php

namespace App\Db;

class ConnectionPool{

    private static $instance = null;

    public static function getInstance(): \PDO {
        if (self::$instance === null) {
            $config = require __DIR__ . '/../config/database.php';
            $dbConfig = $config['pgsql'];

            $dataSource = "pgsql:host={$dbConfig['host']};port={$dbConfig['port']};dbname={$dbConfig['database']}";
            self::$instance = new \PDO($dataSource, $dbConfig['username'], $dbConfig['password']);
            self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(\PDO::ATTR_TIMEOUT, 5);
            self::$instance->setAttribute(\PDO::ATTR_PERSISTENT, true);
        }
    }

    public static function close(): void {
        if (self::$instance !== null) {
            self::$instance = null;
        }
    }
}