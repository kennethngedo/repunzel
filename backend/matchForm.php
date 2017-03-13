<?php

/* Handles provide help mechanism.
 */
session_start();
require_once "../handlerDbConnection.php";


$provider = htmlspecialchars($_POST['cprovider']);
$receiver = htmlspecialchars($_POST['creceiver']);
$amount = htmlspecialchars($_POST['camount']);
$ramount = htmlspecialchars($_POST['ramount']);
$tc = htmlspecialchars($_POST['ctc']);
$initiation_date = htmlspecialchars($_POST['sDate']);
$completion_date = htmlspecialchars($_POST['eDate']);

if ($provider == $receiver) {
    echo 0;
} else {

    if ($ramount < $amount) {
        echo 2;
    } else {

        //check whether this is spiltted i.e forthy k
        $helpQuery = "SELECT * FROM gh WHERE status='pending'  AND reciever='" . $receiver . "'";
        $result = $conn->query($helpQuery);

        if ($result->num_rows > 1) {
            $sql = "UPDATE gh SET status='matched', amount='" . $amount . "', transaction_code='" . $tc . "' WHERE reciever='" . $receiver . "' AND status='pending' AND duality='1'";
            $stmt = $conn->prepare($sql);
        $stmt->execute();
            
        } else {
            $sql = "UPDATE gh SET status='matched', amount='" . $amount . "', transaction_code='" . $tc . "' WHERE reciever='" . $receiver . "' AND status='pending'";
            $stmt = $conn->prepare($sql);
        $stmt->execute();
            
        }

        

        $sql = "UPDATE ph SET status='matched', reciever='" . $receiver . "', initiation_date='" . $initiation_date . "', completion_date='" . $completion_date . "' WHERE transaction_code='" . $tc . "'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();


        //check if provide help is exactly get help amount, else created remainder gh
        if ($amount <= $ramount) {
            $balance = $ramount - $amount;

            if ($balance > 0) {
                $insertQuery = "INSERT INTO gh (reciever, amount )"
                        . " VALUES('$receiver','$balance')";
                $conn->query($insertQuery);
            }
        }

        echo 1;
    }
}
?>


