<?php
class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=testdb', 'username', 'password');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        //return $self::$instance;
        return $this->pdo;
    }

    public function getConnection() {
        return $this->pdo;
    }
}

// Usage
$db = Database::getInstance();
$pdo = $db->getConnection();