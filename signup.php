<?php
include "db.php";

session_start();

$nameErr = "Please enter a name";
$emailErr = "Please enter an email";
$invalidEmail = "Invalid email";
$passwordErr = "Please enter a password";
$usernameErr = "Please enter a username";
$errors = [];
$formFields = [];

if ($_SERVER["REQUEST_METHOD"]  == "POST") {
    if (empty($_POST['name'])) {
        $errors['name'] = $nameErr;
    } else {
        $formFields['name'] =  $_POST['name'];
    }
    if (empty($_POST['email'])) {
        $errors['email'] = $emailErr;
    } elseif (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = $invalidEmail;
    } else {
        $formFields['email'] =  $_POST['email'];
    }
    if (empty($_POST['password'])) {
        $errors['password'] = $passwordErr;
    } else {
        $formFields['password'] =  $_POST['password'];
    }
    if (empty($_POST['username'])) {
        $errors['username'] = $usernameErr;
    } else {
        $formFields['username'] =  $_POST['username'];
    }

    if (!$errors) {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);

        $sql = "INSERT INTO users (`name`, email, username, `password`)
                VALUES (?, ?, ?, ?)";

        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $username, $password);
        $result = $stmt->execute();

        if ($result) {
            setcookie('username', $username, time() + 2 * 24 * 60 * 60);
            header("Location: home.php");
        } else {
            $message = "User not added";
        }
    } else {
        $_SESSION['form-fields'] = $formFields;
        $_SESSION['errors'] = $errors;
        header("Location: signUp.php");
        die();
    }
}


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
    <h2 class="text-center my-3">Sign Up</h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" id="sign-up" class="w-50 mx-auto" enctype="multipart/form-data">
        <?php
        if (isset($_SESSION['form-fields'])) {
            $formFields = $_SESSION['form-fields'];
        }
        ?>
        <div class="mb3">
            <label for="name" class="form-label">Name: </label>
            <input type="text" name="name" id="name" placeholder="e.g. Joe Bennet" class="form-control" value="<?php echo isset($formFields["name"]) ? $formFields["name"] : ''; ?>" />
        </div>
        <div class="mb3">
            <label for="name" class="form-label">Username: </label>
            <input type="text" name="username" id="name" placeholder="e.g. j.bennet" class="form-control" value="<?php echo isset($formFields["username"]) ? $formFields["username"] : ''; ?>" />
        </div>
        <div class="mb3">
            <label for="email" class="form-label">Email: </label>
            <input type="email" name="email" id="email" placeholder="joebennet@gmail.com" class="form-control" value="<?php echo isset($formFields["email"]) ? $formFields["email"] : ''; ?>" />
        </div>
        <div class="mb3">
            <label for="password" class="form-label">Password: </label>
            <input type="password" name="password" id="password" class="form-control" value="<?php echo isset($formFields["password"]) ? $_POST["password"] : ''; ?>" />
        </div>
        <div class="errors">
            <?php
            if (isset($_SESSION['errors'])) {
                $errors = $_SESSION['errors'];

                echo '<br />';

                foreach ($errors as $error) {
                    echo "<p class='fw-bold text-danger'>" . $error . "</p>";
                }

                unset($_SESSION['errors']);
                unset($_SESSION['form-fields']);
            }
            ?>
        </div>
        <input type="submit" value="Sign Up" class="btn btn-primary blue-900 mt-4" style="background-color: #132237;">
    </form>

    <div class="text-center">
        <p class="sub-text text-center" style="font-weight: 280;">Already have an account&#63; </p>
        <a href="login.php" class="hover-link1 non-style-link">Login</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>