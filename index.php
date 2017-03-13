<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
//make all imports here
include_once 'settings.php';
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo $sitename; ?> | Home </title>
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
            });
        </script>
        <link rel="icon" type="image/png" href="/images/favicon.ico">
        <script type="text/javascript" src="/js/force.js"></script>
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
            });
    </script>
    <!----//End-top-nav-script----->
</head>
<body>
    <!----start-container---->
    <!----start-header---->
    <div id="home" class="header scroll">
        <div class="container">
            <!---- start-logo---->
            <div class="logo">
                <a href="index.php"><img src="images/logoed.png" title="ddc" /></a>
            </div>
            <!---- //End-logo---->
            <!----start-top-nav---->
            <nav class="top-nav">
                <ul class="top-nav">
                    <li class="active"><a href="#home" class="scroll">Home</a></li>
                    <li class="page-scroll"><a href="#port" class="scroll">How It Works</a></li>
                    <li class="page-scroll"><a href="#fea" class="scroll">Get Started</a></li>
                    <li class="page-scroll"><a href="#test" class="scroll">Testimonials</a></li>
                    <li id="supportBt"><a href="support.php">Support</a></li>
                    <li id="newsBt"><a href="news.php">News</a></li>
                    <li id="loginBt" class="contatct-active"><a href="login.php">Login</a></li>
                </ul>
                <a href="#" id="pull"><img src="images/nav-icon.png" title="menu" /></a>
            </nav>
            <div class="clearfix"> </div>
            <div class="slide-text text-center">
                <h1><?php echo $sitename; ?></h1>
                <span>We give with love.</span>
                <a class="slide-btn scroll" href="#fea">Get started</a>
            </div>
            <!----//End-top-nav---->
        </div>
    </div>
    <!----//End-header---->
    <!----start-feartures----->
    <div id="fea" class="features">
        <div class="container">
            <div class="head text-center">
                <h3><span> </span> Get Started</h3>
                <p>Select a package to register to. There are six packages; choose the one which bests suits you. </p>
            </div>
            <!---- start-features-grids---->
            <div class="features-grids text-center">
                <div class="col-md-3 features-grid"><a href="signup.php?package=starter">
                    <span class="fea-icon1"><i class="fa fa-star"> </i> </span>
                    <h3>Starter</h3>
                    <p>You pay 10,000.</p>
                    <p>You earn 20,000.</p></a>
                </div>
                    <div class="col-md-3 features-grid">                
                        <a href="signup.php?package=bronze">
                        <span class="fea-icon1"><i style="color:tan" class="fa fa-star"> </i> </span>
                        <h3>Bronze</h3>
                        <p>You pay 20,000.</p>
                        <p>You earn 40,000.</p>               
                        </a>
                    </div>
                    <div class="col-md-3 features-grid">                
                        <a href="signup.php?package=silver">
                        <span class="fea-icon1"><i style="color:silver" class="fa fa-star"> </i> </span>
                        <h3>Silver</h3>
                        <p>You pay 50,000.</p>
                        <p>You earn 100,000.</p>       
                        </a>
                    </div>
                    <div class="col-md-3 features-grid">                
                        <a href="signup.php?package=gold">
                        <span class="fea-icon1"><i style="color:gold" class="fa fa-star"> </i> </span>
                        <h3>Gold</h3>
                        <p>You pay 70,000.</p>
                        <p>You earn 140,000.</p>               
                        </a>
                    </div>
                    <div class="col-md-3 features-grid">                
                        <a href="signup.php?package=platinum">
                        <span class="fea-icon1"><i style="color:#843534" class="fa fa-star"> </i> </span>
                        <h3>Platinum</h3>
                        <p>You pay 100,000.</p>
                        <p>You earn 200,000.</p>                
                        </a>
                    </div>
                    <div class="col-md-3 features-grid">
                                        <a href="signup.php?package=uranium">
                        <span class="fea-icon1"><i style="color:plum" class="fa fa-star"> </i> </span>
                        <h3>Uranium</h3>
                        <p>You pay 200,000.</p>
                        <p>You earn 400,000.</p>
                                        </a>

                    </div>
                <div class="clearfix"> </div>
            </div>
            <!---- //End-features-grids---->
        </div>
    </div>
    <!----//End-feartures----->
    <!---- start-work---->
    <div id="port" class="work">
        <div class="container">
            <div class="head text-center work-head">
                <h3><span> </span> How It Works</h3>
                <p>We have simplified to a great extent the process of PHing and GHing, it is straight forward and easy to understand. </p>
            </div>
            <!---- start-work-grids----->
            <div class="work-grids">
                <div class="col-md-4 work-grid">
                    <span class="col-md-5 w-icon"> <i class="fa fa-star"> </i></span>
                    <div class="col-md-7 work-info">
                        <h4>Choose a package and register</h4>
                        <p> Select from six different packages as it suits you, this will determine the amount of money you will PH and or GH. Continue to the registration form and fill in all relevant details. You will receive an email with an activation link, click this link to activate your account. </p>
                    </div>
                </div>
                <div class="col-md-4 work-grid center-work-grid">
                    <span class="col-md-5 w-icon"> <i class="fa fa-lock"> </i></span>
                    <div class="col-md-7 work-info">
                        <h4>Login and provide Help</h4>
                        <p>After your account has been activated, you can log in to your backoffice using the email and password you provided during registration. Click provide help to create a ph request. Wait to be matched, when matched pay the due sum to the recipient. upload a proof of payment and wait to be confirmed. </p>
                    </div>
                </div>
                <div class="col-md-4 work-grid">
                    <span class="col-md-5 w-icon"><i class="fa fa-check"> </i> </span>
                    <div class="col-md-7 work-info">
                        <h4>Complete transaction and get Help</h4>
                        <p>Once your ph transaction has been confirmed you profits will accrue to you, you can see this profits in your earnings tab. Note that you can only get your earnings five days after you have completed the transaction. </p>
                    </div>
                </div>
                <div class="clearfix"> </div>
                <div class="work-map">
                    <span> </span>
                </div>
            </div>
            <!---- //End-work-grids----->
        </div>
    </div>
    <!---- //End-work---->
    <!----start-test-monials---->
    <div  id="test" class="testmonials">
        <div class="container">
            <div class="head text-center">
                <h3><span> </span> Testimonial</h3>
                <p>A glimpse into how some of our active participants feel about the system. Do you wish to testify? send a mail containing your thoughts and an image of you to admin@diamonddailycash.com </p>
            </div>
            <!----start-testmonial-time-line---->
            <div class="test-monial-time-line">
                <div class="col-md-6 test-monial-time-line-left">
                    <div class="test-monial-time-line-grid test-monial-time-line-grid-l1">
                        <div class="col-md-9 test-monial-time-line-left-text">
                            <p>This one sure pass other ones wey I don see ooo. so cool</p>
                        </div>
                        <div class="col-md-3 test-monial-time-line-left-pic">
                            <img src="images/pap.jpg" title="name" />
                            <a href="#">Fred Alabi</a>
                        </div>
                        <span class="grid-point"> </span>
                    </div>
                </div>
                <div class="col-md-6 test-monial-time-line-right">
                    <div class="test-monial-time-line-grid test-monial-time-line-grid-r1">
                        <div class="col-md-3 test-monial-time-line-left-pic">
                            <img src="images/pic2.jpg" title="name" />
                            <a href="#">Amara Chimdy</a>
                        </div>
                        <div class="col-md-9 test-monial-time-line-left-text">
                            <p>I have been on this platform for 3 days now nd dey have neva dissapointed me, lets keep phing and ghing to keep it going. Thanks</p>
                        </div>
                        <span class="grid-point grid-point1"> </span>
                    </div>
                    <div class="test-monial-time-line-grid test-monial-time-line-grid-r2">
                        <div class="col-md-3 test-monial-time-line-left-pic">
                            <img src="images/pic3.jpg" title="name" />
                            <a href="#">Purity Oginiwa</a>
                        </div>
                        <div class="col-md-9 test-monial-time-line-left-text">
                            <p>I love this platform. Dope!!</p>
                        </div>
                        <span class="grid-point grid-point1"> </span>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="test-monial-timeline-connector">
                    <span> </span>
                </div>
                <div class="clearfix"> </div>
                <a class="more-testmonial-time-line" href="#"> <span>More</span></a>
            </div>
        </div>
    </div>
    <div class="clearfix"> </div>
    <!----//End-testmonial-time-line---->
<div class="col-md-12 contact-left">
    <center>
             <h3><span> </span> Support</h3>
             <p>Send an email to <a style="color: #00A2C1">dymondcare@gmail.com</a> for inqueries and complaints.</p>
            </div>
</center>


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

