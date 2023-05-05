<?php

session_start(); // start the session

$_SESSION = array();

session_destroy();

header("Location: index.php");
exit;
?>
