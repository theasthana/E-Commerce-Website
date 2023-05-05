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
    <title>Checkout | CSHOP</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/checkout-page.css">
</head>
<body>
    <header>
        <?php include("include/header.inc.php") ?>
    </header>

    <main>
        <div class="container">
            <div class="summary">
                <h2 class="div_title">Summary</h2>
                <table>
                    <tr>
                        <td>Price</td>
                        <td> <?php echo $_POST['total'] ?> </td>
</tr>
<tr>
    <td>Item</td>
    <td> <?php echo $_POST['item'] ?> </td>
</tr>
<tr>
    <td>Shipping</td>
    <td> 0 </td>
</tr>
<tr>
    <td>Total</td>
    <td> <?php echo $_POST['total'] ?> </td>
</tr>
</table>
</div>

                <form method="post" action="checkout-process.php">
<div class="address_div">
<h2 class="div_title">Shipping Address</h2>

                    <label>Address</label>
                    <textarea name="address" required></textarea>
                    <br>
                    <label>City</label>
                    <input type="text" name="city" required>
                    <br>
                    <label>State</label>
<input type="text" name="state" required>
<br>
<label>Pin Code</label>
<input type="text" name="pincode" required>
<br>
</div>

<div class="payment_option">
            <h2 class="div_title">Payment Option</h2>
            <div class="payment_btn">
            <input type="radio" name="payment" value="online" required>
            <p class="radio_text">Pay using Net Banking/Debit or Credit CArd/UPI </p>
</div>
            <div class="payment_btn">

            <input type="radio" name="payment" value="cod" required>
            <p class="radio_text">Pay on Delivery</p>
</div>
            </div>

            <button class="submit_btn" type="submit">Continue </button>

            </form>

</div>
            </main>

    <footer>
        <?php include("include/footer.inc.php") ?>
    </footer>
</body>
</html>
