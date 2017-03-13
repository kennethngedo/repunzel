<?php

session_start();
if (!isset($_SESSION['user']))
    header("location: /index.php");

require_once "../handlerDbConnection.php";

$tc = htmlspecialchars($_POST['tc']);

$sql = "UPDATE ph SET status='confirmed' WHERE transaction_code='" . $tc . "'";
$stmt = $conn->prepare($sql);
$stmt->execute();

$sql = "UPDATE gh SET status='confirmed' WHERE transaction_code='" . $tc . "'";
$stmt = $conn->prepare($sql);
$stmt->execute();

$sql = "SELECT * FROM ph WHERE transaction_code = '$tc'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $provider = $row['provider'];
    $reciever = $row['reciever'];
    $amount = $row['amount'];

    $sql = "SELECT * FROM investors WHERE email ='" . $provider . "'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $earnings = $row['earnings_total'];
    $priviledges = $row['priviledges'];
    $package = $row['package'];
    $earnings = $earnings + $amount + $amount;

    $sql = "UPDATE investors SET earnings_total='" . $earnings . "' WHERE email='" . $provider . "'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    //new gh for provider
    $status = 'pending';
    $amount1 = '';
    if ($package == 'starter') {
        $amount1 = '10000';
    } else if ($package == 'bronze') {
        $amount1 = '20000';
    } else if ($package == 'silver') {
        $amount1 = '50000';
    } else if ($package == 'gold') {
        $amount1 = '70000';
    } else if ($package == 'platinum') {
        $amount1 = '100000';
    } else {
        $amount1 = '200000';
    }
    if ($priviledges == 'user') {
        $transaction_code = strtoupper(substr(md5(uniqid("this is my site 491", true)), 0, 10));
        $insertQuery = "INSERT INTO ph (provider, amount, status, transaction_code )"
                . " VALUES('$reciever','$amount', '$status', '$transaction_code')";
        $conn->query($insertQuery);
    }


    $sql = "SELECT * FROM investors WHERE email = '" . $reciever . "'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $earnings = $row['earnings_total'];
    $priviledges = $row['priviledges'];
    $earnings = $earnings - $amount;

    $sql = "UPDATE investors SET earnings_total='" . $earnings . "' WHERE email='" . $reciever . "'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($priviledges == 'user') {
        $insertQuery = "INSERT INTO gh (reciever, amount )"
                . " VALUES('$provider','$amount')";

        $conn->query($insertQuery);
    }



    //new ph for reciever
}

header("location: /investor/backoffice.php");


