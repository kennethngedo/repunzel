<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

//make all imports here
include_once 'settings.php';
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo $sitename; ?> | Login </title>
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
                    <li id="homeBt"><a href="index.php">Home</a></li>
                    <li id="newsBt"><a href="news.php">News</a></li>
                    <!--<li id="loginBt" class="contatct-active"><a href="login.php">Login</a></li>-->
                </ul>
                <a href="#" id="pull"><img src="images/nav-icon.png" title="menu" /></a>
            </nav>

            <!----//End-top-nav---->
        </div>
    </div>
    
    <div id="fea" class="features">
        <div class="container">
            <div class="col-md-3 contact-left">
             

            </div>
            <div class="col-md-6 contact-left">
                <h3><span> </span> Login</h3>
<?php if (isset($_GET['error'])) echo '<p class="conditions"> <label id="alert"><span>*</span>' . $_GET['error'] . '</label></p>'; ?>
                <form name="loginForm" id="loginForm" action="processLogin.php" method="POST" >
                    <input name="email" id="email" type="email" placeholder="Email *">
                    <input name="password" id="password" type="password" placeholder="Password *">

                    <span class="submit-btn"><input type="submit" value="Login"></span>
                </form>
            </div>
            <div class="col-md-3 contact-left">
             

            </div>

            <div class="clearfix"> </div>
            
        </div>
    </div>

    
    
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


    <!----//End-container---->
</body>
</html>



