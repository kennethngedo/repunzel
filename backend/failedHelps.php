<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once "../handlerDbConnection.php";

$helpQuery = "SELECT DISTINCT * FROM ph WHERE status='awaiting confirmation' OR status='matched'";
$result2 = $conn->query($helpQuery);

$i = 0;
$output = array();
while ($row = $result2->fetch_assoc()) {
    $cDate = $row['completion_date'];
    $provider = $row['provider'];
    $reciever = $row['reciever'];
    $amount = $row['amount'];
    $tc = $row['transaction_code'];
    $status = $row['status'];
    $pop = '/investor/pop/' . $row['pop'];
    $completion_date = $row['completion_date'];
    $initiation_date = $row['initiation_date'];

    $helpQuery = "SELECT * FROM investors WHERE email='" . $provider . "'";
    $result = $conn->query($helpQuery);
    if ($row = $result->fetch_assoc()) {
        $pname = $row['firstname'] . ' ' . $row['lastname'];
        $pref = $row['reference_code'];
    }

    $helpQuery = "SELECT distinct * FROM investors WHERE email='" . $reciever . "'";
    $result = $conn->query($helpQuery);
    if ($row = $result->fetch_assoc()) {
        $rname = $row['firstname'] . ' ' . $row['lastname'];
        $rref = $row['reference_code'];
    }

    $entry = array(
        "provider" => $pname . ' - ' . $provider,
        "provider_ref" => $pref,
        "reciever" => $rname . ' - ' . $reciever,
        "reciever_ref" => $rref,
        "amount" => $amount,
        "transaction_code" => $tc,
        "status" => $status,
        "completion_date" => $completion_date,
        "initiation_date" => $initiation_date,
        "pop" => $pop
    );
    
    array_push($output,$entry);
    

}

echo json_encode($output);