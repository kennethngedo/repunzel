<?php
session_start();
if (!isset($_SESSION['admin']))
    header("location: ./index.php");


$now = time();
if (isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) {
    // this session has worn out its welcome; kill it and start a brand new one
    session_unset();
    session_destroy();
    session_start();
}

// either new or old, it should live at most for another hour
$_SESSION['discard_after'] = $now + 1200;

require_once "../handlerDbConnection.php";
require_once "../settings.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Theme Made By www.w3schools.com - No Copyright -->
        <title> <?php echo $sitename ?> | Admin Dashboard </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="icon" type="image/png" href="/images/favicon.ico">

        <style>
            body {
                font: 400 15px/1.8 Lato, sans-serif;
                color: #777;
            }
            h3, h4 {
                margin: 10px 0 30px 0;
                letter-spacing: 10px;      
                font-size: 20px;
                color: #111;
            }
            .container {
                padding: 80px 120px;
            }
            .person {
                border: 10px solid transparent;
                margin-bottom: 25px;
                width: 80%;
                height: 80%;
                opacity: 0.7;
            }
            .person:hover {
                border-color: #f1f1f1;
            }
            .carousel-inner img {
                -webkit-filter: grayscale(90%);
                filter: grayscale(90%); /* make all photos black and white */ 
                width: 100%; /* Set width to 100% */
                margin: auto;
            }
            .carousel-caption h3 {
                color: #fff !important;
            }
            @media (max-width: 600px) {
                .carousel-caption {
                    display: none; /* Hide the carousel text when the screen is less than 600 pixels wide */
                }
            }
            .bg-1 {
                background: #2d2d30;
                color: #bdbdbd;
            }
            .bg-1 h3 {color: #fff;}
            .bg-1 p {font-style: italic;}
            .list-group-item:first-child {
                border-top-right-radius: 0;
                border-top-left-radius: 0;
            }
            .list-group-item:last-child {
                border-bottom-right-radius: 0;
                border-bottom-left-radius: 0;
            }
            .thumbnail {
                padding: 0 0 15px 0;
                border: none;
                border-radius: 0;
            }
            .thumbnail p {
                margin-top: 15px;
                color: #555;
            }
            .btn {
                padding: 10px 20px;
                background-color: #333;
                color: #f1f1f1;
                border-radius: 0;
                transition: .2s;
            }
            .btn:hover, .btn:focus {
                border: 1px solid #333;
                background-color: #fff;
                color: #000;
            }
            .modal-header, h4, .close {
                background-color: #333;
                color: #fff !important;
                text-align: center;
                font-size: 30px;
            }
            .modal-header, .modal-body {
                padding: 40px 50px;
            }
            .nav-tabs li a {
                color: #777;
            }
            #googleMap {
                width: 100%;
                height: 400px;
                -webkit-filter: grayscale(100%);
                filter: grayscale(100%);
            }  
            .navbar {
                font-family: Montserrat, sans-serif;
                margin-bottom: 0;
                background-color: #2d2d30;
                border: 0;
                font-size: 11px !important;
                letter-spacing: 4px;
                opacity: 0.9;
            }
            .navbar li a, .navbar .navbar-brand { 
                color: #d5d5d5 !important;
            }
            .navbar-nav li a:hover {
                color: #d9534f !important;
            }
            .navbar-nav li.active a {
                color: #d9534f !important;
                background-color: #29292c !important;
            }
            .navbar-default .navbar-toggle {
                border-color: transparent;
            }
            .open .dropdown-toggle {
                color: #fff;
                background-color: #555 !important;
            }
            .dropdown-menu li a {
                color: #000 !important;
            }
            .dropdown-menu li a:hover {
                background-color: #d9534f !important;
            }
            footer {
                background-color: #2d2d30;
                color: #f5f5f5;
                padding: 32px;
            }
            footer a {
                color: #f5f5f5;
            }
            footer a:hover {
                color: #777;
                text-decoration: none;
            }  
            .form-control {
                border-radius: 0;
            }
            .has-error{
                border-color:  red !important;
            }
            .has-success{
                border-color:  green !important;
            }
            textarea {
                resize: none;
            }

            #result1{
                margin-left:5px;
            }

            .short{
                color:#FF0000;
            }

            .weak{
                color:#E66C2C;
            }

            .good{
                color:#2D98F3;
            }

            .strong{
                color:#006400;
            }
        </style>
    </head>
    <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50" >

        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand" href="../index.php"><?php echo $sitename ?></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span>  <?php echo $_SESSION['admin']; ?></a></li>
                        <li><a href="./index.php" data-toggle="modal" >LOGOUT</a></li>

                    </ul>
                </div>
            </div>
        </nav>

        <!-- Container (Contact Section) -->
        <div id="contact" class="container">

            <h3 class="text-center">Admin Dashboard</h3><h3 hidden="true" id="killer" href="#" data-toggle="modal" data-target="#myModal2">kill</h3>
            <h3 hidden="true" id="killer2" href="#" data-toggle="modal" data-target="#myModal3">kill</h3>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Match Help</a></li>
                <li><a data-toggle="tab" href="#menu1">Statistics</a></li>
                <li><a data-toggle="tab" href="#menu4">Manage Accounts</a></li>
                <li><a data-toggle="tab" href="#menu2">Failed Helps</a></li>
                <li><a data-toggle="tab" href="#menu3">Create News</a></li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <h2>Match Help</h2>
                    <p>This is where you match help provider to help receivers.</p>
                    <p id='upnotif'></p>


                    <div class="row">
                        <div class="col-md-6">
                            <!-- Modal Login form-->
                            <div class="modal-content">

                                <div class="modal-body">
                                    <form role="form" id="matchForm0" name='matchForm0' class="matchForm" action="" method="POST">
                                        <div class="form-group">
                                            <label for="cprovider0"><span class="glyphicon glyphicon-hand-down"></span> Provider</label>
                                            <select  type="password" name="cprovider0" class="form-control" id="cprovider0" required  >
                                                <option value="" disabled selected style="display:none;">Select a provider</option>
                                                <?php
                                                $user = $_SESSION['admin'];
                                                $helpQuery = "SELECT * FROM ph WHERE status='pending'";
                                                $result = $conn->query($helpQuery);

                                                while ($row = $result->fetch_assoc()) {
                                                    $amount = $row['amount'];
                                                    $code = $row['transaction_code'];
                                                    $provider = $row['provider'];
                                                    $tc = $row['transaction_code'];
                                                    $spirit = $row['spirit'];
                                                            
                                                    
                                                    echo '<option value="' . $provider . '/' . $amount . '/' . $tc . '">' . $provider . ' - ' . $amount . '</option>';
                                                    
                                                    
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="creceiver0"><span class="glyphicon glyphicon-hand-d"></span> Receiver</label>
                                            <select  type="password" name="creceiver0" class="form-control" id="creceiver0" required  >
                                                <option value="" disabled selected style="display:none;">Select a receiver</option>
                                                <?php
                                                $helpQuery = "SELECT * FROM gh WHERE status='pending'";
                                                $result = $conn->query($helpQuery);


                                                while ($row = $result->fetch_assoc()) {
                                                    $amountx = $row['amount'];
                                                    $receiverx = $row['reciever'];
                                                    
                                                    if($receiverx != 'love@gmail.com'){
                                                    echo '<option value="' . $receiverx . '/' . $amountx . '">' . $receiverx . ' - ' . $amountx . '</option>';
                                                }
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-block">Confirm 
                                            <span class="glyphicon glyphicon-ok"></span>
                                        </button>
                                    </form>
                                </div>


                            </div>
                        </div>

                    </div>


                </div>

                <div id="menu1" class="tab-pane fade">
                    <h2>Statistics</h2>
                    <p>See all GH and PH stats. Both currently and all time stats.</p>
                    <div class="row" >
                        <div class="col-sm-6 ">
                            <?php
                            $user = $_SESSION['admin'];
                            $phQuery = "SELECT * FROM ph WHERE status='pending' OR status='awaiting confirmation' OR status='matched'";
                            $result1 = $conn->query($phQuery);
                            $totalPH = $result1->num_rows;

                            $phQuery = "SELECT sum(amount) as totalph FROM ph WHERE status='pending' OR status='awaiting confirmation' OR status='matched'";
                            $result3 = $conn->query($phQuery);
                            $row = $result3->fetch_assoc();
                            $totalPHMoney = $row['totalph'];

                            $ghQuery = "SELECT * FROM gh WHERE status='pending' OR status='awaiting confirmation' OR status='matched'";
                            $result2 = $conn->query($ghQuery);
                            $totalGH = $result2->num_rows;

                            $ghQuery = "SELECT sum(amount) as totalgh FROM gh WHERE status='pending' OR status='awaiting confirmation' OR status='matched'";
                            $result4 = $conn->query($ghQuery);
                            $row = $result4->fetch_assoc();
                            $totalGHMoney = $row['totalgh'];

                            $ghQuery = "SELECT * FROM investors";
                            $result4 = $conn->query($ghQuery);
                            $totalInvestors = $result4->num_rows;

                            $ghQuery = "SELECT sum(amount) as totalgh FROM gh WHERE status='active'";
                            $result4 = $conn->query($ghQuery);
                            $totalInvestorsActive = $result4->num_rows;

                            echo '<ul class="list-group">
                                <li class="list-group-item">
                                    <label  for="etransaction">Total GHs</label>
                                    <span style="" name="etransaction" id="etransaction" class="label label-warning pull-right">' . $totalGH . '</span>
                                    
                                </li>
                                <li class="list-group-item">
                                    <label  for="ereferrals">Total PHs</label>
                                    <span style="" name="etransaction" id="etransaction" class="label label-info pull-right">' . $totalPH . '</span>
                                    
                                </li>
                                <li class="list-group-item">
                                    <label  for="ereferrals">Total GH Money(Naira)</label>
                                    <span style="" name="etransaction" id="etransaction" class="label label-danger pull-right">' . $totalGHMoney . '</span>
                                    
                                </li>
                                <li class="list-group-item">
                                    <label  for="etotal">Total PH Money(Naira)</label>
                                    <span style="background-color: " name="etransaction" id="etransaction" class="label label-success pull-right">' . $totalPHMoney . '</span>
                                    
                                </li>
                                <li class="list-group-item">
                                    <label  for="etotal">Total Investors</label>
                                    <span style="background-color: " name="etransaction" id="etransaction" class="label label-success pull-right">' . $totalInvestors . '</span>
                                    
                                </li>
                                <li class="list-group-item">
                                    <label  for="etotal">Total Active Investors</label>
                                    <span style="background-color: " name="etransaction" id="etransaction" class="label label-success pull-right">' . $totalInvestorsActive . '</span>
                                    
                                </li>

                            </ul>';
                            ?>

                        </div>
                        <div class="col-sm-6 ">
                            <?php
                            $user = $_SESSION['admin'];
                            $phQuery = "SELECT * FROM ph";
                            $result1 = $conn->query($phQuery);
                            $totalPH = $result1->num_rows;

                            $phQuery = "SELECT sum(amount) as totalph FROM ph";
                            $result3 = $conn->query($phQuery);
                            $row = $result3->fetch_assoc();
                            $totalPHMoney = $row['totalph'];

                            $ghQuery = "SELECT * FROM gh";
                            $result2 = $conn->query($ghQuery);
                            $totalGH = $result2->num_rows;

                            $ghQuery = "SELECT sum(amount) as totalgh FROM gh";
                            $result4 = $conn->query($ghQuery);
                            $row = $result4->fetch_assoc();
                            $totalGHMoney = $row['totalgh'];

                            echo '<ul class="list-group">
                                <li class="list-group-item">
                                    <label  for="etransaction">All Time Total GHs</label>
                                    <span style="" name="etransaction" id="etransaction" class="label label-primary pull-right">' . $totalGH . '</span>
                                    
                                </li>
                                <li class="list-group-item">
                                    <label  for="ereferrals">All Time  Total PHs</label>
                                    <span style="" name="etransaction" id="etransaction" class="label label-primary pull-right">' . $totalPH . '</span>
                                    
                                </li>
                                <li class="list-group-item">
                                    <label  for="ereferrals">All Time  Total GH Money(Naira)</label>
                                    <span style="" name="etransaction" id="etransaction" class="label label-primary pull-right">' . $totalGHMoney . '</span>
                                    
                                </li>
                                <li class="list-group-item">
                                    <label  for="etotal">All Time  Total PH Money(Naira)</label>
                                    <span style="background-color: " name="etransaction" id="etransaction" class="label label-primary pull-right">' . $totalPHMoney . '</span>
                                    
                                </li>

                            </ul>';
                            ?>

                        </div>
                    </div>
                </div>
                <div id="menu4" class="tab-pane fade">
                    <h2>Manage Account</h2>
                    <p>You can search for users, edit permissions or delete a user.</p>
                    <div class="row" >
                        <div class="col-sm-10 ">
                            <label for="search"><span class="glyphicon glyphicon-user"></span> Search </label>
                            <input type="text" class="form-control" required  name="search" id="search" placeholder="enter ref code or email of an investor " >
                        </div>
                    </div> <br>
                    <div id="putit">
                        
                    </div>
                </div>
                <div id="menu2" class="tab-pane fade ">
                    <h2>Failed Helps</h2>
                    <p>See defaulters and take appropriate action.</p>
                    
                    <div id="putmore">
                        
                    </div>

                </div>
                <div id="menu3" class="tab-pane fade ">
                    <h2>Create News</h2>
                    <p>From here you can create news and manage existing news.</p>
                    <div class="row" >
                        <div class="col-sm-6 ">
                            <form role="form" id="newsForm" action="createNews.php" method="POST">
                                <div class="form-group">
                                    <label for="title"><span class="glyphicon glyphicon-book"></span> Title </label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Title of news here">
                                </div>
                                <div class="form-group">
                                    <label for="msg"><span class="glyphicon glyphicon-book"></span> Message</label>
                                    <textarea  class="form-control" name="msg" rows="5" id="msg" placeholder="Your news here"> </textarea>
                                </div>
                                <button type="submit" class="btn btn-block">Create 
                                    <span class="glyphicon glyphicon-new-window"></span>
                                </button>
                            </form>
                        </div>
                    </div><br>
                    <?php
                    $newQuery = "SELECT * FROM news WHERE status='show'";
                    $result = $conn->query($newQuery);

                    while ($row = $result->fetch_assoc()) {
                        $title = $row['title'];
                        $message = $row['message'];

                        echo '<div class="row" >
                            <div class="col-sm-12 ">
                                <label >' . $title . ' </label>
                                <p>' . $message . '</p>
                                <div class="col-sm-6 ">
                                <button type="submit" class="btn btn-block">Proceed 
                                    <span class="glyphicon glyphicon-new-check"></span>
                                </button>
                                </div>
                            </div></div><br>';
                    }
                    ?>

                </div>



            </div></div>



        <!-- Footer -->
        <footer class="text-center">
            <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
                <span class="glyphicon glyphicon-chevron-up"></span>
            </a><br><br>
            <p>Created by lucho</a></p> 
        </footer>

        <script>
            $(document).ready(function () {


                // Initialize Tooltip
                $('[data-toggle = "tooltip"]').tooltip();

                // Add smooth scrolling to all links in navbar + footer link
                $(".navbar a, footer a[href='#myPage']").on('click', function (event) {
                    // Make sure this.hash has a value before overriding default behavior
                    if (this.hash !== "") {

                        // Prevent default anchor click behavior
                        event.preventDefault();

                        // Store hash
                        var hash = this.hash;

                        // Using jQuery's animate() method to add smooth page scroll
                        // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
                        $('html, body').animate({
                            scrollTop: $(hash).offset().top
                        }, 900, function () {

                            // Add hash (#) to URL when done scrolling (default click behavior)
                            window.location.hash = hash;
                        });
                    } // End if
                });
            })
        </script>

        <!--add form processor scripts-->
        <script type="text/javascript" src="/js/matchForm.js"></script>
        <script type="text/javascript" src="/js/manageAccounts.js"></script>
        <script type="text/javascript" src="/js/failedHelps.js"></script>
        <script type="text/javascript" src="/js/news.js"></script>




    </body>
</html>


