<?php
require('include/db_connection.inc.php');
require('include/check_login.inc.php');


if (isset($_GET['delete'])) {
    $id = get_safe_value($conn, $_GET['delete']);
    $sql = "DELETE FROM categories WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    header("Location: category.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/admin-page.css">
</head>
<body>
    
<header>
    <?php include("include/header.inc.php") ?>
</header>

<main>
    <aside class="side_panel">
        <?php include("include/side-panel-admin.inc.php"); ?>
</aside>
<aside class="main_section">


<div class="title_container">
<h1 class="main_serction_heading"  >Messages</h1>
</div>

<?php

require("include/db_connection.inc.php");
require("include/functions.inc.php");

$sql = "SELECT * FROM messages";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
    echo '<div class="msg_container">';
    echo '<b> #';
    echo $row['id'];
    echo '&nbsp;';
    echo $row['name'];
    echo '</b>';

    echo '<p>';
    echo $row['message'];
    echo '</p>';
    echo '<b>';
    echo 'Email : ' . $row['email'];
    echo ' &nbsp Phone : ' . $row['phone'];
    echo '</b>';
    echo '</div>';
    echo '<br>';
}

?>

</aside>
</main>
<footer>
    <?php include("include/footer.inc.php") ?>
</footer>
</body>
</html>