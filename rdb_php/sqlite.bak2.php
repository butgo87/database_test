<?php
require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Level;
use Monolog\Handler\StreamHandler;

$logger = new Logger("sqlite.php");
$logger->pushHandler(new StreamHandler('php://stdout',  Level::Debug));

$logger->debug('entering sqlite.php');

$conn = new SQLite3('../sqlite_test.db');
$logger->debug('Connected to the database');



function createTable() {
    global $logger;
    global $db;
    $logger->debug('entering createTable()');
    $sql = "CREATE TABLE IF NOT EXISTS members (firstname string, lastname string, address string)";
    $db->exec($sql);
    $logger->debug('Created table user if it did not exist');
    $logger->debug('exiting createTable()');
}

function insertData() {
    global $logger;
    global $db;
    $logger->debug('entering insertData()');
    $sql = "insert into members (firstname, lastname, address) values ('John', 'Doe', '123 Main St')";
    $db->exec($sql);
    $logger->debug('Inserted data into table members');
    $logger->debug('exiting insertData()');
}

createTable();

$logger->debug('exit sqlite.php');
