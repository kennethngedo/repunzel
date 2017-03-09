<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../handlerDbConnection.php';

$receiver = htmlspecialchars($_POST['admin']);
$amount = htmlspecialchars($_POST['amount']);

$insertQuery = "INSERT INTO gh (reciever, amount )"
        . " VALUES('$receiver','$amount')";

$conn->query($insertQuery);

echo 'GH of ' . $amount . ' has been created for admin '. $receiver;
