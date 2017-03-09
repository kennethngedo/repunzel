<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "handlerDbConnection.php";
require_once './settings.php';

//fetch all serialized data from post
$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);

$loginQuery = "SELECT * FROM investors WHERE account_status='active' AND email='" . $email .  "' AND password='" . $password . "'"; //add if active

$result = $conn->query($loginQuery);

if ($result->num_rows > 0) {
    session_start();
    $row = $result->fetch_assoc();
    $_SESSION['user'] = $row['email'] ;
    header("location: /investor/backoffice.php");
} else {
    header("location: /login.php?error=invalid login details");
}

$conn->close();


?>


