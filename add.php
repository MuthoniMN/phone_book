<?php include "db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // get values of the inputs
    $name = $_POST['name'];
    $phone_number = $_POST['phone-number'];

    $q = "CREATE TABLE IF NOT EXISTS phone_book(
        `name` VARCHAR(250) NOT NULL,
        `tel` VARCHAR(250) NOT NULL
    )";

    $query = "INSERT INTO phone_book (`name`, `tel`) VALUES ($name, $phone_number)";
}
