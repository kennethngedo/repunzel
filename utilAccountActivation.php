<?php
//session_start();
if(!isset($_SESSION['new_user']))header("location: ./index.php");


$message = '';
        
$to = $email;
$from = "admin@" . $sitedomain;
$subject = "ACCOUNT ACTIVATION";

$headers = "From: $from\r\n";
$headers .= "Content-type: text/html\r\n";

// now lets send the email. 
mail($to, $subject, $message, $headers);

