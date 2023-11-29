<?php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    $error = "";

    $query = "SELECT * FROM users WHERE username = ? AND `password` = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $result = $stmt->execute();
    $stmt->store_result();

    // $result = $conn->query($query);
    if ($stmt->num_rows > 0) {
        setcookie('username', $username, time() + 2 * 24 * 60 * 60);
        header("Location: home.php");
    } else {
        $error = "User does not exist";
    }
}


$connection->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phonebook</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/0acc85d45b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="mt-5">
    <h2 class="text-center">Login to your Account</h2>
    <form action="" method="post" id="log-in" style="width:40%;display:block;margin:0 auto;">
        <div class="mb3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" placeholder="joebennet@gmail.com" class="form-control">
        </div>
        <div class="mb3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <p class="form-text text-danger fw-bold"><?= $error ?? "" ?></p>
        <input type="submit" value="Log In" class="btn btn-primary mt-4" style="background-color: #132237;">
    </form>
    <div class="text-center">
        <p class="sub-text text-center" style="font-weight: 280;">Don't have an account&#63; </p>
        <a href="signUp.php" class="hover-link1 non-style-link">Sign Up</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>