<?php

require("include/db_connection.inc.php");
include("include/functions.inc.php");

session_start();
if (isset($_SESSION['user'])) {
    header('location:index.php');
}
if (isset($_POST['username'])) {
    try {
    $username =get_safe_value($conn,$_POST['username']);
    $password =get_safe_value($conn,$_POST['password']);

    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_array($result);
    if (mysqli_num_rows($result) > 0) {
        if (password_verify($password, $row[4])) {
        $_SESSION['user_id'] = $row[0];
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $row[1] . " " . $row[2];
        $_SESSION['username'] = $username;
        $_SESSION['user'] = 'yes';

        header('location:index.php');
        exit();
        } else {
            echo '<script> alert("Wrong username and password combination.") </script> ';
        }
    } else {
        echo '<script> alert("Username not found") </script>.';
    }

} catch (Exception $e) {
    echo $e;
} catch (Error $e) {
    echo $e;
}
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    
<header>
    <?php include("include/header.inc.php") ?>
</header>

<main>

<div class="login_div">
    <img class="login_image" src="assets/images/login-page-image.png">
<h1 class="login_title">Login</h1>
<form class="login_form" action="login.php" method="post">
<input type="text" name="username" value="Username" required>
<br>
<input type="password" name="password" value="Password" required>
<br>
<input class="submit_button" type="submit" value="Log In">
</form>
</div>

</main>

<footer>
    <?php include("include/footer.inc.php") ?>
</footer>
</body>
</html>