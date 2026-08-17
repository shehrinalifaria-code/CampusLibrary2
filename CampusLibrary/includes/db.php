<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "campus_library";


$conn = mysqli_connect(
    $host,
    $user,
    $pass,
    $dbname
);


if(!$conn){
    die("Database Connection Failed");
}

?>