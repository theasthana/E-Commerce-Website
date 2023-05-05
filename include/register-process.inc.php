<?php
require("include/db_connection.inc.php");
require("include/functions.inc.php");
$errors = array();

try {
    $first_name = get_safe_value($conn, $_POST['first_name']);
    $last_name = get_safe_value($conn, $_POST['last_name']);
    $username = get_safe_value($conn, $_POST['username']);
    $password = get_safe_value($conn, $_POST['password']);
    $confirm_password = get_safe_value($conn, $_POST['confirm_password']);
    $email = get_safe_value($conn, $_POST['email']);
    $phone = get_safe_value($conn, $_POST['phone']);

    if(empty($first_name) || empty($last_name) || empty($username) || empty($password) || empty($email) || empty($phone) || empty($confirm_password)) {
        $errors[] = "Fields can't be empty.";
    }

    if($password !== $confirm_password) {
        $errors[] = "Password didn't match";
    } 
    
    $check_username_query = "SELECT * FROM users WHERE username = ?";
    $check_username_stmt = mysqli_prepare($conn, $check_username_query);
    mysqli_stmt_bind_param($check_username_stmt, "s", $username);
    mysqli_stmt_execute($check_username_stmt);
    mysqli_stmt_store_result($check_username_stmt);

    if (mysqli_stmt_num_rows($check_username_stmt) > 0) {
        $errors[] = "Username already exist.";
    }

    $check_email_query = "SELECT * FROM users WHERE email = ?";
    $check_email_stmt = mysqli_prepare($conn, $check_email_query);
    mysqli_stmt_bind_param($check_email_stmt, "s", $email);
    mysqli_stmt_execute($check_email_stmt);
    mysqli_stmt_store_result($check_email_stmt);

    if (mysqli_stmt_num_rows($check_email_stmt) > 0) {
        $errors[] = "Email already exist.";
    }

    $check_phone_query = "SELECT * FROM users WHERE phone = ?";
    $check_phone_stmt = mysqli_prepare($conn, $check_phone_query);
    mysqli_stmt_bind_param($check_phone_stmt, "s", $phone);
    mysqli_stmt_execute($check_phone_stmt);
    mysqli_stmt_store_result($check_phone_stmt);

    if (mysqli_stmt_num_rows($check_phone_stmt) > 0) {
        $errors[] = "Phone number already exist.";
    }

    if (!(count($errors) > 0)) {
    $password_secured = password_hash($password, PASSWORD_DEFAULT);
    $insert_query = "INSERT INTO users (first_name, last_name, username, password, email, phone) VALUES (?, ?, ?, ?, ?, ?)";
    $insert_stmt = mysqli_prepare($conn, $insert_query);
    mysqli_stmt_bind_param($insert_stmt, "ssssss", $first_name, $last_name, $username, $password_secured, $email, $phone);

    if (mysqli_stmt_execute($insert_stmt)) {
        header("location:successc.php");
    } else {
        echo "<script> alert('Error adding user'); </script>";
    }
    }
} catch (Error $e) {
    echo 'System is currently busy, try again later.';
    die();
} catch (Exception $e) {
    echo 'System is currently busy, try again later.';
    die();
}
?>
