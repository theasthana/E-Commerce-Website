
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