<?php
class DbConn
{
    private static $instance = null;
    private $pdo;

    // public static function getConnection() {
    //     if(self::$instance == null){
    //         self::$instance = new Database();
    //     }
    //     return self::$instance;
    // }

    public static function getConnection() {
        if(self::$instance == null) {
            self::$instance = new DbConn;
        }
        return self::$pdo;
    }
}
