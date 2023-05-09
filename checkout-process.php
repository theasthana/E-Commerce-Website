<?php

require("include/db_connection.inc.php");
require("include/functions.inc.php");
session_start();
$payment = get_safe_value($conn, $_POST['payment']);


function place_order($pay, $conn){

    $address = get_safe_value($conn, $_POST['address']);
    $city = get_safe_value($conn, $_POST['city']);
    $state = get_safe_value($conn, $_POST['state']);
    $pincode = get_safe_value($conn, $_POST['pincode']);
    
    foreach ($_SESSION['items'] as $id) {
$sql = "SELECT * FROM cart WHERE id=". $id;
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$user_id = $row['user_id'];
$product_id = $row['product_id'];
$status = "pending";

$sql = "INSERT INTO orders(user_id,product_id,address,city,state,pincode, payment, status) VALUES(?,?,?,?,?,?,?,?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssssss", $user_id, $product_id, $address, $city, $state, $pincode,$pay, $status);
mysqli_stmt_execute($stmt);

$sql = "DELETE FROM cart WHERE id=". $id;
$result = mysqli_query($conn, $sql);

    }
}

if ($payment == "cod"){
    place_order($payment, $conn);
    header('location:order-confirm.php');
    exit();
} else {
    //code here
}

?>