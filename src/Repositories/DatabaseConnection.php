<?php

namespace src\Repositories;

class DatabaseConnection {
    private static $instance = null;
    private $connection;

    private function __construct() {
        $host = 'localhost';
        $port = '3307';
        $db_name = 'library_db';
        $username = 'root';
        $password = '';

        try {
            $dsn = "mysql:host=$host;port=$port;dbname=$db_name;charset=utf8mb4";
            
            $this->connection = new PDO($dsn, $username, $password);
            
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            die("Database Connection Error: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}