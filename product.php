<?php
require("include/db_connection.inc.php");
require("include/functions.inc.php");
session_start();
$id = get_safe_value($conn, $_GET['id']);
$sql = "SELECT * FROM products WHERE id=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_array($result);

$product_id = $row[0];
$product_name = $row[2];
$product_mrp = $row[3];
$product_sp = $row[4];
$product_qty = $row[5];
$product_sd = $row[6];
$product_desc = $row[7];
$product_meta_title = $row[8];
$product_meta_desc = $row[9];
$product_meta_keyword = $row[10];
$product_image = $row[12];

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $is_logged_in = false;
} else {
    $is_logged_in = true;
}

// Add to Cart functionality
if (isset($_POST['add_cart']) && $is_logged_in) {
    $user_id = $_SESSION['user_id'];
    $sql = "INSERT INTO cart (product_id, user_id) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ii', $product_id, $user_id);

    if (mysqli_stmt_execute($stmt)) { 

    // Redirect to Cart page
    header('location:mycart.php');
    exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        echo $product_name . " | CSHOP";
        ?>
    </title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/product.css">
</head>
<body>

<header>
    <?php include("include/header.inc.php") ?>
</header>

<main>
    <div class="product-details-container">
        <div class="product-image-container">
            <img src="media/products/<?php echo $product_image; ?>" alt="<?php echo $product_name; ?>">
        </div>
        <div class="product-info-container">
            <h1><?php echo $product_name; ?></h1>
            <p class="product-mrp">MRP: <del><?php echo $product_mrp; ?></del></p>
            <p class="product-sp"> &#x20b9; <span><?php echo $product_sp; ?></span></p>
            <p class="product-qty">Quantity: <?php echo $product_qty; ?></p>
            <p class="product-sd"><?php echo $product_sd; ?></p>
            <div class="product-action-buttons">
                <form method="post" action="product.php?id=<?php echo $product_id ?>" >
                    <?php if ($is_logged_in) { ?>
                        <button type="submit" name="add_cart">Add to Cart</button>
                    <?php } else { ?>
                        <a href="login.php"><button type="button">Login to Add to Cart</button></a>
                    <?php } ?>
                </form>
                <button type="submit" name="buy_now">Buy Now</button>
            </div>
        </div>
    </div>
    <div class="product-description-container">
        <h2>Description</h2
