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
<link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.css">

<script type="text/javacsript">
var root = "<?php echo $root;?>";
</script>
<script src="js/jquery.min.js"></script>
<!--
<script src="<?php echo $root;?>js/main.js"></script>
-->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="js/html5shiv.min.js"></script>
  <script src="js/respond.min.js"></script>
<![endif]-->

</head>
<body>


<a href="javascript:void(0);" class="btn1 back_to_top"><i class="fa fa-angle-up"></i></a>

<section class="SessionContMain"><!--//// REQUEST SUCCESS PAGE SECTION ////-->
	<div class="SessionInner">
        <header class="header sessionheader"><!-- ////// HEADER ////// -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <a href="javascript:void(0);" class="logo">
                            <img src="images/eyeask2.png" alt="eyeask" class="img-responsive logoimg1" />
                        </a>
                        <div class="session_nav" style="display:none;">
						<span class="sess_timer" style="display:none;" id="sess_timer">
							<span id="days_hd" class="tim" style='display:none;'>0</span>
							<span id="hours_hd">0</span>:
							<span id="minutes_hd">0</span>:
							<span id="seconds_hd">0</span>
					
						</span>
                            <ul>
							
                                <li><a href="javascript:void(0);" class="micsbtn" id="audio_control"></a></li>
                                <li><a href="javascript:void(0);" class="videobtn" id="video_control"></a></li>
                                <li><a href="javascript:void(0);" class="callbtn" id="end_session"></a></li>
                                <li><a href="javascript:void(0);" class="viewusrbtn active"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header><!-- ////// HEADER ////// -->
        