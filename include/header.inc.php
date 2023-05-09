<?php
require('include/db_connection.inc.php');
// require('include/functions.inc.php');
?>

<nav class="top_panel">
    <ul class="nav_list">
        
    <?php
    session_start();
    if (isset($_SESSION['user'])) {
        echo '<li class="nav_item">';
        echo $_SESSION['name'] . ', ';
        echo '</li>';

        
        echo '<li class="nav_item">';
        echo '<a href="mycart.php" class="nav_link">My Cart</a>';
        echo '</li>';
        
        echo '<li class="nav_item">';
        echo '<a href="logout.php" class="nav_link">Logout</a>';
        echo '</li>';
        
    } else {
        echo '<li class="nav_item">
            <a class="nav_link" href="login.php">Login</a>
        </li>
        <li class="nav_item">
            <a class="nav_link" href="register.php">Register</a>
        </li>';
    }
    ?>
    </ul>
</nav>


<div class="header_div">
<a class="logo" href="index.php">
<p > <span class="logo_red">C</span>SHOP</p>
</a>

<form class="search" action="result.php" method="get">
<input class="search_box" type="text" name="search_box" placeholder="Search Products">
<input class="submit_btn" type="submit" name="search_btn" value="Search">
</form>

<div class="help">
<p> Need Help? </p>
<a href="contact.php">Send a message</a>
</div>


</div>

<nav class="bottom_panel">
    <ul class="bottom_panel_list">
<?php

$sql = "SELECT * FROM categories";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    if ($row['status'] == 1) {
        echo '<li>';
        echo '<a class="c_link" href="category.php?id=' . $row['id'] . '">';
        echo $row['category'] . '</a>';
        echo '</li>';
    }
}

?>
</ul>
</nav>
