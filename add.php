<?php include "db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // get values of the inputs
    $name = $_POST['name'];
    $phone_number = $_POST['phone-number'];

    $username = $_COOKIE['username'];

    $query = "SELECT id FROM users WHERE username = '$username' LIMIT 1";
    $result = $connection->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];
        }
    }

    $query = "INSERT INTO phone_book (`name`, `tel`, `user`) VALUES ('$name', '$phone_number', $id)";

    if ($connection->query($query) == TRUE) {
        echo "Contact added successfully!";
        header('Location: index.php');
    } else {
        echo "Error: Contact not added";
    }
}
