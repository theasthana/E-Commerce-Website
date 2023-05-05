<?php

if (isset($_POST['username'])) {
require("include/register-process.inc.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
<h1 class="login_title">Register</h1>

<div class="erro_msg" style="color:red;">
<?php
if (isset($errors)) {
    if (count($errors) > 0) {
        foreach ($errors as $e) {
            echo '<b>' . $e . '</b>';
            echo '<br>';
        }
    }
}

?>
</div>
<form class="login_form" action="register.php" method="post">
    <input type="text" name="first_name" placeholder="First Name" required>
    <br>
    <input type="text" name="last_name" placeholder="Last Name" required>
    <br>
<input type="text" name="username" placeholder="Username" required>
<br>
<input type="password" name="password" placeholder="Password" required>
<br>
<input type="password" name="confirm_password" placeholder="Confirm Password" required>
<br>
<input type="email" name="email" placeholder="Email ID" required>
<br>
<input type="text" name="phone" placeholder="Phone Number" required
<br>
<input class="submit_button" type="submit" value="Register">
</form>
</div>

</main>

<footer>
    <?php include("include/footer.inc.php") ?>
</footer>
</body>
</html>