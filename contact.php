<?php
require("include/db_connection.inc.php");
require("include/functions.inc.php");

if (isset($_POST['name'])) {
    $name = get_safe_value($conn, $_POST['name']);
    $email = get_safe_value($conn, $_POST['email']);
    $phone = get_safe_value($conn, $_POST['phone']);
    $msg = get_safe_value($conn, $_POST['msg']);

    $sql = "INSERT INTO messages(name, email, phone, message) VALUES(?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $phone, $msg);
    mysqli_stmt_execute($stmt);
    header('location:query-processed.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <header>
        <?php include("include/header.inc.php"); ?>
</header>

<main>

<div class="login_div">
<h1 class="login_title">Send a Message</h1>
<form class="login_form" action="contact.php" method="post">
    <input type="text" name="name" placeholder="Full Name" required>
    <br>
    <input type="email" name="email" placeholder="Email ID" required>
    <br>
    <input type="text" name="phone" placeholder="Phone Number" required>
    <br>
    <textarea placeholder="Message" name="msg" required></textarea>
<br>
<input class="submit_button" type="submit" value="Submit">
</form>
</div>

</main>

<footer>
    <?php include("include/footer.inc.php") ?>
</footer>
</body>
</html>