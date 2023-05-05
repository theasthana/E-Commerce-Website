<?php
require('include/db_connection.inc.php');
require('include/check_login.inc.php');
require('include/functions.inc.php');
try {
    if (isset($_POST['product_name'])) {
        $product_name = get_safe_value($conn, $_POST['product_name']);
        $category_id = get_safe_value($conn, $_POST['category_id']);
        $mrp = get_safe_value($conn, $_POST['mrp']);
        $selling_price = get_safe_value($conn, $_POST['selling_price']);
        $qty = get_safe_value($conn, $_POST['qty']);
        $short_description = get_safe_value($conn, $_POST['short_description']);
        $description = get_safe_value($conn, $_POST['description']);
        $meta_title = get_safe_value($conn, $_POST['meta_title']);
        $meta_description = get_safe_value($conn, $_POST['meta_description']);
        $meta_keywords = get_safe_value($conn, $_POST['meta_keywords']);
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $image_type = $_FILES['image']['type'];
        $image_size = $_FILES['image']['size'];
        $upload_path = "media/products/".$image;
        move_uploaded_file($tmp_name, $upload_path);

        $sql = "INSERT INTO products(product_name, category_id, mrp, selling_price, qty, short_description, description, meta_title, meta_description, meta_keyword, image, status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "siddissssss" , $product_name, $category_id, $mrp, $selling_price, $qty, $short_description, $description, $meta_title, $meta_description, $meta_keywords, $image);
        mysqli_stmt_execute($stmt);
        header('location:products.php');
    }
} catch (Exception $e) {
    echo '<h1>System Is Busy, Try again later.</h1>' . $e;
    die();
} catch (Error $e) {
    echo '<h1>System Is Busy, Try again later.</h1>' . $e;
    die();
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
    <link rel="stylesheet" href="assets/css/category.css">
</head>
<body>
    
<header>
    <?php include("include/header.inc.php") ?>
</header>

<main>
    <aside class="side_panel">
        <?php include("include/side-panel-admin.inc.php") ?>
</aside>

<aside class="main_section">
    
<h1>Add New Product</h1>
<br>

<form action="add-products.php" method="post" enctype="multipart/form-data">
    Product Name : 
<input type="text" name="product_name" placeholder="Type Product Name" required><br>
Category : 
<input type=number" name="category_id" placeholder="Category ID"required ><br>
MRP : 
<input type="number" name="mrp" placeholder="0" required ><br>
Selling Price : 
<input type="number" name="selling_price" placeholder="0" required><br>
Qty : 
<input type="number" name="qty" placeholder="0" required> <br> 
Short Description : 
<textarea name="short_description" required></textarea>
<br>
Description : 
<textarea name="description" required></textarea>
<br>
Meta Title : 
<input type="text" name="meta_title" placeholder="enter here" required><br>
Meta Description : 
<input type="text" name="meta_description" placeholder="enter here" required><br>
Meta Keyword : 
<input type="text" name="meta_keywords" placeholder="Enter here" required><br>
Image : 
<input type="file" name="image" required><br>
<input type="submit" name="submit" value="Submit">
</form>
    
</aside>
</main>
<footer>
    <?php include("include/footer.inc.php") ?>
</footer>
</body>
</html>