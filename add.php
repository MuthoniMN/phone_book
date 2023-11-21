<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // get values of the inputs
    $name = $_POST['name'];
    $phone_number = $_POST['phone-number'];

    // connect to the database
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbName = 'phoneBook';

    $connection = mysqli_connect($host, $username, $password, $dbName);

    if ($connection) {
        echo "Database Connected Successfully";
    } else {
        echo "Error: Couldn't connect to the database";
    }
}
