<?php
require 'vendor/autoload.php';
use Monolog\Logger;
use Monolog\Level;
// use Monolog\LineFormatter;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
$logger = new Logger("sqlite.php");
$logger->pushHandler(new StreamHandler('php://stdout',  Level::Debug));
// $handler->setFormatter(new LineFormatter("[%datetime%] [%level_name%] %message% [%context%]\n","Y-m-d H:i:s",true));
// $this->logger->pushHandler($handler);
$logger->debug('Welcome To Monolog');

$db = new SQLite3('../sqlite_test.db');
$logger->debug('Connected to the SQLite database file sqlite_test.db');