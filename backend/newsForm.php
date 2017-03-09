<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../handlerDbConnection.php';

$title = htmlspecialchars($_POST['title']);
$message = htmlspecialchars($_POST['msg']);
$status = 'show';

$insertQuery = "INSERT INTO news (title, message, status )"
        . " VALUES('$title','$message', '$status')";

$conn->query($insertQuery);

echo 'GH of ';


