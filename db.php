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
