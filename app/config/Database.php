<?php

namespace App\Config;

use PDO;

class Database
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        $host = DB_HOST;
        $dbname = DB_NAME;
        $username = DB_USER;
        $password = DB_PASSWORD;

        try {
            $this->connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
