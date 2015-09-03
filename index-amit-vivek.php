<?php 
require_once("config/config.php");
	require_once 'config/dbconnection.php';
	db_open();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>EyeAsk.com</title>
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
<link href="css/lightSlider.css" rel="stylesheet" type="text/css" />
<link href="css/grid.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="fonts/fonts.css" rel="stylesheet" type="text/css" />
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="css/responsive.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />


<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/gplus.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="js/html5shiv.min.js"></script>
  <script src="js/respond.min.js"></script>
<![endif]-->
<style>
label.error{
	color:red !important;
}
</style>
</head>
<body>
<section id="main"><!-- // MAIN ID SECTION // -->
<section id="maininnr"><!-- // MAIN INNER SECTION // -->


<a href="javascript:void(0);" class="btn1 back_to_top"><i class="fa fa-angle-up"></i></a>
<header class="header"><!-- ////// HEADER ////// -->
	<div class="container">
    	<div class="row">
            <div class="col-xs-12">
            	<a href="javascript:void(0);" class="logo">
                	<img src="images/eyeask1.png" alt="eyeask" class="img-responsive logoimg1" />
                </a>
            	<nav class="nav1">
                	<a href="javascript:void(0);" class="navtogglebtn visible-xs">
                    	<span></span><span></span><span></span>
                    </a>
                	<ul class="navlist">
                    	<?php if (isset($_SESSION['LoginUserId']) && $_SESSION['LoginUserId']!=""){?>
                	<li><a href="<?php echo $root;?>experts.php" class="<?php if($pagename=='experts.php'){echo 'active';}?>">Browse Experts</a></li>
                     <li><a href="<?php echo $root;?>account.php" class="<?php if($pagename=='account.php'){echo 'active';}?>">My Account</a></li>   
                        <?php
						if($GLOBALS['is_expert'] == 1)
						{
							?>
							<li><a href="<?php echo $root;?>public_sessions.php" class="<?php if($pagename=='public_sessions.php'){echo 'active';}?>">Browse Requests</a></li>
							<?php
						}
						else
						{
							?>
							<li><a href="<?php echo $root;?>schedule_public.php" class="<?php if($pagename=='schedule_public.php'){echo 'active';}?>">Place Request</a></li>
							<?php
						}
						?>
						
					   <li><a href="javascript:void(0);">About</a></li>
                	
                	<?php } else {?>
                    	<li><a href="javascript:void(0);">Browse Experts</a></li>
                        <li><a href="javascript:void(0);">Place Request</a></li>
                        <li><a href="javascript:void(0);" data-toggle="modal" data-target="#accountpopup" class="singinlink">My Account</a></li>
                        <!--<li><a href="javascript:void(0);" data-toggle="modal" data-target="#accountpopup" class="signuplink">Signup</a></li>-->
                        <li><a href="javascript:void(0);">About</a></li>
                        
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header><!-- ////// HEADER ////// -->

<div class="loaderotr" style="display:none;" id="loader">
	<span class="overlay"></span>
    <div class="loading"><img src="<?php echo $root;?>/images/loader1.gif" alt="loader" /></div>
</div>
<section class="bannercont"><!-- ////// BANNER CONTAINER ////// -->
	<div class="container">
    	<div class="row">
        	<div class="col-md-10 col-md-offset-1 col-xs-12 text-center">
            	<p class="bannertxt">Expertise over live video!</p>
            	<form action="experts.php">
                <div class="searchbox">
                	<input type="text" class="form-control" placeholder="e.g. yoga classes, legal help, interior decorator" id="tags" name="tags"/>
                	<input type="hidden" name="tag_id" id="tag_id" />
                	<!-- <a href="javascript:void(0);" class="btn1 searchbtn">Search <i class="fa fa-search"></i></a> -->
                	<button type="submit" class="btn1 searchbtn">Search <i class="fa fa-search"></i></button>
                    <img src="images/round_arrow.png" alt="arrow" class="img-responsive arrw hidden-xs hidden-sm" />
                </div>
                </form>
                <ul class="tagslist">
                	<li>
                    	<a href="javascript:void(0);">Tutors, </a>
                    	<a href="javascript:void(0);">Doctors, </a>
                        <a href="javascript:void(0);">Plumbers, </a>
                        <a href="javascript:void(0);">Electricions, </a>
                        <a href="javascript:void(0);">Mechanics, </a>
                        <span> whatever you need help with. Just Ask!</span>
                    </li>
                    <li><a href="javascript:void(0);">See More Popular <i class="fa fa-angle-double-right"></i></a></li>
                </ul>
            </div>
            
        </div>
    </div>
</section><!-- ////// BANNER CONTAINER ////// -->


<section class="stepscont"><!-- // STPES // -->
	<svg class="svg-triangle top" viewBox="0 0 100 100" preserveAspectRatio="none">
	  <path d="M0 100 L100 100 L100 0 Z"></path>
	</svg>
	<div class="container">
    	<div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1">
            	<h3>How to get live advice</h3>
            	<ul class="stepslist">
                	<li>
                    	<span class="num">1</span>
                        <h6>Search expertise</h6>
                        <p>Search for expertise, filter results and select the expert that can help you out!</p>
                    </li>
                    <li>
                    	<span class="num num2">2</span>
                        <h6>Schedule video-chat</h6>
                        <p>Choose between free and paid experts and schedule a session in just minutes.</p>
                    </li>
                    <li>
                    	<span class="num num3">3</span>
                        <h6>Talk to expert</h6>
                        <p>Get live advice via video-chat and benefit from our 100% satisfaction guarantee!</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <svg class="svg-triangle bottom" viewBox="0 0 100 100" preserveAspectRatio="none">
	  <path d="M0 100 L100 100 L100 0 Z"></path>
	</svg>
</section><!-- // STPES // -->

<section class="aboutvideo"><!-- // Support Section // -->
	<div class="container">
    	<div class="row">
        	<div class="col-xs-12 col-sm-10 col-sm-offset-1 text-center">
            	<h3>Video-chat with experts</h3>
            	<p>EyeAsk is the platform for monetizing the <strong>video-conference</strong> experience. You can earn money and build and online repution in a easy, safe and efficient manner all form the comfort of your own location.</p>
                <a href="javascript:void(0);" class="signupbtn signuplink" data-toggle="modal" data-target="#accountpopup">Sign Up for free</a>
            </div>
            <div class="col-xs-12">
            	<div class="mac_frame"><img src="images/mac_frame.png" alt="24x7" class="responsiveimg" />
                	<ul id="videoslide" class="content-slider">
                        <li><img src="images/video_screen1.jpg" alt="blue_man" class="responsiveimg" /></li>
                        <li><img src="images/video_screen2.jpg" alt="blue_man" class="responsiveimg" /></li>
                        <li><img src="images/video_screen3.jpg" alt="blue_man" class="responsiveimg" /></li>
                        <li><img src="images/video_screen4.jpg" alt="blue_man" class="responsiveimg" /></li>
                        <li><img src="images/video_screen5.jpg" alt="blue_man" class="responsiveimg" /></li>
                    </ul>
                </div>
            </div>
       	</div>
	</div>
    <svg class="svg-triangle top" viewBox="0 0 100 100" preserveAspectRatio="none">
	  <path d="M0 100 L100 100 L100 0 Z"></path>
	</svg>
</section><!-- // Support Section // -->

<section class="corefeatures"><!-- // CORE FEATURES // -->
	<div class="container">
    	<div class="row">
        	<div class="col-xs-12">
            	<h3><small>Here are some of the</small>Core Features</h3>
            </div>
        </div>
        <div class="row">
        	<div class="col-xs-12 col-sm-6">
            	<div class="featureblk">
                	<i class="fa fa-search icon"></i>
                	<h5>Find verified free or paid experts</h5>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
            	<div class="featureblk">
                	<i class="fa fa-video-camera icon"></i>
                	<h5>Get 1-on-1 advice via video-chat</h5>
                </div>
            </div>            
        </div>
        <div class="row">
        	<div class="col-xs-12 col-sm-6">
            	<div class="featureblk">
                	<i class="fa fa-file-text icon"></i>
                	<h5>Receive FREE written wrap-up</h5>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
            	<div class="featureblk">
                	<i class="fa fa-cubes icon"></i>
                	<h5>Simple, fast, fun and 100% cloud-based</h5>
                </div>
            </div>            
        </div>
        <div class="row">
        	<div class="col-xs-12 col-sm-6">
            	<div class="featureblk">
                	<i class="fa fa-lock icon"></i>
                	<h5>Secured and trusted worldwide</h5>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
            	<div class="featureblk">
                	<i class="fa fa-thumbs-up icon"></i>
                	<h5>100% Satisfaction guarantee</h5>
                </div>
            </div>            
        </div>
        <div class="row">
        	<div class="col-xs-12 col-sm-6">
            	<div class="featureblk">
                	<i class="fa fa-dollar icon"></i>
                	<h5>Integrated & instant worldwide payments</h5>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
            	<div class="featureblk">
                	<i class="fa fa-star icon"></i>
                	<h5>Earn cash, reviews & reputation</h5>
                </div>
            </div>            
        </div>
    </div>
</section><!-- // CORE FEATURES // -->

<section class="testimonials"><!-- // TESTIMONIALS SECTION // -->
	<svg class="svg-triangle top" viewBox="0 0 100 100" preserveAspectRatio="none">
	  <path d="M0 100 L100 100 L100 0 Z"></path>
	</svg>
	<div class="container">
    	<div class="row">
        	<div class="col-xs-12">
            	<h3>What People Are Saying</h3>
            </div>
            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
            	<ul id="testislide" class="content-slider">
                    <li>
                    	<div class="commentsblk">
                            <p>Now i can teach my Yoga classes to 12 students from my home!!</p>
                        </div>
                        <div class="usercont">
                        	<a href="javascript:void(0);">
                            	<span class="imgblk"></span>
                                <h6>Judy Reynolds <small>Pithwa Yoga</small></h6>
                            </a>
                        </div>
                    </li>
                    <li>
                    	<div class="commentsblk">
                            <p>I was able to get my plumbing question answered in 5 minutes. and it only cost me $5. I will be using EyeAsk for all my asks.</p>
                        </div>
                        <div class="usercont">
                        	<a href="javascript:void(0);">
                            	<span class="imgblk"></span>
                                <h6>Isaak Fraigun <small>Jonesboro, Arkansas</small></h6>
                            </a>
                        </div>
                    </li>
                    <li>
                    	<div class="commentsblk">
                            <p>I needed some legal advice, but didn't want to spend $300 and hour. I found a lawyer on EyeAsk that was able to help me for just $25.</p>
                        </div>
                        <div class="usercont">
                        	<a href="javascript:void(0);">
                            	<span class="imgblk"></span>
                                <h6>Robyn Stearns <small>Los Angeles, Callifornia</small></h6>
                            </a>
                        </div>
                    </li>
                </ul>
            	
            </div>
        </div>
    </div>
    <svg class="svg-triangle bottom" viewBox="0 0 100 100" preserveAspectRatio="none">
	  <path d="M0 100 L100 100 L100 0 Z"></path>
	</svg>
</section><!-- // TESTIMONIALS SECTION // -->


<footer class="footer"><!-- // FOOTER CONTAINER // -->
	<div class="container">
    	<div class="row">
        	<div class="col-xs-12 ft_blks text-center">
            	<h4>Quick Links</h4>
                <ul class="qlinkslist">
                	<li><a href="javascript:void(0);">Home</a></li>
                    <li><a href="javascript:void(0);">About us</a></li>
                    <li><a href="javascript:void(0);">The team</a></li>
                    <li><a href="javascript:void(0);">FAQ and support</a></li>
                    <li><a href="javascript:void(0);">Partnerships & opportunities</a></li>
                    <li><a href="javascript:void(0);">Press</a></li>
                    <li><a href="javascript:void(0);">Our blog</a></li>
                </ul>
            </div>
        </div>
  	</div>
    
    <section class="footerbtm">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="socialblk">
                        <ul>
                            <li><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                    <p class="copyrighttxt">©2015 eyeask.com. All rights reserved.</p>
                </div>
            </div>
        </div>
    </section>
</footer><!-- // FOOTER CONTAINER // -->

</section><!-- // MAIN INNER SECTION // -->
</section><!-- // MAIN ID SECTION // -->


<div class="modal fade AccountModal" id="accountpopup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"><!-- // LOGIN & SIGNUP MODAL // -->
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
      </div>
      <div class="modal-body">
      	<div class="formOtr">
        	<div id="loginform" style="display:block;">
                <form id="login">
                    <h5>Sign in to continue your account</h5>
                    <div class="form-group">
                    	<p class="text-center">Login with one click with LinkedIn, Facebook & Google+</p>
                        <a href="javascript:void(0);" class="socialbtn"><i class="fa fa-linkedin"></i> Login with LinkedIn</a>
                        <a href="javascript:void(0);" class="socialbtn FB_bg"><i class="fa fa-facebook"></i> Login with Facebook</a>
                        <a href="javascript:void(0);" class="socialbtn GPlus_bg" onClick="login()"><i class="fa fa-google-plus"></i> Login with Google+</a>
                        <p class="text-center">...or use your email address and password</p>
                    </div>
                    <div id="msg"></div>
                    <div class="form-group">
                    	<label class="lbl">Email address</label>
                        <div class="fields">
                        	<input type="text" class="form-control" placeholder="Enter you email here" name="email_address" id="email_address" value="<?php if (isset($_COOKIE['email']) && $_COOKIE['email']!=""){echo trim($_COOKIE['email']);}?>"/>
                        	<i class="fa fa-user icons"></i>
                        </div>
                    </div>
                    <div class="form-group">
                    	<label class="lbl">Password</label>
                         <div class="fields">
                        	<input type="password" class="form-control" placeholder="Enter password" name="password" value="<?php if (isset($_COOKIE['password']) && $_COOKIE['password']!=""){echo trim($_COOKIE['password']);}?>"/>
                        	<i class="fa fa-key icons"></i>
                         </div>
                        <a href="javascript:void(0);" class="forgot_pass" id="send_pass">Forgot your password?</a>
                    </div>
                    <div class="form-group">
                        <div class="switch">
                            <input id="cmn-toggle-1" class="cmn-toggle cmn-toggle-round" type="checkbox" value="select" name="remember_me">
                            <label for="cmn-toggle-1"><i class="fa fa-times"></i><i class="fa fa-check"></i></label>
                            <span class="rembrme">Remenber me!</span>
                        </div>
                        <input type="hidden" value="login" name="action"/>
                        <input type="submit" value="Sign in" class="signin_btn" />
                    </div>
                    <span class="or_seprator"><span>OR</span></span>
                </form>
                <p class="content-text-outr">Not a registered user yet? &nbsp;&nbsp;<a href="javascript:void(0);" class="signuplink"> Sign up now!</a></p>
            </div>
            <div id="signupform" style="display:none;">
                <form id="sign_up">
                    <h5>Creat an account</h5>
                    <div class="form-group">
                    	<p class="text-center">Sign up with one click with LinkedIn, Facebook & Google+</p>
                        <a href="javascript:void(0);" class="socialbtn"><i class="fa fa-linkedin"></i> Sign up with LinkedIn</a>
                        <a href="javascript:void(0);" class="socialbtn FB_bg"><i class="fa fa-facebook"></i> Sign up with Facebook</a>
                        <a href="javascript:void(0);" class="socialbtn GPlus_bg" onClick="login()"><i class="fa fa-google-plus"></i> Sign up with Google+</a>
                        <p class="text-center">...or enter your email address and pick a password</p>
                    </div>
                    <div id="errors"></div>
                    <div class="form-group">
                    	<label class="lbl">Email address</label>
                        <div class="fields">
                        	<input type="text" class="form-control" placeholder="Enter you email here" name="email" id="email"/>
                        	<i class="fa fa-user icons"></i>
                        </div>
                    </div>
                    <div class="form-group">
                    	<label class="lbl">Password</label>
                         <div class="fields">
                        	<input type="password" class="form-control" placeholder="Enter password" name="password"  id="password"/>
                        	<i class="fa fa-key icons"></i>
                         </div>
                    </div>
                    <div class="form-group">
                    	<label class="lbl">Confirm Password</label>
                         <div class="fields">
                        	<input type="password" class="form-control" placeholder="Enter password" name="conf_password" id="conf_password"/>
                        	<i class="fa fa-key icons"></i>
                         </div>
                    </div>
                    <div class="form-group">
                    	<p class="trmtxt"><input type="checkbox" id="terms"/> I accept the <a href="javascript:void(0);">Terms & Conditions</a> and <a href="javascript:void(0);">Privacy Policy.</a></p>
                    </div>
                    <div class="form-group">
                    <input type="hidden" value="register" name="action"/>
                        <input type="submit" value="Sign Up" class="signin_btn" />
                    </div>
                    <span class="or_seprator"><span>OR</span></span>
                </form>
                <p class="content-text-outr">Already have an account?  &nbsp;&nbsp;<a href="javascript:void(0);" class="singinlink"> Login now!</a></p>
            </div>
            <div id="forgot_password" style="display:none;"><!-- FORGOT PASSWORD FORM -->
                <form id="get_password">
                    <h5>Forgot Password</h5>
                    <div id="message"></div>
                    <div class="form-group">
                    	<p>Enter your email address below and we'll send you instructions on how to change your password.</p>
                    </div>
                    <div class="form-group">
                    	<label class="lbl">Email address</label>
                        <div class="fields">
                        	<input type="text" class="form-control" placeholder="Enter you email here" name="email_address"/>
                        	<i class="fa fa-user icons"></i>
                        </div>
                    </div>
                    <div class="form-group">
                    <input type="hidden" name="action" value="send_password" />
                        <input type="submit" value="Send" class="signin_btn" style="width:100%;" />
                    </div>
                    <span class="or_seprator"><span>OR</span></span>
                </form>
                <p class="content-text-outr">Already have password?  &nbsp;&nbsp;<a href="javascript:void(0);" class="singinlink"> Login now!</a></p>
            </div><!-- FORGOT PASSWORD FORM -->
        </div>
      </div>
    </div>
  </div>
</div><!-- // LOGIN & SIGNUP MODAL // -->


<!-- // JQUERY AT BOTTOM // -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/jquery.lightSlider.js"></script> 
<script>
$(document).ready(function() {
	$("body").on("click",".forgot_pass",function(){
		$('#loginform').css('display','none');
		$('#forgot_password').css('display','block');
		$('#signupform').css('display','none');
	});
});
$(window).scroll(function() {
	// SCROLL HEADER //
	var scroll = $(window).scrollTop();
	if(scroll >= 100){
		$(".back_to_top").addClass("show");
	}
	else{
		$(".back_to_top").removeClass("show");
	}
});
$(document).ready(function() {
	
	// Testimonial //
	$("#testislide").lightSlider({
		loop:true,
		keyPress:true,
		controls:false,
		item:1,
		speed: 1000,
		pause: 3000,
		responsive: [],
		adaptiveHeight:true
	});
	// Video slider //
	$("#videoslide").lightSlider({
		loop:true,
		keyPress:true,
		controls:true,
		prevHtml:'<i class="fa fa-angle-left"></i>',
    	nextHtml:'<i class="fa fa-angle-right"></i>',
		item:1,
		slideMargin:0,
		responsive: [],
		pager:false
	});
	// NAVIGATION TOGGLE //
	$(".navtogglebtn").on("click", function(e) {
		$(this).toggleClass('active');
		$('body,html').find('#maininnr').toggleClass('togglemain');
		$(this).next().toggleClass('expendnav');
		e.stopPropagation()
	});
	$(document).on("click", function(e) {
		if ($(e.target).is("ul.navlist, ul.navlist li a") === false) {
		  $('.navtogglebtn').removeClass('active');
		  $('body,html').find('#maininnr').removeClass('togglemain');
		  $('.navtogglebtn').next().removeClass('expendnav');
		}
	});
	// LOGIN SIGN UP FORM //
	$('.singinlink').click(function(){
		$('#loginform').css('display','block');
		$('#signupform').css('display','none');
	});
	$('.signuplink').click(function(){
		$('#loginform').css('display','none');
		$('#signupform').css('display','block');
	});
	// Animate scroll Top //
	$(".back_to_top").click(function(){
		$("html, body").animate({ scrollTop: 0 }, 600);
		return true;
	});
	
});
$(function() {
	$("#tags").autocomplete({
		source: function(request, response) {
	        $.ajax({
	            url: "handler.php",
	            dataType: "json",
	            data: {
	                tags : request.term
	            },
	            success: function(data) {
	                response(data);
	            }
	        });
	    },
	    select: function(e, ui) {
	        e.preventDefault() // <--- Prevent the value from being inserted.
	        $("#tag_id").val(ui.item.id);
	        //$(this).val(ui.item.label);
	    }
	});
});
</script>
</script>
</body>
</html>
