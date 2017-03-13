<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../handlerDbConnection.php';

$id = htmlspecialchars($_POST['id']);

$sql = "DELETE FROM news WHERE id='" . $id . "'";
$stmt = $conn->prepare($sql);
$stmt->execute();

echo 'news deleted';

