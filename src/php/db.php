<?php
require_once './classes/DatabaseConection.php';

$host = 'mysql';
$dbname = 'my_database';
$username_db = 'my_user';
$password_db = 'my_password';

$dbConnection = new DatabaseConnection($host, $dbname, $username_db, $password_db);
$pdo = $dbConnection->connect();
