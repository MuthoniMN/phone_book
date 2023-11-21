<?php include "db.php";
$sql = "SELECT * FROM phone_book";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Book</title>
</head>

<body>
    <section>
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
        </table>
    </section>

</body>

</html>