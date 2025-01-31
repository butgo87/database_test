<?php
require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Level;
use Monolog\Handler\StreamHandler;

$logger = new Logger("sqlite.php");
$logger->pushHandler(new StreamHandler('php://stdout',  Level::Debug));

$logger->debug('entering sqlite.php');

$conn;

function createDbConnection() {
    global $logger;
    global $conn;
    $logger->debug('entering createDbConnection()');

    try {
        $conn = new SQLite3('../sqlite_test.db');
        $conn->enableExceptions(true);
        $logger->debug('Connected to the database');

    } catch (Exception $e) {
        $logger->error('Error connecting to the database: ' . $e->getMessage());
        throw $e;
    }
    $logger->debug('exiting createDbConnection()');
}

function createTable() {
    global $logger;
    global $conn;
    $logger->debug('entering createTable()');

    $sql = "
        CREATE TABLE IF NOT EXISTS user (
              user_id varchar(10)
            , first_name varchar(50)
            , last_name varchar(50)
            , age integer
            , CONSTRAINT pk_user PRIMARY KEY (user_id)
        )
    ";
    $logger->debug(sprintf("sql: %s", $sql));

    $conn->exec($sql);
    $logger->debug('Created table user if it did not exist');

    $logger->debug('exiting createTable()');
}

function readData() {
    global $logger;
    global $conn;
    $logger->debug('entering readData()');

    $sql = "
        select
              user_id
            , first_name
            , last_name
            , age
        from
            user
    ";
    $logger->debug(sprintf("sql: %s", $sql));

    $result = $conn->query($sql);
    $logger->debug('Read data from table user');
    while($row = $result->fetchArray()) {
        $logger->debug(printf('Row: %s %s %s %d', $row['user_id'], $row['first_name'], $row['last_name'], $row['age']));
    }

    $logger->debug('exiting readData()');
}

function deleteData() {
    global $logger;
    global $conn;
    $logger->debug('entering deleteData()');

    $sql = "delete from user";
    $logger->debug(sprintf("sql: %s", $sql));
    
    $conn->exec('BEGIN');

    try {
        $conn->exec($sql);
    } catch (Exception $e) {
        $conn->exec('ROLLBACK');
        $logger->error('Error deleting: ' . $e->getMessage());
        throw $e;
    }

    $conn->exec('COMMIT');
    $logger->debug('Deleted data from table user');

    $logger->debug('exiting deleteData()');
}

function createData() {
    global $logger;
    global $conn;
    $logger->debug('entering createData()');

    $sql = 'insert into user (user_id, first_name, last_name, age) values (:user_id, :first_name, :last_name, :age)';
    $logger->debug(sprintf("sql: %s", $sql));

    $conn->exec('BEGIN');

    try {
        $pstmt = $conn->prepare($sql);
        $pstmt->bindValue(':user_id', 'p00000001');
        $pstmt->bindValue(':first_name', '길동');
        $pstmt->bindValue(':last_name', '홍');
        $pstmt->bindValue(':age', 20);
        $pstmt->execute();
    
        $pstmt->clear();
        // $pstmt->reset();
    
        $pstmt->bindValue(':user_id', 'p00000002');
        $pstmt->bindValue(':first_name', '영희');
        $pstmt->bindValue(':last_name', '노');
        $pstmt->bindValue(':age', 30, SQLITE3_INTEGER);
        $pstmt->execute();
    } catch (Exception $e) {
        $conn->exec('ROLLBACK');
        $logger->error('Error creating: ' . $e->getMessage());
        throw $e;
    }

    $conn->exec('COMMIT');

    $logger->debug('Inserted data into table user');

    $logger->debug('exiting createData()');
}

function updateData() {
    global $logger;
    global $conn;
    $logger->debug('entering updateData()');

    $sql = "update user set age = :age where user_id = :user_id";
    $logger->debug(sprintf("sql: %s", $sql));

    $conn->exec('BEGIN');
    try {

        $pstmt = $conn->prepare($sql);
        $pstmt->bindValue(':age', 25, SQLITE3_INTEGER);
        $pstmt->bindValue(':user_id', 'p00000001');
        $pstmt->execute();

    } catch (Exception $e) {
        $conn->exec('ROLLBACK');
        $logger->error('Error updating: ' . $e->getMessage());
        throw $e;
    }
    $conn->exec('COMMIT');

    $logger->debug('Updated data in table user');

    $logger->debug('exiting updateData()');
}

function main() {
    global $logger;
    $logger->debug('entering main()');

    createDbConnection();

    createTable();
    readData();

    deleteData();
    readData();

    createData();
    readData();

    deleteData();
    readData();

    $logger->debug('exiting main()');
}

main();

$logger->debug('exit sqlite.php');
