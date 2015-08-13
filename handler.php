<?php
require_once 'config/dbconnection.php';
db_open();
//require_once 'phpInclude/functions.php';

/*add advertisement */
 if(isset($_POST['action']) && $_POST['action']=="tags")
{
         // print_r($_POST);//die;
	$tag = mysql_real_escape_string(trim($_POST['tag']));
	$short_name      = mysql_real_escape_string(trim($_POST['short_name']));
	
	
	$add_user = "Insert into tags set name='".$tag."' ,short_name='".$short_name."' ,created='".$date."' ";
	
	$mysql_user = mysql_query($add_user);
	if ($mysql_user)
	{
		$_SESSION['db_session_id']=mysql_insert_id();
		
		echo "success";
		header("Location:index.php");
	} else 
	{
		echo "error";
	}
	
		
}

