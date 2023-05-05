<?php
require('include/db_connection.inc.php');
require('include/functions.inc.php');
require('include/check_login.inc.php');

try {

if (isset($_GET['delete'])) {
    $id = get_safe_value($conn, $_GET['delete']);
    $sql = "DELETE FROM categories WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    header("Location: category.php");
}

if (isset($_GET['status'])) {
    $status = get_safe_value($conn, $_GET['status']);
    $id = get_safe_value($conn, $_GET['id']);

    $sql = "UPDATE categories SET status=" . $status . " WHERE id=" . $id;
    $stmt = mysqli_query($conn, $sql);
    header('location:category.php');
}

if (isset($_POST['category_name'])) {
    $name = get_safe_value($conn, $_POST['category_name']);
    $sql = 'INSERT INTO  categories(category, status) VALUES(?, 1)';
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $name);
mysqli_stmt_execute($stmt);
header('location:category.php');
}
} catch (Exception $e) {
    echo '<h1>System Is Busy, Try again later.</h1';
    die();
} catch (Error $e) {
    echo '<h1>System Is Busy, Try again later.</h1';
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

    <div class="title_container">
<h1 class="main_serction_heading"  >Category</h1>
</div>
<table>
<thead>
    <tr>
        <th>ID</th>
        <th>Category</th>
        <th>Status</th>
        <th>Action</th>
</tr>
</thead>
<tbody>
<?php
$sql = "SELECT * from categories";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $row['id'] . '</td>';
    echo '<td>' . $row['category'] . '</td>';

    if ($row['status'] == 1) {
        echo '<td>';
        echo '<a href="category.php?status=0&id=' . $row['id'] . '">Active</a>';
        echo '</td>';
    } else {
        echo '<td>';
        echo '<a href="category.php?status=1&id=' . $row['id'] . '">Deactive</a>';
        echo '</td>';
    }
    echo '<td><a href="category.php?delete=' . $row['id'] . '">Delete</a></th>';
    echo '</tr>';
}
?>
</tbody>
</table>

<div class="add-category-container">
    <div class="title_container">
        <h1>Add Categories</h1>
</div>
<form action="category.php" method="post">
<input type="text" name="category_name" placeholder="Category Name" class="category_name">
<br>
<input type="submit" name="submit" value="Add">
</form>
</div>

</aside>
</main>
<footer>
    <?php include("include/footer.inc.php") ?>
</footer>
</body>
</html>