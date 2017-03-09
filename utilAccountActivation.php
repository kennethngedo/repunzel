<?php
//session_start();
if(!isset($_SESSION['new_user']))header("location: ./index.php");


$message = '<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo $sitename; ?> | Account Activation </title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery.min.js"></script>
        <!---- start-smoth-scrolling---->
        <script type="text/javascript" src="js/move-top.js"></script>
        <script type="text/javascript" src="js/easing.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $(".scroll").click(function (event) {
                    event.preventDefault();
                    $("html,body").animate({scrollTop: $(this.hash).offset().top}, 1000);
                });
            });</script>
        <link rel="icon" type="image/png" href="/images/favicon.ico">
        <script type="text/javascript" src="/js/force.js"></script>
        <!--<script type="text/javascript" src="/js/processSignup.js"></script>-->
        <!---- start-smoth-scrolling---->
        <!-- Custom Theme files -->
        <link href="css/theme-style.css" rel="stylesheet" type="text/css" />
        <!-- Custom Theme files -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    </script>
    <!----font-Awesome----->
    <link rel="stylesheet" href="fonts/css/font-awesome.min.css">
    <!----font-Awesome----->
    <!----webfonts---->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Droid+Serif:400,700" rel="stylesheet" type="text/css">
    <!----//webfonts---->
    <!----start-top-nav-script---->
    <script>
            $(function () {
                var pull = $("#pull");
                menu = $("nav ul");
                menuHeight = menu.height();
                $(pull).on("click", function (e) {
                    e.preventDefault();
                    menu.slideToggle();
                });
                $(window).resize(function () {
                    var w = $(window).width();
                    if (w > 320 && menu.is(":hidden")) {
                        menu.removeAttr("style");
                    }
                });
            });</script>
    <!----//End-top-nav-script---->
</head>
<body>
    
    <!----start-contact---->
    <div id="contact" class="contact"> 

        <div class="contact-grids">

            
            <div class="col-md-4 contact-left">
                <h3><span> </span> Account Activation</h3>
                <p>Hi ' . $_SESSION['new_user'] . '.</p>
                <p>Click this <a href="www.' . $sitedomain .'/?purpose=Activation&reference="' . $_SESSION['reference'] .  '>link</a> to activate your account.</p>
                <p>Or copy and paste this link below in your browser.</p>
                <p style="color:blue; underline:true">www.' . $sitedomain .'/?purpose=Activation&reference="' . $_SESSION['reference'] .  '</p>
                <p>Cheers,</p>
                <p>Admin.</p>
            </div>
            <div class="col-md-8 contact-left">
             

            </div>

            <div class="clearfix"> </div>
        </div>
    </div>
    <!----//End-contact---->
    
    <!----start-footer---->
    <div class="footer">
        <div class="container">
            <div class="footer-left">
                    <!--<a href="#"><img src="images/footer-logo.png" title="mabur" /></a>-->
                <p><a href="#">(c) dymond daily cash, 2017.</a></p>
            </div>
            <script type="text/javascript">
                $(document).ready(function () {
                    /*
                     var defaults = {
                     containerID: "toTop", // fading element id
                     containerHoverID: "toTopHover", // fading element hover id
                     scrollSpeed: 1200,
                     easingType: "linear" 
                     };
                     */

                    $().UItoTop({easingType: "easeOutQuart"});

                });
            </script>
            <a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
        </div>
    </div>
    <!----//End-footer---->


    <!----//End-container---->
</body>
</html>';
        
$to = $_SESSION['email'];
$from = "admin@" . $sitedomain;
$subject = "ACCOUNT ACTIVATION";

$headers = "From: $from\r\n";
$headers .= "Content-type: text/html\r\n";

// now lets send the email. 
mail($to, $subject, $message, $headers);

