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