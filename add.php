<?php include "db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // get values of the inputs
    $name = $_POST['name'];
    $phone_number = $_POST['phone-number'];

    $query = "INSERT INTO phone_book (`name`, `tel`) VALUES ($name, $phone_number)";

    if ($connection->query($query) == TRUE) {
        echo "Contact added successfully!";
    } else {
        echo "Error: Contact not added";
    }
}
