<?php

require("include/db_connection.inc.php");
require("include/functions.inc.php");

session_start();
if (isset($_SESSION['admin'])) {
    header('location:admin-panel.php');
}

if (isset($_POST['submit'])) {
    try {
    $username =get_safe_value($conn,$_POST['username']);
    $password =get_safe_value($conn,$_POST['password']);

    $sql = "SELECT * FROM admin WHERE username=? and password=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_array($result);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $row[1] . " " . $row[2];
        $_SESSION['status'] = $row[5];
        $_SESSION['admin'] = 'yes';

        header('location:admin-panel.php');
        exit();
    } else {
        echo "<script> alert('Please enter a valid username and password combination'); </script>";
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
<h1 class="login_title">Admin</h1>

<form class="login_form" action="index.php" method="post">
<input type="text" name="username" placeholder="Username" required>
<br>
<input type="password" name="password" placeholder="Password" required>
<br>
<input class="submit_button" type="submit" name="submit" value="Log In">
</form>
</div>

</main>

<footer>
    <?php include("include/footer.inc.php") ?>
</footer>
</body>
</html>