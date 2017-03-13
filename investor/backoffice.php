<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
//make all imports here
include_once '../settings.php';
include_once '../handlerDbConnection.php';



$now = time();
if (isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) {
    // this session has worn out its welcome; kill it and start a brand new one
    session_unset();
    session_destroy();
    session_start();
}

// either new or old, it should live at most for another hour
$_SESSION['discard_after'] = $now + 600;

$user = $_SESSION['user'];

if (!isset($user))
    header("location: /index.php"); 

$helpQuery = "SELECT * FROM ph WHERE status NOT LIKE '%confirmed%' AND (provider='" . $user . "' OR reciever='" . $user . "')";
$result = $conn->query($helpQuery);
$task = '';
$isto1 = '';
$isto2 = '';
$isto = '';
$timeleft = '';

while ($row = $result->fetch_assoc()) {
    $status = $row['status'];
    $reciever = $row['reciever'];
    $provider = $row['provider'];
    $amount = $row['amount'];
    $pop = 'pop/' . $row['pop'];
    $iDate = $row['initiation_date'];
    $cDate = $row['completion_date'];
    $tc = $row['transaction_code'];



    if ($user == $provider) {
        //if status is pending, just diplay basic
        $isto = 'ph';

        $helpQuery = "SELECT * FROM investors WHERE account_status='active' AND email='" . $reciever . "'";
        $result = $conn->query($helpQuery);
        if ($row = $result->fetch_assoc()) {
            $accountname = $row['account_name'];
            $accountnumber = $row['account_number'];
            $bank = $row['bank'];
            $recipient = $row['firstname'] . ' ' . $row['lastname'];
            $phone = $row['phone'];
        }

        if ($status == 'pending') {
            $task = $task . '<h3>Provide Help</h3>
                        <p>Please wait to recieve PH task.</p>';
        } else if ($status == 'matched') {//help has been matched
            $task = $task . '<h3>Provide Help</h3>
                    <p>Serial: ' . $tc . '</p>
                        <p>Amount: ' . $amount . '</p>
                        <p id="tleft" onshow="calculateTime();">Time left: ' . $timeleft . '</p>
                        <p>Recipient: ' . $recipient . '</p>
                        <p>Phone: ' . $phone . '.</p>
                        <p>Account name: ' . $accountname . '.</p>
                        <p>Account number: ' . $accountnumber . '.</p>
                        <p>Bank: ' . $bank . '.</p>
                        <div class="col-md-12 upload">
                            <form name="uploadForm" id="uploadForm" action="processUpload.php" method="POST" enctype="multipart/form-data" >
                            <input name="tc" id="tc" type="text" hidden value="' . $tc . '">
                                <input name="fileToUpload" id="fileToUpload" type="file" required placeholder="upload pop *">
                                <input style="margin-bottom: 20px" type="submit" value="Upload">
                            </form>
                        </div>';
        } else {

            $task = $task . '<h3>Provide Help</h3>
                    <p>Serial: ' . $tc . '</p>
                        <p>Amount: ' . $amount . '</p>
                            <p id="tleft" onshow="calculateTime();">Time left: ' . $timeleft . '</p>
                        <p>Recipient: ' . $recipient . '</p>
                        <p>Phone: ' . $phone . '.</p>
                        <p>Account name: ' . $accountname . '.</p>
                        <p>Account number: ' . $accountnumber . '.</p>
                        <p>Bank: ' . $bank . '.</p>
                        <img src="' . $pop . '" style="max-height: 100%; max-width:100%; margin: 0px; margin-bottom: 20px"/>';
        }
    } else {
        $isto = 'gh';

        $helpQuery = "SELECT * FROM investors WHERE account_status='active' AND email='" . $provider . "'";
        $result = $conn->query($helpQuery);
        if ($row = $result->fetch_assoc()) {
            $accountname = $row['account_name'];
            $accountnumber = $row['account_number'];
            $bank = $row['bank'];
            $sender = $row['firstname'] . ' ' . $row['lastname'];
            $phone = $row['phone'];
        }

        if ($status == 'pending') {
            $task = $task . '<h3>Get Help</h3>
                        <p>Please wait to recieve GH task.</p>';
        } else if ($status == 'matched') {
            $task = $task . '<h3>Get Help</h3>
                    <p>Serial: ' . $tc . '</p>
                        <p>Amount: ' . $amount . '</p>
                            <p id="tleft" onshow="calculateTime();">Time left: ' . $timeleft . '</p>
                        <p>Sender: ' . $sender . '</p>
                        <p>Phone: ' . $phone . '.</p>
                        ';
        } else {
            $task = $task . '<h3>Get Help</h3>
                    <p>Serial: ' . $tc . '</p>
                        <p>Amount: ' . $amount . '</p>
                            <p id="tleft" onshow="calculateTime();">Time left: ' . $timeleft . '</p>
                        <p>Recipient: ' . $sender . '</p>
                        <p>Phone: ' . $phone . '.</p>
                        <img src="' . $pop . '" style="max-height: 100%; max-width:100%; margin: 0px; margin-bottom: 20px"/>
                        <div class="col-md-12 upload">
                            <form name="confirmForm" id="confirmForm" action="processConfirm.php" method="POST" >
                                <input name="tc" id="tc" type="text" hidden value="' . $tc . '">
                                <input style="margin-bottom: 20px" type="submit" value="Confirm">
                            </form>
                        </div>';
        }
    }
}
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo $sitename; ?> | Backoffice </title>
        <link href="/css/bootstrap.css" rel='stylesheet' type='text/css' />
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="/js/jquery.min.js"></script>
        <!---- start-smoth-scrolling---->
        <script type="text/javascript" src="/js/move-top.js"></script>
        <script type="text/javascript" src="/js/easing.js"></script>
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
        <link href="/css/theme-style.css" rel='stylesheet' type='text/css' />
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
                <a href="/index.php"><img src="/images/logoed.png" title="ddc" /></a>
            </div>
            <!---- //End-logo---->
            <!----start-top-nav---->
            <nav class="top-nav">
                <ul class="top-nav">
                    <li ><a href="#"><?php echo $user; ?></a></li>
                    <li id="supportBt"><a href="support.php">Support</a></li>
                    <li id="loginBt" class="contatct-active"><a href="/login.php">Logout</a></li>
                </ul>
                <a href="#" id="pull"><img src="/images/nav-icon.png" title="menu" /></a>
            </nav>

            <!----//End-top-nav---->
        </div>
    </div>

    <div id="fea" class="features">
        <div class="container">
            <div class="head text-center">
                <h3><span> </span> Back office</h3>
                <p>See who you have been paired to pay and who has been paired to pay you.</p>
                <p>if pairing is not displaying, check back shortly.</p>               

                <?php if (isset($_GET['error'])) echo '<p style="color:red"> ' . $_GET['error'] . '</p>'; ?>
            </div>
            <!---- start-features-grids---->
            <div class="features-grids text-center">
                <div class="col-md-2 features-grid">
                    <?php
                    $loginQuery = "SELECT * FROM investors WHERE account_status='active' AND email='" . $user . "'";
                    $result = $conn->query($loginQuery);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $package = $row['package'];

                        if ($package == 'starter') {
                            echo '<h3><a href="#">Starter</a></h3>
                    <p>You pay 10,000.</p>
                    <p>You earn 20,000.</p>
                    <p><a name="bronze" id="upgradeBt">upgrade</a></p>';
                        } else if ($package == 'bronze') {
                            echo '<h3><a href="#">Bronze</a></h3>
                    <p>You pay 20,000.</p>
                    <p>You earn 40,000.</p>
                    <p><a name="silver" src="' . $user . '" id="upgradeBt">upgrade</a></p>';
                        } else if ($package == 'silver') {
                            echo '<h3><a href="#">Silver</a></h3>
                    <p>You pay 50,000.</p>
                    <p>You earn 100,000.</p>
                    <p><a name="gold" id="upgradeBt">upgrade</a></p>';
                        } else if ($package == 'gold') {
                            echo '<h3><a href="#">Gold</a></h3>
                    <p>You pay 70,000.</p>
                    <p>You earn 140,000.</p>
                    <p><a name="platinum" id="upgradeBt">upgrade</a></p>';
                        } else if ($package == 'platinum') {
                            echo '<h3><a href="#">Platinum</a></h3>
                    <p>You pay 100,000.</p>
                    <p>You earn 200,000.</p>
                     <p><a name="uranium" id="upgradeBt">upgrade</a></p>';
                        }else{
                            echo '<h3><a href="#">Uranium</a></h3>
                    <p>You pay 100,000.</p>
                    <p>You earn 200,000.</p>';
                        }
                    }
                    ?>

                </div>
                <div class="col-md-8 features-grid <?php echo $isto; ?>">
                    <div class="col-md-12 features-grid upload" style="text-align: left">
                        <?php echo $task; ?>
                    </div>

                </div>
                <div class="col-md-2 features-grid">
                    <?php
                    $loginQuery = "SELECT * FROM investors WHERE account_status='active' AND email='" . $user . "'";
                    $result = $conn->query($loginQuery);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $package = $row['package'];

                        if ($package == 'starter') {
                            echo '<h3><a href="#">Starter</a></h3>
                    <p>You pay 10,000.</p>
                    <p>You earn 20,000.</p>
                    <p><a name="bronze" id="upgradeBt">upgrade</a></p>';
                        } else if ($package == 'bronze') {
                            echo '<h3><a href="#">Bronze</a></h3>
                    <p>You pay 20,000.</p>
                    <p>You earn 40,000.</p>
                    <p><a name="silver" src="' . $user . '" id="upgradeBt">upgrade</a></p>';
                        } else if ($package == 'silver') {
                            echo '<h3><a href="#">Silver</a></h3>
                    <p>You pay 50,000.</p>
                    <p>You earn 100,000.</p>
                    <p><a name="gold" id="upgradeBt">upgrade</a></p>';
                        } else if ($package == 'gold') {
                            echo '<h3><a href="#">Gold</a></h3>
                    <p>You pay 70,000.</p>
                    <p>You earn 140,000.</p>
                    <p><a name="platinum" id="upgradeBt">upgrade</a></p>';
                        } else if ($package == 'platinum') {
                            echo '<h3><a href="#">Platinum</a></h3>
                    <p>You pay 100,000.</p>
                    <p>You earn 200,000.</p>
                     <p><a name="uranium" id="upgradeBt">upgrade</a></p>';
                        }else{
                            echo '<h3><a href="#">Uranium</a></h3>
                    <p>You pay 100,000.</p>
                    <p>You earn 200,000.</p>';
                        }
                    }
                    ?>
                </div>
                <div class="clearfix"> </div>
            </div>
            <!---- //End-features-grids---->
        </div>
    </div>
    <!----//End-feartures----->

    <!----start-footer---->
    <div class="footer">
        <div class="container">
            <div class="footer-left">
                    <!--<a href="#"><img src="images/footer-logo.png" title="mabur" /></a>-->
                <p>Created by <a href="#">lucho</a></p>
            </div>
            <script type="text/javascript">
                $(document).ready(function () {
                    /*
                     var defaults = {
                     containerID: 'toTop', // fading element id
                     containerHoverID: 'toTopHover', // fading element hover id
                     scrollSpeed: 1200,
                     easingType: 'linear' 
                     };
                     */

                    $().UItoTop({easingType: 'easeOutQuart'});

                });
            </script>
            <a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
        </div>
    </div>
    <!----//End-footer---->

    <script type="text/javascript">
        function calculateTime() {
            var ixDate = <?php echo json_encode($iDate); ?>;
            var cdate = <?php echo json_encode($cDate); ?>;

            var st = srvTime();
            var today = new Date(st);
            var endDate = new Date(cdate);

            var diff = endDate - today;
            var hoursdiff = Math.floor(diff / 3600000);
//            alert((hoursdiff));

            $('#tleft').html("Time Left: " + hoursdiff + " HOURS");


        }
        ;

        calculateTime();

        var xmlHttp;
        function srvTime() {
            try {
                //FF, Opera, Safari, Chrome
                xmlHttp = new XMLHttpRequest();
            }
            catch (err1) {
                //IE
                try {
                    xmlHttp = new ActiveXObject('Msxml2.XMLHTTP');
                }
                catch (err2) {
                    try {
                        xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
                    }
                    catch (eerr3) {
                        //AJAX not supported, use CPU time.
                        alert("AJAX not supported");
                    }
                }
            }
            xmlHttp.open('HEAD', window.location.href.toString(), false);
            xmlHttp.setRequestHeader("Content-Type", "text/html");
            xmlHttp.send('');
            return xmlHttp.getResponseHeader("Date");
        }
    </script>

    <!----//End-container---->
</body>
</html>





