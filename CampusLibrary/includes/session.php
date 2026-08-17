<?php

if (session_status() == PHP_SESSION_NONE)//Checking session started or not.PHP_SESSION_NONE equal not started
     {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

?>
