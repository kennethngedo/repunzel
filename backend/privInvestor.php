<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once "../handlerDbConnection.php";

$ref = htmlspecialchars($_POST['ref']);
$status = htmlspecialchars($_POST['priviledges']);

if($status == 'admin'){
    $status = 'user';
    
}else{
    $status = 'user';
}


$sql = "UPDATE investors SET priviledges='". $status ."' WHERE reference_code='" . $ref . "'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();


echo $ref ;