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
<title>practise</title>

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
<script src="<?php echo $root;?>js/jquery.validate.min.js"></script>
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
if (isset($_SESSION['LoginUserId']) && $_SESSION['LoginUserId']!=""){
$field = " * ";
$table = " users ";
$condition = " AND id='".trim($_SESSION['LoginUserId'])."' ";
$user_detail = getDetail($field,$table,$condition);
//print_r($user_detail);
if($user_detail[0]['profile_image']!=""){ $prof_pic=$user_detail[0]['profile_image']; } else { $prof_pic= "images/users/default.jpg"; }/* profile image */
if($user_detail[0]['username']!=""){$username=$user_detail[0]['username'];} else { $username= "";}/*user name*/
if ($user_detail[0]['email']!=""){ $email=$user_detail[0]['email']; } else { $email=""; } /* user email */
if ($user_detail[0]['city']!=""){	$city =$user_detail[0]['city'];} else { $city =""; } /* user city */
if ($user_detail[0]['country_id']!="") { $country_id = $user_detail[0]['country_id'];} else { $country_id = ""; } /* user country */
if ($user_detail[0]['timezone_id']!="") {	$timezone_id = $user_detail[0]['timezone_id']; } else { $timezone_id = ""; } /* user timezone */
if ($user_detail[0]['language_id']!="") {
	$language_id = $user_detail[0]['language_id'];
	$diff_lang=array();
	$lang_detail = mysql_query("SELECT * from languages WHERE id IN($language_id)");
	while($res = mysql_fetch_assoc($lang_detail)){
		$diff_lang[]=$res['name'];
	}
	$language_id = implode(',',$diff_lang);
} else {
	$language_id = "";
	} /* user language */
if ($user_detail[0]['dob']!=""){$dob = date('m-d-Y',strtotime($user_detail[0]['dob']));}else {$dob="";}/*user date of birth  */
if ($user_detail[0]['phone']!=""){	$phone = $user_detail[0]['phone'];}else {$phone="";} /* user phone */
if ($user_detail[0]['linkedin_url']!=""){	$linkedin_url = $user_detail[0]['linkedin_url'];}else {$linkedin_url="";} /* user linkedin url */
if ($user_detail[0]['twitter_url']!=""){	$twitter_url = $user_detail[0]['twitter_url'];}else {$twitter_url="";} /* user twitter url */
if ($user_detail[0]['google_url']!=""){	$google_url = $user_detail[0]['google_url'];}else {$google_url="";} /* user google url */
if ($user_detail[0]['facebook_url']!=""){	$facebook_url = $user_detail[0]['facebook_url'];}else {$facebook_url="";} /* user facebook url */
}
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
                        	<h6><small>Welcome</small> <?php echo $username;?></h6>
                            <i class="fa fa-sort"></i>
                            <span class="userimg"><img src="<?php echo $prof_pic;?>" alt="img" class="img-responsive" /></span>
                        </a>
                        <div class="dropmenu">
                        	<ul>
                            	<li><a href="javascript:void(0);">My Account</a></li>
                                <li><a href="javascript:void(0);">My Session</a></li>
                                <li><a href="javascript:void(0);">Expert Wishlist</a></li>
                                <li><a href="javascript:void(0);">Finance</a></li>
                                <li><a href="javascript:void(0);">Help</a></li>
                                <li><a href="handler.php?method=<?php echo base64_encode("logout");?>">Logout <i class="fa fa-sign-out pull-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header><!-- ////// HEADER ////// -->
