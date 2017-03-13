<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../handlerDbConnection.php';

$receiver = htmlspecialchars($_POST['admin']);
$amount = htmlspecialchars($_POST['amount']);

//check if email already exist
$sql = "SELECT * FROM gh WHERE reciever='$receiver' AND status NOT LIKE '%confirmed%'";
$result = $conn->query($sql);

 if ($result->num_rows > 0) {
     echo 'This admin already has a an uncompleted GH, can only create new GH when there are no pending GH for admin.';
 }else{

$insertQuery = "INSERT INTO gh (reciever, amount )"
        . " VALUES('$receiver','$amount')";

$conn->query($insertQuery);

echo 'GH of ' . $amount . ' has been created for admin '. $receiver;
 }
