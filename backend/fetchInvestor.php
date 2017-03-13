<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once "../handlerDbConnection.php";


$srch = htmlspecialchars($_POST['src']);

$helpQuery = "SELECT * FROM investors WHERE reference_code LIKE '%" . $srch . "%' OR email LIKE '%" . $srch . "%'";
$result = $conn->query($helpQuery);
$user = $_SESSION['admin'];

$i = 0;
$output = '';
while ($row = $result->fetch_assoc()) {
    $name = $row['firstname'] . ' ' . $row['lastname'];
    $email = $row['email'];
    $rcode = $row['reference_code'];
    $status = $row['account_status'];
    $referrer = 'Admin';
    $joined = '*';
    $phone = $row['phone'];
    $earnings = $row['earnings_total'];
    $priviledges = $row['priviledges'];

    if ($email != 'love@gmail.com') {
        $output = $output . '<div class="row bg-info" >
                    <div class="col-sm-10 ">
                        <div class="row" >
                            <div class="col-sm-6 ">
                                <label id="tName">NAME: ' . $name . '</label><br>
                                <label id="tRef">EMAIL: ' . $email . '</label><br>
                                <label id="tCode">CODE: ' . $rcode . '</label><br>
                                <label id="tStatus"> STATUS: ' . $status . '</label><br>
                            </div>
                            <div class="col-sm-6 ">
                                <label id="tRefferer">REFERRER: ' . $referrer . '</label><br>
                                <label id="tDate"> JOINED: ' . $joined . '</label><br>
                                <label id="tPhone"> PHONE: ' . $phone . ' </label>
                                <label id="tEarn"> CURRENT EARNINGS: ' . $earnings . '</label>
                                 <label id="tEarn"> PRIVILEDGES: ' . $priviledges . '</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 ">
                        <span style="cursor:pointer" name="' . $rcode . '/' . $status . '" id="' . $rcode . '/' . $status . '" class="details badge mAChange">change status</span>
                        <span style="cursor:pointer" name="' . $rcode . '/' . $status . '" id="' . $rcode . '/' . $status . '" class="details badge mADelete">delete</span>';
        
        if($user == 'clintondandison15@gmail.com'){
                           $output = $output . '<span style="cursor:pointer" name="' . $rcode . '/' . $priviledges . '" id="' . $rcode . '/' . $priviledges . '" class="details badge mPriv">change power</span>';
        }
        $output = $output . '</form></div></div><br>';
    }
}

echo $output;
