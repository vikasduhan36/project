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
<title>Welcome to eyeask.com</title>

<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
<link href="css/lightSlider.css" rel="stylesheet" type="text/css" />
<link href="css/grid.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="fonts/fonts.css" rel="stylesheet" type="text/css" />
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
<link href="css/responsive.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo $root; ?>css/jquery-ui.css" />
<link href="css/ion.rangeSlider.css" type="text/css" rel="stylesheet" />

<script type="text/javacsript">
var root = "<?php echo $root;?>";
</script>
<script src="<?php echo $root;?>js/jquery.min.js"></script>
<script src="<?php echo $root;?>js/jquery-ui.min.js"></script>
<script src="<?php echo $root;?>js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo $root;?>js/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo $root;?>js/gplus.js"></script>
<script type="text/javascript" src="<?php echo $root;?>js/google_social.js"></script>
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

header.innerhead nav.nav1 ul.navlist li a.active{
    color: #58bde7 !important;
}
.exp_session_button
{
    background: #90aa51;
    font-size: 15px;
    font-family: 'roboto_condensedregular';
    color: #fff;
    padding: 7px 10px;
    float: right;
    margin-top: 4px;
}
.disable_button{
background-color: #555555 !important;
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
$GLOBALS['is_expert'] = $user_detail[0]['is_expert'];
//print_r($user_detail);
if($user_detail[0]['profile_image']!=""){ 
	$prof_pic=$user_detail[0]['profile_image']; 
	if (parse_url($prof_pic, PHP_URL_QUERY)){ $rep_query=explode("?",$prof_pic);$prof_pic=$rep_query['0']."?sz=200";}//else {echo "no";}
} else { $prof_pic= "images/users/default.jpg"; }/* profile image */
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
            	<a href="<?php echo $root;?>" class="logo">
				
               		<img src="images/eyeask2.png" alt="eyeask" class="img-responsive logoimg2" />
				
                </a>
                <nav class="nav1">
                	<a href="javascript:void(0);" class="navtogglebtn visible-xs">
                    	<span></span><span></span><span></span>
                    </a>
                    <ul class="navlist">
                    	<li><a href="<?php echo $root;?>experts.php" class="<?php if($pagename=='experts.php'){echo 'active';}?>">Browse Experts</a></li>
                        <?php
						if($GLOBALS['is_expert'] == 1)
						{
							?>
							<li><a href="<?php echo $root;?>public_sessions.php" class="<?php if($pagename=='public_sessions.php'){echo 'active';}?>">Browse Requests</a></li>
							<?php
						}
						else
						{
							if(!isset($_SESSION['LoginUserId']) && empty($_SESSION['LoginUserId']))
							{
							?>
							<li><a href="javascript:void(0);" data-toggle="modal" data-target="#accountpopup" class="<?php if($pagename=='schedule_public.php'){echo 'active';}?> login_page" data-login="request">Place Request</a></li>
							<?php
							}
							else
							{
							?>
							<li><a href="<?php echo $root;?>schedule_public.php" class="<?php if($pagename=='schedule_public.php'){echo 'active';}?>">Place Request</a></li>
							<?php
							}
						}
						if(!isset($_SESSION['LoginUserId']) && empty($_SESSION['LoginUserId']))
						{?>
						
                       <li><a href="javascript:void(0);" data-toggle="modal" data-target="#accountpopup" class="singinlink">My Account</a></li>
                       <?php } ?>
					   <li><a href="javascript:void(0);">About</a></li>
                    </ul>
					<?php
					if(isset($_SESSION['LoginUserId']))
					{
					?>
                   	<div class="userdropdown">
                    	<a href="javascript:void(0);">
                        	<h6><small>Welcome</small> <?php echo $username;?></h6>
                            <i class="fa fa-sort"></i>
                            <span class="userimg">
							<img src="<?php echo $prof_pic;?>" alt="img" class="img-responsive" /></span>
                        </a>
                        <div class="dropmenu">
                        	<ul>
                            	<li><a href="<?php echo $root;?>account.php">My Account</a></li>
                                <li><a href="<?php if($GLOBALS['is_expert'] == '1')
								{
									echo $root.'exp_sessions.php';	
								}
								else
								{
									echo $root.'user_sessions.php';	
								}?>">My Session</a></li>
                                <li><a href="<?php echo $root;?>wishlist.php">Expert Wishlist</a></li>
                                <li><a href="<?php echo $root;?>finance.php">Finance</a></li>
                                <li><a href="<?php echo $root;?>help.php">Help</a></li>
                                <li><a href="handler.php?method=<?php echo base64_encode("logout");?>">Logout <i class="fa fa-sign-out pull-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
					<?php
					}
					?>
                </nav>
            </div>
        </div>
    </div>
	<div id="hidden_user_id" style="display:none;"><?php
	if (isset($_SESSION['LoginUserId']) && $_SESSION['LoginUserId']!="")
	{
		echo $_SESSION['LoginUserId'];
	}
	?></div>
</header><!-- ////// HEADER ////// -->


<div class="loaderotr" style="display:none;" id="loader">
	<span class="overlay"></span>
    <div class="loading"><img src="<?php echo $root;?>/images/loader1.gif" alt="loader" /></div>
</div>