<?php
declare(strict_types=1); //Strict variables. Good php practice.


$host    = 'db'; //host name inside docker-compose network
$db      = 'cosc213_auth'; //database name
$user    = 'cosc213_user'; //database user
$pass    = 'cosc213_pass'; //database password
//credentials, basically.
$charset = 'utf8mb4'; //emoji support.

$dsn = "mysql:host=$host;dbname=$db;charset=$charset"; //data source name, string used to connect 
//to the database.

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];//PDO options for error handling and fetch mode to prevent SQL writing vulnerabilities. Good practice.

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Database connection failed: ' . htmlspecialchars($e->getMessage()));
}//Try to connect to the database, if it fails, show an error message and stop execution.
