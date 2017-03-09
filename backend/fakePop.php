<?php

session_start();
require_once "../handlerDbConnection.php";


$pref = htmlspecialchars($_POST['pref']);
$rref = htmlspecialchars($_POST['rref']);
$tcode = htmlspecialchars($_POST['tcode']);

$sql = "DELETE FROM ph WHERE transaction_code='" . $tcode . "'";
$stmt = $conn->prepare($sql);
$stmt->execute();

$sql = "DELETE FROM investors WHERE reference_code ='" . $pref . "'";
$stmt = $conn->prepare($sql);
$stmt->execute();

$sql = "UPDATE gh SET status='pending', transaction_code='' WHERE transaction_code='" . $tcode . "'";
$stmt = $conn->prepare($sql);
$stmt->execute();

echo 'success';

