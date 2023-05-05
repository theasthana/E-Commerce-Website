<div class="header_div">
<a class="logo" href="index.php">
<p > <span class="logo_red">C</span>SHOP</p>
</a>

<nav>
    <ul class="nav_list">
        
    <?php
    session_start();
    if (isset($_SESSION['username'])) {
        echo '<li class="nav_item">';
        echo $_SESSION['name'] . ', ';
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
</div>
