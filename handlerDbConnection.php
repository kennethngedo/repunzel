<?php

error_reporting(E_ALL ^ E_DEPRECATED);

$server = "127.0.0.1";
$database = "repunzel";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($server, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


?>
