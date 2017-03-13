<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once "handlerDbConnection.php";
require_once './settings.php';
session_start();

//fetch all serialized data from post
$firstname = strtoupper(htmlspecialchars($_POST['firstname']));
$lastname = strtoupper(htmlspecialchars($_POST['lastname']));
$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);
$password_again = htmlspecialchars($_POST['password_again']);
$package = htmlspecialchars($_POST['package']);
$accountname = strtoupper(htmlspecialchars($_POST['accountname']));
$accountnumber = htmlspecialchars($_POST['accountnumber']);
$bank = strtoupper(htmlspecialchars($_POST['bank']));
$phone = htmlspecialchars($_POST['phone']);
$securityquestion = htmlspecialchars($_POST['securityquestion']);
$securityQuestionAnswer = strtolower(htmlspecialchars($_POST['securityQuestionAnswer']));

//generate reference code for new investor
$referenceCode = strtoupper(substr(md5(uniqid($email, true)), 0, 10));

//set initial status to pending
$status = "pending";

//check if email already exist
$sql = "SELECT * FROM investors WHERE email = '$email'";
$result = $conn->query($sql);

$transaction_code = strtoupper(substr(md5(uniqid("this is my site 491", true)), 0, 10));

if($package == 'starter'){
    $amount = '10000';
}else if($package == 'bronze'){
    $amount = '20000';
}else if($package == 'silver'){
    $amount = '50000';
}else if($package == 'gold'){
    $amount = '70000';
}else if($package == 'platinum'){
    $amount = '100000';
}else{
   $amount = '200000'; 
}

if ($password == $password_again) {
    if ($result->num_rows > 0) {
        header("location: /signup.php?package=" . $package . "&error=the email you provided is already in use");
    } else {
        //go ahead and insert into the database
        $insertQuery = "INSERT INTO investors (firstname, lastname, email, phone,"
                . " password, reference_code, account_status, package, account_name, account_number, bank, security_question, answer_security_question )"
                . " VALUES('$firstname','$lastname', '$email', '$phone', '$password',"
                . " '$referenceCode', '$status', '$package', '$accountname', '$accountnumber', '$bank', '$securityquestion', '$securityQuestionAnswer')";
         
        if ($conn->query($insertQuery) === TRUE) {
//        include 'utilAccountActivation.php';
            
            $_SESSION['new_user'] = $firstname;
                        $_SESSION['reference'] = $referenceCode;
                        $_SESSION['email'] = $email;
            
            include './utilAccountActivation.php';
            header("location: /signupSuccess.php?reason=Signup Success");
        } else {
            die('Connect Error: ' . $mysqli->connect_error);
//            header("location: /signup.php?package=" . $package . "&error=something went wrong, please try again");
        }
    }
} else {
    header("location: /signup.php?package=" . $package . "&error=passwords do not match");
}

$conn->close();

?>
<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo $sitename; ?> | Signup Success</title>
        <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery.min.js"></script>
        <!---- start-smoth-scrolling---->
        <script type="text/javascript" src="js/move-top.js"></script>
        <script type="text/javascript" src="js/easing.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $(".scroll").click(function (event) {
                    event.preventDefault();
                    $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
                });
            });</script>
        <link rel="icon" type="image/png" href="/images/favicon.ico">
        <script type="text/javascript" src="/js/force.js"></script>
        <!--<script type="text/javascript" src="/js/processSignup.js"></script>-->
        <!---- start-smoth-scrolling---->
        <!-- Custom Theme files -->
        <link href="css/theme-style.css" rel='stylesheet' type='text/css' />
        <!-- Custom Theme files -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    </script>
    <!----font-Awesome----->
    <link rel="stylesheet" href="fonts/css/font-awesome.min.css">
    <!----font-Awesome----->
    <!----webfonts---->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700' rel='stylesheet' type='text/css'>
    <!----//webfonts---->
    <!----start-top-nav-script---->
    <script>
            $(function () {
                var pull = $('#pull');
                menu = $('nav ul');
                menuHeight = menu.height();
                $(pull).on('click', function (e) {
                    e.preventDefault();
                    menu.slideToggle();
                });
                $(window).resize(function () {
                    var w = $(window).width();
                    if (w > 320 && menu.is(':hidden')) {
                        menu.removeAttr('style');
                    }
                });
            });</script>
    <!----//End-top-nav-script---->
</head>
<body>
    <!----start-container---->
    <div id="home" class=" scroll">
        <div class="container">
            <!---- start-logo---->
            <div class="logo">
                <a href="/index.php"><img src="images/logo.png" title="ddc" /></a>
            </div>
            <!---- //End-logo---->
            <!----start-top-nav---->
            <nav class="top-nav">
                <ul class="top-nav">
                    <li id="loginBt" class="contatct-active"><a href="login.php">Login</a></li>
                </ul>
                <a href="#" id="pull"><img src="images/nav-icon.png" title="menu" /></a>
            </nav>

            <!----//End-top-nav---->
        </div>
    </div>

    <!----start-contact---->
    <div id="contact" class="contact"> 

        <div class="contact-grids">
            <div class="col-md-2 "></div>
            <div class="col-md-6 ">
                <h3> signup success!</h3>

                <p>Hi <?php echo $firstname; ?>, you have successfully registered to <?php echo $sitename; ?>. An activation email has been sent to 
                your inbox, click the link in that email to activate your account. Cheers.</p>

            </div>
            <div class="col-md-4 "></div>

            <div class="clearfix"> </div>
        </div>
    </div><br>
    <!----//End-contact---->


    <!----//End-container---->
</body>
</html>
