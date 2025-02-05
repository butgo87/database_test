<?php
class DbConn
{

    public static function getConnection() {
        if(self::$instance == null){
            self::$instance = new Database();
        }
        return self::$instance;
    }
}
