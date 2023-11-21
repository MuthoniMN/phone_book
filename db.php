<?php
// connect to the database
$host = 'localhost';
$username = 'root';
$password = '';
$dbName = 'phoneBook';

$connection = mysqli_connect($host, $username, $password, $dbName);

if (!$connection) {
    echo "Error: Couldn't connect to the database";
}

$q = "CREATE TABLE IF NOT EXISTS phone_book(
    `name` VARCHAR(250) NOT NULL,
    `tel` VARCHAR(250) NOT NULL
)";

if ($connection->query($q) == FALSE) {
    echo "Error: Table not created";
}
