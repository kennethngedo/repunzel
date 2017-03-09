<?php

/*
 * Login active investor -  store in database
 */

require_once "../handlerDbConnection.php";

$un = strtolower(htmlspecialchars($_POST['id']));
$pw = htmlspecialchars($_POST['pw']);

//encrypt password
$password = $pw;


$loginQuery = "SELECT * FROM investors WHERE account_status='active' AND email='" . $un .  "' AND password='" . $pw . "' AND priviledges='admin'"; //add if active

$result = $conn->query($loginQuery);

if ($result->num_rows > 0) {
    session_start();
    $row = $result->fetch_assoc();
    $_SESSION['admin'] = $row['email'];
    echo 'exists';
} else {
    echo "0 results";
}

$conn->close();

?>