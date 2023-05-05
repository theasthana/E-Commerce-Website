<?php

require("include/db_connection.inc.php");
require("include/functions.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>

<header>
    <?php include("include/header.inc.php") ?>
</header>

<main>

<div class="banner">
  <h1>Welcome to India's #1 E-Shop</h1>
  <p>Shop our latest collections and get free shipping on all orders over  &#x20b9;500.</p>
  <a href=".collection" class="btn">Shop Now</a>
</div>


<div class="collection">

<div class="product_grid">
<?php

$sql = "SELECT id,product_name,mrp,selling_price,image FROM products ORDER BY id DESC LIMIT 12";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
if ($row['status'] == 0) {
    echo '<a class="product_link" href="product.php?id='. $row['id'] .'">';
    echo '<div class="product">';
    echo '<div class="product_image_div">';
    echo '<img src="media/products/' . $row['image'] . '" class="product_image"> ';
    echo '</div>';
    echo '<p class="product_title">' . trimWords($row['product_name'], 10) . '</p>';
    echo '<p class="product_price">&#x20b9;' . $row['mrp'] . '</p>';
    echo '<p class="selling_price"> &#x20b9;' . $row['selling_price'] . '</p>';
    echo '</div>';
    echo '</a>';
}
}
?>
</div>
</div>

</main>

<footer>
    <?php include("include/footer.inc.php") ?>
</footer>

</body>
</html>