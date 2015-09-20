<?php
require_once 'config/config.php';
require_once 'config/dbconnection.php';
db_open();
require_once('phpInclude/function.php');
require("twitter/twitteroauth.php");

/*forgot password send mail*/
if(isset($_POST['action']) && $_POST['action']=="send_password")
{
	// print_r($_POST);//die;
	$email   = mysql_real_escape_string(trim($_POST['email_address']));
	$password = generateRandomString();
	$condition 		 = " email = '".$email."' ";
	$checkUserExists = UserExists($condition);
	if($checkUserExists['count'] == 1)									//forgot password
	{
		$mysql_user =mysql_query("Update users set password='".$password."' WHERE email = '".$email."'  ");
		if ($mysql_user)
		{
			/* send mail to user at registration time */
			forgotPasswordMail($fromMail,$email,$password,$root);
			echo "success";
		} else
		{
			echo "error";
		}
	}else
	{
		echo "not_found";
	}

}
/* multiple select autocomplete */
if (isset($_GET['tags_index']) && $_GET['tags_index']!="")
{
	$search_query = mysql_real_escape_string(trim($_GET['tags_index']));
	if (isset($_GET['search_type']) && $_GET['search_type']=="tag")
	{
		$field = " * ";
		$table = " tags ";
		$condition = " AND name LIKE '$search_query%' ";
		$languages = getDetail($field,$table,$condition);
		$data = array();
		if(count($languages) > 0)
		{
			foreach ($languages as $key=>$value)
			{
				$data[] = array("id"=>$value['id'],"label"=>$value['name'],"value"=>$value['name']);
			}
		} else
		{
			$data[] = array("id"=>"0","label"=>"No tag found","value"=>"No tag found");
		}
	}
	else 
	{
		$field = " * ";
		$table = " users ";
		$condition = " AND is_expert='1' AND (username LIKE '$search_query%' OR fname LIKE '$search_query%' OR lname LIKE '$search_query%')";
		$languages = getDetail($field,$table,$condition);
		$data = array();
		if(count($languages) > 0)
		{
			foreach ($languages as $key=>$value)
			{
				$data[] = array("id"=>$value['id'],"label"=>$value['fname'],"value"=>$value['fname']);
			}
		} else
		{
			$data[] = array("id"=>"0","label"=>"No expert found","value"=>"No expert found");
		}
	}
	
	echo json_encode($data);
}
/////  Twitter login authentication  //////
if(isset($_GET['userSignUp']) && $_GET['userSignUp'] == 'twitter')
{
	$twitteroauth  = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET);
	$request_token = $twitteroauth->getRequestToken($root.'handler_next.php');
//print_r($request_token);die;
	$_SESSION['oauth_token'] 		= $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

	if ($twitteroauth->http_code == 200)
	{
		$url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
		header('Location: '.$url);
	}
	else
	{
		$_SESSION['message']['authError'] = $twitterAuthError;
		header("location:".$root."account.php");die;
	}
}

//// Twitter user denied the authentication  ///
if(isset($_GET['denied']) && isset($_SESSION['oauth_token_secret']))
{
	unset($_SESSION['oauth_token']);
	unset($_SESSION['oauth_token_secret']);
	unset($_SESSION['access_token']);
	header("location:".$root."account.php");die;
}

////// TWITTER fetch data  After authentication //////
if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret']))
{
	$twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
	$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
	$_SESSION['access_token'] = $access_token;
	$user_info 				  = $twitteroauth->get('account/verify_credentials');
	//print_r($user_info);die;
	if (isset($user_info->error))
	{
		$_SESSION['message']['authError'] = $twitterAuthError;
		header("location:".$root."");die;
	}
	else
	{
		
			$name = $user_info->name;
			$splitName = explode(" ",$name);
			$fname = $splitName[0];
			$lname = $splitName[count($splitName)-1];
			//$_SESSION['signUp']['id'] 				 = $user_info->id;
			//$_SESSION['signUp']['fname'] 			 = $fname;
			//$_SESSION['signUp']['lname'] 			 = $lname;
			$_SESSION['signUp']['username'] 		 = $user_info->screen_name;
			//$_SESSION['signUp']['profile_image_url'] = $user_info->profile_image_url;
			//$_SESSION['signUp']['login_type'] 		 = 'twitter';
			$user_id   = trim($_SESSION['LoginUserId']);
			$twitter_url="https://twitter.com/".trim($_SESSION['signUp']['username']);
			$update_pass = mysql_query("UPDATE users set twitter_url='".$twitter_url."' WHERE id='".$user_id."' ");
			print_r($_SESSION['signUp']);
			header("location:".$root."account.php");die;
			}
}
/* delete social link */
if (isset($_POST['action']) && $_POST['action']=="deleteLink")
{
	//print_r($_POST);die;	
	$link_type=trim($_POST['link_type']);
	$user_id = trim($_POST['user_id']);
	if($link_type=="twitter")
	{
		$twitter_mysql = mysql_query("UPDATE users set twitter_url='' WHERE id='".$user_id."' ");
		if ($twitter_mysql)
		{
			echo "success";
		} else
		{
			echo "error";
		}
	} else if($link_type=="gplus")
	{
		$twitter_mysql = mysql_query("UPDATE users set google_url='' WHERE id='".$user_id."' ");
		if ($twitter_mysql)
		{
			echo "success";
		} else
		{
			echo "error";
		}
	}
}
/* delete social link */
if (isset($_POST['action']) && $_POST['action']=="socialLogin")
{
	$user_id   = trim($_SESSION['LoginUserId']);
	
	$google_mysql = mysql_query("UPDATE users set google_url='"."https://plus.google.com/".mysql_real_escape_string(strip_tags(trim($_POST['id'])))."' WHERE id='".$user_id."' ");
	if ($google_mysql)
	{
		echo "success";
	} else
	{
		echo "error";
	}
	
}	