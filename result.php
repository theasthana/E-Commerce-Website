<?php
require("include/db_connection.inc.php");
require("include/functions.inc.php");

$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search | CSHOP</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/search.css">
</head>
<body>
    <header>
        <?php include("include/header.inc.php") ?>
    </header>

    <main>
        <h2>Search Results</h2>
        <!-- <p>Showing results for '<?php echo $search_keyword ?>'</p> -->

        <?php

$search_keyword = get_safe_value($conn, $_GET['search_box']);

$sql = "SELECT * FROM products WHERE product_name LIKE '%". $search_keyword ."%' OR meta_keyword LIKE '%". $search_keyword ."%' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo '<div class="product_container">';

            while ($row = mysqli_fetch_array($result)) {
                echo '<div class="product">';
                echo '<img class="product_image" src="media/products/'. $row['image'] .'">';
                echo '<div class="product_details">';
                echo '<a class="product_link" href="product.php?id='. $row['id'] .'"';
                echo '<h2 class="product_name">'. trimWords($row['product_name'], 10) .'</h2>';
                echo '</a>';
                echo '<p class="product_price"> MRP ';
                echo '<span class="cross">'. $row['mrp'] .'</span>';
                echo '<b> &#x20b9;'. $row['selling_price'] .'</b>';
                echo '</p>';
                echo '</div>';
                echo '</div>';
            }

            echo '</div>';
        }
        ?>
    </main>

    <footer>
        <?php include("include/footer.inc.php") ?>
    </footer>
</body>
</html>
