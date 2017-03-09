<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

require_once "../handlerDbConnection.php";

$package = htmlspecialchars($_GET['package']);
$user = $_SESSION['user'];


if (isset($package)) {
    $sql = "UPDATE investors SET package='" . $package . "' WHERE email='" . $user . "'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}

header("location: /investor/backoffice.php");

