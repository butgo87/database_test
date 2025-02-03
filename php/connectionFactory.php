<?php
class ConnectionFactory {
    private static $config = [
        'host' => 'localhost',
        'dbname' => 'your_database',
        'username' => 'your_username',
        'password' => 'your_password'
    ];

    public static function getConnection() {
        try {
            $dsn = 'mysql:host=' . self::$config['host'] . ';dbname=' . self::$config['dbname'];
            $connection = new PDO($dsn, self::$config['username'], self::$config['password']);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            return null;
        }
    }
}
?>