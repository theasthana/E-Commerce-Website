<?php

try {
    $conn = new mysqli("localhost", "user251", "pass251", "ecom");
    mysqli_set_charset($conn, "utf8");
}
catch (Exception $e) {
    print "The system is busy $e";
}
catch (Error $e) {
    print "There was an error";
}


?>