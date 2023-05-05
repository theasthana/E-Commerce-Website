<?php
require("include/db_connection.inc.php");
require("include/functions.inc.php");

$total = 0;
$item = 0;
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
        <h2 class="page_heading">My Cart</h2>
        <!-- <p>Showing results for '<?php echo $search_keyword ?>'</p> -->

        <?php
$user = $_SESSION['user_id'];

$sql = 'SELECT * FROM cart WHERE user_id='. $user;
$result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo '<div class="product_container">';

            while ($r = mysqli_fetch_array($result)) {

$sql = "SELECT * FROM products WHERE id=$r[2]";
$rst = mysqli_query($conn, $sql);
if (mysqli_num_rows($rst) > 0) {
    while ($row = mysqli_fetch_array($rst)) {

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

                $total += $row['selling_price'];
                $item += 1;
    }
}
            }

            echo '</div>';
        }
        ?>

<form action="checkout.php" method="post" class="checkout_btn_form" style="width:100%; padding: 50px 0 50px 40%;">
    <input type="hidden" name="total" value="<?php echo $total; ?>">
    <input type="hidden" name="item" value="<?php echo $item; ?>" >
<button type="submit" class="checkout_btn" style="margin: 0 auto;" >Checkout</button>
    </form>

    </main>

    <footer>
        <?php include("include/footer.inc.php") ?>
    </footer>
</body>
</html>
