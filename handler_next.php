<?php
require_once 'config/config.php';
require_once 'config/dbconnection.php';
db_open();
require_once('phpInclude/function.php');

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