<?php include "db.php";
$id = '';
$username = $_COOKIE['username'];
$query = "SELECT id FROM users WHERE username = '$username' LIMIT 1";

$result = $connection->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
    }
}
$sql = "SELECT * FROM phone_book WHERE user = $id";
$result = $connection->query($sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Book</title>

    <link rel="stylesheet" href="https://classless.de/classless.css">

</head>

<body>
    <h1>Phone Book</h1>
    <section class="flex">
        <form action="add.php" method="post">
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name">
            </div>
            <div>
                <label for="phone-number">Phone Number</label>
                <input type="tel" name="phone-number" id="phone-number">
            </div>
            <input type="submit" value="Add Phone Number">
        </form>

        <table>
            <tr>
                <th>Name</th>
                <th>Phone Number</th>
            </tr>
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['tel'] ?></td>
                    </tr>
                <?php
                    # code...
                }
            } else { ?>
                <tr>
                    <td colspan="2">No Contacts Added.</td>
                </tr>
            <?php

            }
            ?>

        </table>
    </section>

</body>

</html>