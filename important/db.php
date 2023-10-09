<?php
$hostname = "localhost"; 
$username = "your_username"; 
$password = "your_password"; 
$database = "your_database"; 

$mysqli = new mysqli($hostname, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$mysqli->close();
?>
