<?php 
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
<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
<link href="css/responsive.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo $root; ?>css/jquery-ui.css" />
<script type="text/javacsript">
var root = "<?php echo $root;?>";
</script>
<script src="<?php echo $root;?>js/jquery.min.js"></script>
<script src="<?php echo $root;?>js/jquery-ui.min.js"></script>
<script src="<?php echo $root;?>js/main.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="js/html5shiv.min.js"></script>
  <script src="js/respond.min.js"></script>
<![endif]-->
<style>
.success
{
	padding: 8px 15px;
    margin-bottom: 10px;
    list-style: none;
    border-radius: 4px;
	background-color:#E6F5E6;
	color:#009900
}
.error
{
	padding: 8px 15px;
    margin-bottom: 10px;
    list-style: none;
    background-color: #f5f5f5;
    border-radius: 4px;
	background-color:#FFE6E6;
	color:#ff0000
}
</style>
</head>
<body>
<?php
require_once('phpInclude/function.php');
?>
<section id="main"><!-- // MAIN ID SECTION // -->
<section id="maininnr"><!-- // MAIN INNER SECTION // -->

<a href="javascript:void(0);" class="btn1 back_to_top"><i class="fa fa-angle-up"></i></a>
<header class="header innerhead headershadow"><!-- ////// HEADER ////// -->
	<div class="container">
    	<div class="row">
            <div class="col-xs-12">
            	<a href="javascript:void(0);" class="logo">
               		<img src="images/eyeask2.png" alt="eyeask" class="img-responsive logoimg2" />
                </a>
                <nav class="nav1">
                	<a href="javascript:void(0);" class="navtogglebtn visible-xs">
                    	<span></span><span></span><span></span>
                    </a>
                    <ul class="navlist">
                    	<li><a href="javascript:void(0);">Browse Experts</a></li>
                        <li><a href="javascript:void(0);">Place Request</a></li>
                        <li><a href="javascript:void(0);">About</a></li>
                    </ul>
                   	<div class="userdropdown">
                    	<a href="javascript:void(0);">
                        	<h6><small>Welcome</small> User Name</h6>
                            <i class="fa fa-sort"></i>
                            <span class="userimg"><img src="images/users/default.jpg" alt="img" class="img-responsive" /></span>
                        </a>
                        <div class="dropmenu">
                        	<ul>
                            	<li><a href="javascript:void(0);">My Account</a></li>
                                <li><a href="javascript:void(0);">My Session</a></li>
                                <li><a href="javascript:void(0);">Expert Wishlist</a></li>
                                <li><a href="javascript:void(0);">Finance</a></li>
                                <li><a href="javascript:void(0);">Help</a></li>
                                <li><a href="javascript:void(0);">Logout <i class="fa fa-sign-out pull-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header><!-- ////// HEADER ////// -->
