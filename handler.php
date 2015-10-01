<?php
require_once 'config/config.php';
require_once 'config/dbconnection.php';
db_open();
require_once('phpInclude/function.php');
//require_once 'phpInclude/functions.php';
$is_expert = 0;
if(!empty($_SESSION['LoginUserId']))
{
	$user_id = $_SESSION['LoginUserId'];
	$field = " is_expert ";
	$table = "users ";
	$condition 	= "and id='".$user_id."' ";
	$user_detail = getDetail($field,$table,$condition);
	$is_expert = $user_detail['0']['is_expert'];
}

if(isset($_POST['action']) && $_POST['action'] == 'add_partner_website')
{
	foreach($_POST['partner_category'] as $key => $value)
	{
		$sql = " INSERT INTO user_website SET user_id='".$user_id."', link='".mysql_real_escape_string(trim($_POST['partner_link'][$key]))."', cat_id='".$_POST['partner_category'][$key]."' ";
		mysql_query($sql);
	}
}

if(isset($_POST['action']) && $_POST['action'] == 'delete_website')
{
	$sql = " DELETE FROM user_website WHERE id='".$_POST['id']."' ";
	$query = mysql_query($sql);
}

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




if(isset($_POST['action']) && $_POST['action'] == 'submit_add_avail')
{
	$error = array();
	foreach($_POST as $key => $value)
	{
		$$key = $value;
	}
	$userTimezone = getUserTimezone($user_id);
	
	$sql = " DELETE FROM user_availability WHERE user_id='".$user_id."' "; 
	$query = mysql_query($sql);
	
	foreach($date_avail as $key_val => $date_val)
	{

		$from_dtime = date("Y-m-d H:i:s",strtotime((string)$timefrom[$key_val]));
		$to_dtime = date("Y-m-d H:i:s",strtotime((string)$timeto[$key_val]));
		
		$from = convertTimezone($from_dtime, $userTimezone['timezone'],$default_tz);
		$to = convertTimezone($to_dtime, $userTimezone['timezone'],$default_tz);
		
		
		//echo $from_dtime." || ".$from;
		
		$change = 0;
		if(date("Y-m-d",strtotime($from)) < date("Y-m-d",strtotime($from_dtime)))
		{
			$change = "-1";
		}
		else if(date("Y-m-d",strtotime($from)) > date("Y-m-d",strtotime($from_dtime)))
		{
			$change = "+1";
		}
		//echo " || ".$date_val;
		$dayname = changeWeekday($date_val,$change);
		
		$sql = " INSERT INTO user_availability SET user_id='".$user_id."', day='".$dayname."', `from`='".date("H:i:s",strtotime($from))."', `to`='".date("H:i:s",strtotime($to))."',created='".$date."' ";
		$qry = mysql_query($sql) or die(mysql_error());
		if(!$qry)
		{
			$error[] = 1;
		}
	}
	
	if(in_array(1,$error))
	{
		echo "error";exit();
	}
	else
	{
		echo "success";exit();
	}
}
else if(isset($_POST['action']) && $_POST['action'] == 'get_user_avail')
{
	//$user_id = $_POST['user_id'];
	$date_selected = $_POST['date'];
	
	$default_availability = default_availability();
	$available = array();

	$userTimezone = getUserTimezone($user_id);
	$current_time = convertTimezone($date,$default_tz,$userTimezone['timezone']);
	$all = array();
	$format_all = array();
	
	
	$dayname_cr = date("l",strtotime($date_selected));
	
	$dayname_next = changeWeekday($dayname_cr,"+1");
	$dayname_prev = changeWeekday($dayname_cr,"-1");
		
		
	
	$field = "day,`from`,`to`";
	$table = "user_availability";
	$condition = "and day IN('".$dayname_prev."','".$dayname_cr."','".$dayname_next."') ";
	$get_avail = getDetail($field,$table,$condition);
			
	$available_day = array();		
		$i = 0;
	foreach($get_avail as  $datetime)
	{
		$from_dtime 	= date("Y-m-d",strtotime($date_selected))." ".$datetime['from'];
		$to_dtime 		= date("Y-m-d",strtotime($date_selected))." ".$datetime['to'];
		$dayname_db 	= $datetime['day'];

		$from 			= convertTimezone($from_dtime,$default_tz,$userTimezone['timezone']);
		$to 			= convertTimezone($to_dtime,$default_tz,$userTimezone['timezone']);
		
		
		$change = "0";
		if(date("Y-m-d",strtotime($from)) > date("Y-m-d",strtotime($from_dtime)))
		{
			$change = "+1";
		}
		else if(date("Y-m-d",strtotime($from)) < date("Y-m-d",strtotime($from_dtime)))
		{
			$change = "-1";
		}
		
		
		$dayname_vl = changeWeekday($datetime['day'],$change);
		//echo $from_dtime." | ".$from." | ".$datetime['day']."<br>";
		$available_day[$dayname_vl][$i]['from'] = date("H:i:s",strtotime($from));
		$available_day[$dayname_vl][$i]['to'] = date("H:i:s",strtotime($to));
		$i++;
	}
	//print "<pre>";print_r($available_day);print "</pre>";
	//die;
	foreach($default_availability as $time_val)
	{
		$time = $date_selected." ".$time_val;
		if(strtotime($time) > strtotime($current_time))
		{
			$all[] = date("Y-m-d H:i:s",strtotime($time));
			$format_all[] = formatDate($time);
			if(isset($available_day[$dayname_cr]) && count($available_day[$dayname_cr])>0)
			{
				foreach($available_day[$dayname_cr] as $key => $value)
				{
					if( (strtotime($time_val) >= strtotime($available_day[$dayname_cr][$key]['from'])) && (strtotime($time_val) < strtotime($available_day[$dayname_cr][$key]['to'])) )
					{
						$available[] = date("Y-m-d H:i:s",strtotime($time));
					}
				}
			}
		}
			
	}
	
		
	echo json_encode(array('all'=>array_unique($all),'format_all'=>array_unique($format_all),'available'=>array_unique($available)));
}
else if(isset($_POST['action']) && $_POST['action'] == 'submit_book_schedule')
{
	$error = array();
	foreach($_POST as $key => $value)
	{
		if(!is_array($value))
		{
			$$key = mysql_real_escape_string(trim($value));
		}
		else
		{
			$$key = $value;
		}
	}
	$userTimezone = getUserTimezone($user_id);
	//exp_id
	
	$sql = " INSERT INTO sessions SET user_id='".$user_id."',exp_applied_id='".$exp_id."', type='schedule',duration='".$duration."',title='".$title."',description='".$description."',question='".$question."',other='".$other."',status='1',created='".$date."' ";
	$query = mysql_query($sql);
	if($query)
	{
		$session_id = mysql_insert_id();
		
		foreach($slot_selected as $slot_val)
		{
			$slot = convertTimezone($slot_val,$userTimezone['timezone'],$default_tz);
			$sql = " INSERT INTO session_time SET user_id='".$user_id."', session_id='".$session_id."', datetime='".$slot."' ";
			$query = mysql_query($sql);
			if(!$query)
			{
				$error[] = '1';
			}
		}
	}
	else
	{
		$error[] = '1';
	}
	
	if(in_array(1,$error))
	{
		echo json_encode(array("status"=>"error"));exit();
	}
	else
	{
		
		$field = "fname,lname,email";
		$table = "users";
		$condition = "and id = '".$exp_id."' ";
		$get_exp = getDetail($field,$table,$condition);
	
		$field = "title";
		$table = "sessions";
		$condition = "and id = '".$session_id."' ";
		$get_session = getDetail($field,$table,$condition);
		
		$field = "fname,lname,email";
		$table = "users";
		$condition = "and id = '".$user_id."' ";
		$get_user = getDetail($field,$table,$condition);
		
		//to user
		$subject = "Booking request sent";
		$body = "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>Your booking request to book ".$get_exp[0]['fname']." ".$get_exp[0]['lname']." for a session about <b>".$get_session[0]['title']."</b> has now been sent to the expert.</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>We'll keep you posted when the expert accepts or rejects your booking request.</p>";
		$emailTo = $get_user[0]['email'];
		schedulingMail($fromMail,$emailTo,$subject,$body,$root);


		//to expert
		$subject = "New booking request";
		$body = "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>".$get_user[0]['fname']." ".$get_user[0]['lname']." has sent you a booking request for session <b>".$get_session[0]['title']."</b>.</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>TO respond to the request, Click on the link below:</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'><a href='".$root."session_request.php?id=".$session_id."'>".$root."session_request.php?id=".$session_id."</a></p>";
		$emailTo = $get_exp[0]['email'];
		schedulingMail($fromMail,$emailTo,$subject,$body,$root);
		
		
		echo json_encode(array("status"=>"success","id"=>$session_id));exit();
	}
}
else if(isset($_POST['action']) && $_POST['action'] == 'submit_accept_session')
{
	
	$error = array();
	foreach($_POST as $key => $value)
	{
		$$key = $value;
	}
	//$slot
	$userTimezone = getUserTimezone($user_id);
	$tab = "schedule";

		$field = "title,exp_applied_id,user_id";
		$table = "sessions";
		$condition = "and id = '".$session_id."' ";
		$get_session = getDetail($field,$table,$condition);
		
		$field = "fname,lname,email";
		$table = "users";
		$condition = "and id = '".$get_session[0]['exp_applied_id']."' ";
		$get_exp = getDetail($field,$table,$condition);
	
		$field = "fname,lname,email";
		$table = "users";
		$condition = "and id = '".$get_session[0]['user_id']."' ";
		$get_user = getDetail($field,$table,$condition);
		
	if($type == 'accept')
	{
		$slot_tz = convertTimezone($slot,$userTimezone['timezone'],$default_tz);
		$sql= " UPDATE sessions SET session_datetime='".$slot_tz."',exp_reschedule='0',user_reschedule='0', status='2' WHERE id='".$session_id."' ";
		$query = mysql_query($sql);
	
		
		
		//to user
		$subject = "Session scheduled";
		$body = "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>Your session <b>".$get_session[0]['title']."</b> with expert <b>".$get_exp[0]['fname']." ".$get_exp[0]['lname']."</b> has been scheduled.</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>TO participate in the session, Click on the link below:</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'><a href='".$root."user_sessions.php?tab=schedule'>".$root.".user_sessions.php?tab=schedule</a></p>";
		$emailTo = $get_user[0]['email'];
		schedulingMail($fromMail,$emailTo,$subject,$body,$root);

		//to expert
		$subject = "Session scheduled";
		$body = "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>Your have been booked for session <b>".$get_session[0]['title']."</b> with user <b>".$get_user[0]['fname']." ".$get_user[0]['lname']."</b> has been scheduled.</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>TO participate in the session, Click on the link below:</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'><a href='".$root."exp_sessions.php?tab=schedule'>".$root.".exp_sessions.php?tab=schedule</a></p>";
		$emailTo = $get_exp[0]['email'];
		schedulingMail($fromMail,$emailTo,$subject,$body,$root);
		
	}
	else if($type == 'request')
	{
		$tab = "open";
		$field = "is_expert";
		$table = "users";
		$condition = "and id = '".$user_id."' ";
		$get_avail = getDetail($field,$table,$condition);
		
		
		
		if($get_avail[0]['is_expert'] == '1')
		{
			$reschedule_field = 'exp_reschedule';
			$reset_field = 'user_reschedule';
		}
		else 
		{
			$reschedule_field = 'user_reschedule';
			$reset_field = 'exp_reschedule';
		}
		$sql= " UPDATE sessions SET ".$reschedule_field."='1', ".$reset_field."='0' WHERE id='".$session_id."' ";
		$query = mysql_query($sql);
		if($query)
		{
			$sql = " DELETE FROM session_time WHERE session_id='".$session_id."' ";
			$query = mysql_query($sql);
			if($query)
			{
				foreach($slot_selected as $key => $value)
				{
					$datetime = convertTimezone($value,$userTimezone['timezone'],$default_tz);
					$sql = " INSERT INTO session_time SET user_id='".$user_id."', session_id='".$session_id."', datetime='".$datetime."' ";
					$query = mysql_query($sql);
				}
	if($get_avail[0]['is_expert'] == '1')
	{			
		//to user
		$subject = "Session Re-scheduled";
		$body = "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>Expert <b>".$get_exp[0]['fname']." ".$get_exp[0]['lname']."</b> has requested to reschedule the session <b>".$get_session[0]['title']."</b>.</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>TO respond to the session, Click on the link below:</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'><a href='".$root."session_request.php?id=".$session_id."'>".$root."session_request.php?id=".$session_id."</a></p>";
		$emailTo = $get_user[0]['email'];
		schedulingMail($fromMail,$emailTo,$subject,$body,$root);

		//to expert
		$subject = "Session Re-scheduled";
		$body = "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>Your reschedule request for session <b>".$get_session[0]['title']."</b> has been sent to the user <b>".$get_user[0]['fname']." ".$get_user[0]['lname']."</b>.</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>TO respond to the session, Click on the link below:</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'><a href='".$root."exp_sessions.php?tab=open'>".$root.".exp_sessions.php?tab=open</a></p>";
		$emailTo = $get_exp[0]['email'];
		schedulingMail($fromMail,$emailTo,$subject,$body,$root);
	}	
	else
	{
		//to user
		$subject = "Session Re-scheduled";
		$body = "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>Your reschedule request for session <b>".$get_session[0]['title']."</b> has been sent to the Expert <b>".$get_exp[0]['fname']." ".$get_exp[0]['lname']."</b>.</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>TO respond to the session, Click on the link below:</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'><a href='".$root."exp_sessions.php?tab=open'>".$root.".exp_sessions.php?tab=open</a></p>";
		$emailTo = $get_user[0]['email'];
		schedulingMail($fromMail,$emailTo,$subject,$body,$root);

		//to expert
		$subject = "Session Re-scheduled";
		$body = "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>User <b>".$get_user[0]['fname']." ".$get_user[0]['lname']."</b> has requested to reschedule the session <b>".$get_session[0]['title']."</b>.</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>TO respond to the session, Click on the link below:</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'><a href='".$root."session_request.php?id=".$session_id."'>".$root."session_request.php?id=".$session_id."</a></p>";
		$emailTo = $get_exp[0]['email'];
		schedulingMail($fromMail,$emailTo,$subject,$body,$root);
	}
		
			}
		}
	}
	
	if($query)
	{
		
		$status = "success";
	}
	else
	{
		$status = "error";
	}
	echo json_encode(array('status'=>$status,'is_expert'=>$is_expert,'tab'=>$tab));
	
}
else if(isset($_POST['action']) && $_POST['action'] == 'submit_accept_public')
{
	
	$error = array();
	foreach($_POST as $key => $value)
	{
		$$key = $value;
	}
	//$slot
	$tab = "schedule";
	$userTimezone = getUserTimezone($user_id);
	
		
		
	if($is_expert == "1")
	{
		$tab = "open";
		$sql 	= " DELETE FROM session_time WHERE session_id='".$session_id."' and user_id='".$user_id."' ";
		$query 	= mysql_query($sql);
		if($query)
		{
			if($type == 'accept')
			{
				$slot_val = $slot;
			}
			else
			{
				$slot_val = $slot_selected;
			}
			foreach($slot_val as $key => $value)
			{
				$datetime = convertTimezone($value,$userTimezone['timezone'],$default_tz);
				$sql = " INSERT INTO session_time SET user_id='".$user_id."', session_id='".$session_id."', datetime='".$datetime."' ";
				$query = mysql_query($sql);
			}
		
		$field = "title,user_id,exp_applied_id";
		$table = "sessions";
		$condition = "and id = '".$session_id."' ";
		$get_session = getDetail($field,$table,$condition);
		
		$field = "fname,lname,email";
		$table = "users";
		$condition = "and id = '".$_SESSION['LoginUserId']."' ";
		$get_exp = getDetail($field,$table,$condition);
	
		$field = "fname,lname,email";
		$table = "users";
		$condition = "and id = '".$get_session[0]['user_id']."' ";
		$get_user = getDetail($field,$table,$condition);
				
	
		//to user
		$subject = "Apply to public request";
		$body = "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>Expert <b>".$get_exp[0]['fname']." ".$get_exp[0]['lname']."</b> has replied to public session <b>".$get_session[0]['title']."</b>.</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>TO view session detail, Click on the link below:</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'><a href='".$root."public_request.php?id=".$session_id."'>".$root."public_request.php?id=".$session_id."</a></p>";
		
		$emailTo = $get_user[0]['email'];
		schedulingMail($fromMail,$emailTo,$subject,$body,$root);


		//to expert
		$subject = "Apply to public request";
		$body = "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>You had replied to user <b>".$get_exp[0]['fname']." ".$get_exp[0]['lname']."</b> for public session <b>".$get_session[0]['title']."</b>.</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>TO view session detail, Click on the link below:</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'><a href='".$root."public_request.php?id=".$session_id."'>".$root."public_request.php?id=".$session_id."</a></p>";
		$emailTo = $get_exp[0]['email'];
		schedulingMail($fromMail,$emailTo,$subject,$body,$root);
		
		
		}
	}
	else
	{
	
	$field = "title,user_id,exp_applied_id";
		$table = "sessions";
		$condition = "and id = '".$session_id."' ";
		$get_session = getDetail($field,$table,$condition);
		
		$field = "fname,lname,email";
		$table = "users";
		$condition = "and id = '".$exp_hired."' ";
		$get_exp = getDetail($field,$table,$condition);
	
		$field = "fname,lname,email";
		$table = "users";
		$condition = "and id = '".$get_session[0]['user_id']."' ";
		$get_user = getDetail($field,$table,$condition);
		
		$sql = " UPDATE sessions SET exp_hired='".$exp_hired."' WHERE id='".$session_id."' ";
		$query = mysql_query($sql);
		if($query)
		{
			if($type == 'accept')
			{
				$tab = "schedule";
				$slot_tz = convertTimezone($slot,$userTimezone['timezone'],$default_tz);
				$sql = " UPDATE sessions SET session_datetime='".$slot_tz."', exp_applied_id='".$exp_hired."',status='2' WHERE id='".$session_id."' ";
				$query = mysql_query($sql);
				
		
		//to user
		$subject = "Booking confirmation";
		$body = "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>You had booked Expert <b>".$get_exp[0]['fname']." ".$get_exp[0]['lname']."</b> for public session <b>".$get_session[0]['title']."</b>.</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>TO participate in the session, Click on the link below:</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'><a href='".$root."user_sessions.php.php?tab=schedule'>".$root."user_sessions.php.php?tab=schedule</a></p>";
		
		$emailTo = $get_user[0]['email'];
		schedulingMail($fromMail,$emailTo,$subject,$body,$root);


		//to expert
		$subject = "Booking confirmation";
		$body = "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>You have booked by user <b>".$get_user[0]['fname']." ".$get_user[0]['lname']."</b> for public session <b>".$get_session[0]['title']."</b>.</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>TO participate in the session, Click on the link below:</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'><a href='".$root."exp_sessions.php.php?tab=schedule'>".$root."exp_sessions.php.php?tab=schedule</a></p>";
		
		$emailTo = $get_exp[0]['email'];
		schedulingMail($fromMail,$emailTo,$subject,$body,$root);
		
		
			}
			else
			{
				$tab = "open";
				$sql 	= " DELETE FROM session_time WHERE session_id='".$session_id."' ";
				$query 	= mysql_query($sql);
				if($query)
				{
					$slot_val = $slot_selected;
					foreach($slot_val as $key => $value)
					{
						$datetime = convertTimezone($value,$userTimezone['timezone'],$default_tz);
						$sql = " INSERT INTO session_time SET user_id='".$user_id."', session_id='".$session_id."', datetime='".$datetime."' ";
						$query = mysql_query($sql);
					}
				}
				
	
		//to user
		$subject = "Reschedule Request";
		$body = "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>You had sent a reschedule request to Expert <b>".$get_exp[0]['fname']." ".$get_exp[0]['lname']."</b> for public session <b>".$get_session[0]['title']."</b>.</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>TO view the session detail, Click on the link below:</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'><a href='".$root."public_request.php?id=".$session_id."'>".$root."public_request.php?id=".$session_id."</a></p>";
		$emailTo = $get_user[0]['email'];
		schedulingMail($fromMail,$emailTo,$subject,$body,$root);


		//to expert
		$subject = "Reschedule Request";
		$body = "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>You have been requested for resvhedule by user <b>".$get_user[0]['fname']." ".$get_user[0]['lname']."</b> for public session <b>".$get_session[0]['title']."</b>.</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>TO view the session detail, Click on the link below:</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'><a href='".$root."public_request.php?id=".$session_id."'>".$root."public_request.php?id=".$session_id."</a></p>";
		$emailTo = $get_exp[0]['email'];
		schedulingMail($fromMail,$emailTo,$subject,$body,$root);
		
		
			}
		}
	}
	if($query)
	{
		$status = "success";
	}
	else
	{
		$status = "error";
	}
	echo json_encode(array('status'=>$status,'is_expert'=>$is_expert,'tab'=>$tab));
	
	
	
}
else if(isset($_POST['action']) && $_POST['action'] == 'submit_cancel_session')
{
	$session_id = $_POST['id'];
	$sql = " UPDATE sessions SET status='0' WHERE id='".$session_id."' ";
	$query = mysql_query($sql);
	if($query)
	{
		$status = 'success';
		
		$field = "title,user_id,exp_applied_id";
		$table = "sessions";
		$condition = "and id = '".$session_id."' ";
		$get_session = getDetail($field,$table,$condition);
		
		$field = "fname,lname,email";
		$table = "users";
		$condition = "and id = '".$get_session[0]['exp_applied_id']."' ";
		$get_exp = getDetail($field,$table,$condition);
	
		$field = "fname,lname,email";
		$table = "users";
		$condition = "and id = '".$get_session[0]['user_id']."' ";
		$get_user = getDetail($field,$table,$condition);
		
		//to user
		$subject = "Schedule cancelled";
		$body = "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>Your session <b>".$get_session[0]['title']."</b> with expert <b>".$get_exp[0]['fname']." ".$get_exp[0]['lname']."</b> has cancelled.</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>TO view session detail, Click on the link below:</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'><a href='".$root."session_request.php?id=".$session_id."'>".$root."session_request.php?id=".$session_id."</a></p>";
		
		$emailTo = (!empty($get_user[0]['email']))?$get_user[0]['email']:'';
		schedulingMail($fromMail,$emailTo,$subject,$body,$root);


		//to expert
		$subject = "Schedule cancelled";
		$body = "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>Your session <b>".$get_session[0]['title']."</b> with user <b>".$get_user[0]['fname']." ".$get_user[0]['lname']."</b> has cancelled.</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'>TO view session detail, Click on the link below:</p>";
		$body .= "<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'><a href='".$root."session_request.php?id=".$session_id."'>".$root."session_request.php?id=".$session_id."</a></p>";
		$emailTo = $get_exp[0]['email'];
		schedulingMail($fromMail,$emailTo,$subject,$body,$root);
		
		
	}
	else
	{
		$status = 'error';
	}
	echo json_encode(array('status'=>$status,'is_expert'=>$is_expert));exit();
}
else if(isset($_POST['action']) && $_POST['action'] == 'tag_search')
{
	$keyword = mysql_real_escape_string(trim($_POST['keyword']));
	
	$field = "id,name";
	$table = "tags";
	$condition 	= " and name LIKE '%".$keyword."%' and status='1' ";
	$tags = getDetail($field,$table,$condition);
	
	$status = 'success';
	if(count($tags) == 0)
	{
		$status = 'no_record';
	}
	echo json_encode(array('status'=>$status,'result'=>$tags));
	exit();
	
}
else if(isset($_POST['action']) && $_POST['action'] == 'language_search')
{
	$keyword = mysql_real_escape_string(trim($_POST['keyword']));
	
	$field = "id,name";
	$table = "languages";
	$condition 	= " and name LIKE '%".$keyword."%' and status='1' ";
	$tags = getDetail($field,$table,$condition);
	
	$status = 'success';
	if(count($tags) == 0)
	{
		$status = 'no_record';
	}
	echo json_encode(array('status'=>$status,'result'=>$tags));
	exit();
	
}
else if(isset($_POST['action']) && $_POST['action'] == 'submit_book_schedule_public')
{
	$session_id = "";
	$error = array();
	foreach($_POST as $key => $value)
	{
		if(!is_array($value))
		{
			$value = (empty($value))?'':$value;
			$$key = mysql_real_escape_string(trim($value));
		}
		else
		{
			$value = (empty($value))?array():$value;
			$$key = $value;
		}
	}
	$userTimezone = getUserTimezone($user_id);
	//exp_id
	if (!isset($tag_selected))
	{
	$tag_selected = array();
	}
	if (!isset($language_selected))
	{
	$language_selected = array();
	}
	if (!isset($slot_selected))
	{
	$slot_selected = array();
	}
	//$tag_selected = (isset(($tag_selected)))?array():$tag_selected;
	//$language_selected = (isset(($language_selected)))?array():$language_selected;
	
	$sql = " INSERT INTO sessions SET user_id='".$user_id."',category_id='".$category_id."', tag_id='".implode($tag_selected,',')."',language_id='".implode($language_selected,',')."', type='request',duration='".$duration."',title='".$title."',description='".$description."',question='".$question."',other='".$other."',status='1',created='".$date."' ";
	$query = mysql_query($sql);
	if($query)
	{
		$session_id = mysql_insert_id();
		
		foreach($slot_selected as $slot_val)
		{
			$slot = convertTimezone($slot_val,$userTimezone['timezone'],$default_tz);
			$sql = " INSERT INTO session_time SET user_id='".$user_id."', session_id='".$session_id."', datetime='".$slot."' ";
			$query = mysql_query($sql);
			if(!$query)
			{
				$error[] = '1';
			}
		}
	}
	else
	{
		$error[] = '1';
	}
	
	if(in_array(1,$error))
	{
		echo json_encode(array("status"=>"error"));exit();
	}
	else
	{
		echo json_encode(array("status"=>"success","id"=>$session_id));exit();
	}
}
else if(isset($_POST['action']) && $_POST['action'] == 'get_search_exp')
{
	foreach($_POST as $key => $value)
	{
		$$key = $value;
	}
	if(empty($user_id))
	{
	$user_id=0;
	}
	$condition = "";
	$result = array();
	$status = "error";
	$count = 0;
	
	/* add new field expert name */
	if(!empty($expert_search))
	{
		$condition .= " and (u.lname = '".$expert_search."' OR u.fname = '".$expert_search."' OR u.username = '".$expert_search."') ";
	}
	
	if(!empty($category_id))
	{
		$condition .= " and u.exp_category_id = '".$category_id."' ";
	}
	
	if(!empty($tag_selected))
	{
		$condition .= " and ( ";
		foreach($tag_selected as $id)
		{
			$condition .= " FIND_IN_SET('".$id."',u.exp_tag_id) > 0 OR";
		}
		$condition = substr($condition,0,-2);
		$condition = $condition." ) ";
	}
	
	if(!empty($language_selected))
	{
		$condition .= " and ( ";
		foreach($language_selected as $id)
		{
			$condition .= " FIND_IN_SET('".$id."',u.language_id) > 0 OR";
		}
		$condition = substr($condition,0,-2);
		$condition = $condition." ) ";
	}
	
	if(!empty($price_from) || !empty($price_to))
	{
		$price_from = (empty($price_from))?0:$price_from;
		$price_to = (empty($price_to))?500:$price_to;
		$condition .= " and (u.exp_rate >= '".$price_from."' and u.exp_rate <= '".$price_to."') ";
	}
	if(!empty($search_type))
	{
		$condition .= " and w.user_id = '".$user_id."' ";
	}
	
	
	$sql  = " SELECT SQL_CALC_FOUND_ROWS u.exp_tag_id,u.id,u.language_id, u.fname,u.lname, u.profile_image, u.city,u.country_id,u.exp_about,u.exp_rate,u.exp_description,u.linkedin_url,u.twitter_url,u.google_url,u.facebook_url, ";
	$sql .= " ( SELECT name FROM categories WHERE id = u.exp_category_id) as category "; 
	//$sql .= " ( SELECT GROUP_CONCAT(name) FROM languages WHERE id IN(l_id)) as language, "; 
	$sql .= " , ( SELECT wished_id FROM wishlist WHERE  user_id='".$user_id."' and wishlist.wished_id=u.id)as wished "; 
	$sql .= " FROM users as u";
	if(!empty($search_type))
	{
		$sql .= " LEFT JOIN wishlist as w ON(w.wished_id = u.id)";
	}
	$sql .= " WHERE 1=1 and is_expert='1' and u.id != '".$user_id."' ".$condition." ";
	
	$query = mysql_query($sql) or die(mysql_error());
	if($query)
	{
		if(mysql_num_rows($query) > 0)
		{
			$count_row = mysql_fetch_assoc(mysql_query("SELECT FOUND_ROWS() as count"));
			$count = $count_row['count'];
			$status 	= "success";
			while($fetch = mysql_fetch_assoc($query))
			{
				
				
				$field = " GROUP_CONCAT(name) as name ";
				$table = "tags";
				$condition 	= " and id IN(".$fetch['exp_tag_id'].") ";
				$tags = getDetail($field,$table,$condition);
				
				$field = " GROUP_CONCAT(name) as name ";
				$table = "languages";
				$condition 	= " and id IN(".$fetch['language_id'].") ";
				$languages = getDetail($field,$table,$condition);
				
				
				$fetch['tag'] = (!empty($tags[0]['name']))?$tags[0]['name']:'';
				$fetch['language'] = (!empty($languages[0]['name']))?$languages[0]['name']:'';
				$result[] = $fetch;
				//$result[]
	
			}
		}
		else
		{
			$status = "no_record";
		}
	}
	
	echo json_encode( array('status'=>$status,'count'=>$count,'result'=>$result) );
}
else if(isset($_POST['action']) && $_POST['action'] == 'get_public_request')
{
	foreach($_POST as $key => $value)
	{
		$$key = $value;
	}
	$condition = "";
	$result = array();
	$status = "error";
	$count = 0;
	
	if(!empty($category_id))
	{
		$condition .= " and s.category_id = '".$category_id."' ";
	}
	
	if(!empty($tag_selected))
	{
		$condition .= " and ( ";
		foreach($tag_selected as $id)
		{
			$condition .= " FIND_IN_SET('".$id."',s.tag_id) > 0 OR";
		}
		$condition = substr($condition,0,-2);
		$condition = $condition." ) ";
	}
	
	if(!empty($language_selected))
	{
		$condition .= " and ( ";
		foreach($language_selected as $id)
		{
			$condition .= " FIND_IN_SET('".$id."',s.language_id) > 0 OR";
		}
		$condition = substr($condition,0,-2);
		$condition = $condition." ) ";
	}
	
	$sql   = " SELECT SQL_CALC_FOUND_ROWS s.id,s.title,s.created,s.description,s.language_id, ";
	$sql  .= " s.tag_id,u.fname,u.lname,u.profile_image ";
	$sql  .= ", ( SELECT name FROM categories WHERE id = s.category_id) as category "; 
	$sql  .= " FROM sessions as s LEFT JOIN users as u ON(s.user_id = u.id)";
	$sql  .= " WHERE s.status = '1' and s.exp_hired='0' and s.type='request' ".$condition." ORDER BY s.id DESC";

	$query = mysql_query($sql) or die(mysql_error());
	if($query)
	{
		if(mysql_num_rows($query) > 0)
		{
			$count_row = mysql_fetch_assoc(mysql_query("SELECT FOUND_ROWS() as count"));
			$count = $count_row['count'];
			$status 	= "success";
			while($fetch = mysql_fetch_assoc($query))
			{
				
				$field = " GROUP_CONCAT(name) as name ";
				$table = "tags";
				$condition 	= " and id IN(".$fetch['tag_id'].") ";
				$tags = getDetail($field,$table,$condition);
				
				$field = " GROUP_CONCAT(name) as name ";
				$table = "languages";
				$condition 	= " and id IN(".$fetch['language_id'].") ";
				$languages = getDetail($field,$table,$condition);
				
				
				$fetch['tag'] = (!empty($tags[0]['name']))?$tags[0]['name']:'';
				$fetch['language'] = (!empty($languages[0]['name']))?$languages[0]['name']:'';
				$result[] = $fetch;
				//$result[]
	
			}
		}
		else
		{
			$status = "no_record";
		}
	}
	
	echo json_encode( array('status'=>$status,'count'=>$count,'result'=>$result) );
}
else if(isset($_POST['action']) && $_POST['action'] == 'submit_wishlist')
{
	$id = $_POST['id'];
	$type = $_POST['type'];
	if($type == 'add')
	{
		$sql = " INSERT into wishlist SET user_id='".$user_id."', wished_id='".$id."', created='' ";
		$query = mysql_query($sql);
	}
	else if($type == 'remove')
	{
		$sql = " DELETE from wishlist WHERE user_id='".$user_id."' and wished_id='".$id."' ";
		$query = mysql_query($sql);
	}
	if($query)
	{
		echo "success";exit();
	}
	else
	{
		echo "error";exit();
	}
	
	
}
else if(isset($_POST['action']) && $_POST['action']=="onlineUserDetail")
{
	$user_id = $_POST['user_id'];
	$exp_id = $_POST['exp_id'];
	//$for = $_POST['for'];
	$status = 'error';
	$data = array();
	
	$sql  = " SELECT s.id as s_id, s.session_datetime,s.duration,s.title,s.description,s.question, ";
	$sql .= " u.id,u.fname,u.lname ";
	$sql .= " FROM sessions as s LEFT JOIN users as u ON(s.user_id = u.id) ";
	$sql .= " WHERE s.exp_applied_id='".$exp_id."' and s.status='2' ";
	$sql .= " and user_id='".$user_id."' ";
	$sql .= " and ('".$date."' >= s.session_datetime and '".$date."' <= DATE_ADD(s.session_datetime, INTERVAL s.duration MINUTE)) or (s.time_requested = '1') ";
			
			
	$query = mysql_query($sql) or die(mysql_error());
	if($query)
	{
		if( mysql_num_rows($query) == 1 )
		{
			$status = 'success';
			$fetch = mysql_fetch_assoc($query);
			$data = $fetch;
			$endTime = date('Y-m-d H:i:s',strtotime($fetch['session_datetime'].' '.$fetch['duration'].' minutes'));
			$diff = daysRemaining($date,$endTime,true);
			$data['timer'] = $diff;
		
		}
		
	}
	echo json_encode(array('status'=>$status,'data'=>$data));
}
else if(isset($_POST['action']) && $_POST['action']=="timeRequest")
{
	$sql = "UPDATE sessions SET time_requested='1' WHERE id='".$_POST['s_id']."' ";
	$query = mysql_query($sql);
}
else if(isset($_POST['action']) && $_POST['action']=="startTimeTrack")
{
	$s_id = $_POST['s_id'];
	$sql = "UPDATE sessions SET video_start_time='".$date."' WHERE user_id='".$_SESSION['LoginUserId']."' and id='".$s_id."' ";
	$query = mysql_query($sql);
}
else if(isset($_POST['action']) && $_POST['action']=="stopTimeTrack")
{
	$s_id = $_POST['s_id'];
	$sql = "UPDATE sessions SET video_duration = video_duration+TIME_TO_SEC(TIMEDIFF('".$date."',video_start_time)) WHERE id='".$s_id."' ";
	$query = mysql_query($sql);
}
if(isset($_POST['action']) && $_POST['action']=="googleLogin")
{
	//print_r($_POST);die;
	$login_type="google";
	$condition 		 = " email = '".$_POST['email']."' ";
	$checkUserExists = UserExists($condition);
	$randomString = generateRandomString();
	if($checkUserExists['count'] == 0)									//SIGN UP
	{
		$fb_login ="Insert into users set login_type='".mysql_real_escape_string(strip_tags(trim($login_type)))."'  ,username='".mysql_real_escape_string(strip_tags(trim($_POST['name'])))."',google_url='"."https://plus.google.com/".mysql_real_escape_string(strip_tags(trim($_POST['id'])))."' ,profile_image='".mysql_real_escape_string(strip_tags(trim($_POST['image'])))."' , ";
		$fb_login .="email='".mysql_real_escape_string(strip_tags(trim($_POST['email'])))."',gender='".mysql_real_escape_string(strip_tags(trim($_POST['gender'])))."' ,fname='".mysql_real_escape_string(strip_tags(trim($_POST['fname'])))."' ,lname='".mysql_real_escape_string(strip_tags(trim($_POST['lname'])))."' ";
		$mysql=mysql_query($fb_login) or die(mysql_error());
		if($mysql)
		{
			$id=mysql_insert_id();
			/* if (isset($checkUserExists['password']) && ($checkUserExists['password']=="")
			{ */
				mysql_query("Update users set password='".$randomString."' WHERE id='".$id."' ");
			/* send mail to user at registration time */
				registrationMail($fromMail,  trim($_POST['email'])  ,$randomString,$root);
			//}
			$_SESSION['message']['user_login'] = "succesfuly Login";
			$_SESSION['LoginUserId'] = $id;
			echo "success";
		}
		else
		{
			echo "error";
		}

	}
	else
	{
		$condition = " email = '".$_POST['email']."'";
		$user_login = userExists($condition);
		$_SESSION['message']['user_login'] = "succesfuly Login";
		$_SESSION['LoginUserId'] = $user_login['id'];
		echo "success";
	}

}
/* multiple select autocomplete */
if (isset($_GET['term']) && $_GET['term']!="")
{
	$search_query = mysql_real_escape_string(trim($_GET['term']));
	$field = " * ";
	$table = " languages ";
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
		$data[] = array("id"=>"0","label"=>"No record","value"=>"No record");
	}
	echo json_encode($data);
}
$path = "profile_pic/";

$valid_formats = array("jpg", "png", "gif", "bmp");
if(isset($_FILES['photoimg']['name'])&& $_FILES['photoimg']['name']!="" )
{
	$name = $_FILES['photoimg']['name'];
	$size = $_FILES['photoimg']['size'];
		
	if(strlen($name))
	{
		list($txt, $ext) = explode(".", $name);
		if(in_array($ext,$valid_formats))
		{
			if($size<(1024*1024))
			{
				$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
				$tmp = $_FILES['photoimg']['tmp_name'];
				if(move_uploaded_file($tmp, $path.$actual_image_name))
				{
					mysql_query("UPDATE users SET profile_image='".$root."profile_pic/".$actual_image_name."' WHERE id='".$_SESSION['LoginUserId']."'");
						
					echo "<img src='profile_pic/".$actual_image_name."'  alt='user' class='responsiveimg' >";
				}
				else
					echo "failed";
			}
			else
				echo "Image file size max 1 MB";
		}
		else
			echo "Invalid file format..";
	}

	else
		echo "Please select image..!";

	exit;
}
/*user registration*/
if(isset($_POST['action']) && $_POST['action']=="register")
{
	// print_r($_POST);//die;
	$password   = mysql_real_escape_string(trim($_POST['password']));
	$email   = mysql_real_escape_string(trim($_POST['email']));

	$condition 		 = " email = '".$_POST['email']."' ";
	$checkUserExists = UserExists($condition);
	if($checkUserExists['count'] == 0)									//SIGN UP
	{
		$add_user = "Insert into users set password='".$password."' ,email='".$email."' ,created='".$date."',login_type='static' ";
		$mysql_user = mysql_query($add_user);
		if ($mysql_user)
		{
			$id=mysql_insert_id();
			registrationMail($fromMail, $email  ,$password,$root);
			$_SESSION['LoginUserId']=$id;

			echo "success";
		} else
		{
			echo "error";
		}
	}else
	{
		echo "exists";
	}

}
/*login*/
if(isset($_POST['action']) && $_POST['action']=="login")
{//print_r($_POST);die;
	$email      = mysql_real_escape_string(trim($_POST['email_address']));
	$password   = mysql_real_escape_string(trim($_POST['password']));

	$condition = " email='".$email."'   and password = '".$password."' "; //and is_admin='no'
	/* check if email id is alreadye exists or not */
	$checkUserExists = UserExists($condition);
	if($checkUserExists['count'] == 1)									//SIGN UP
	{
		if (isset($_POST['remember_me']) && $_POST['remember_me']=="select")
		{
			setcookie('email', $email, time()+60*60*24*365);
			setcookie('password', $password, time()+60*60*24*365);
			
		} 
		$condition = " email = '".$email."'";
		$user_login = userExists($condition);
		$_SESSION['message']['user_login'] = "succesfuly Login";
		$_SESSION['LoginUserId'] = $user_login['id'];
		echo "success";
	}
	else
	{
		echo "not_found";
	}
}
/*change password*/
if(isset($_POST['action']) && $_POST['action']=="change_password")
{
	$current_pass      = mysql_real_escape_string(trim($_POST['current_pass']));
	$new_pass   = mysql_real_escape_string(trim($_POST['new_pass']));
	$user_id   = trim($_SESSION['LoginUserId']);

	$condition = " id='".$user_id."'   and password = '".$current_pass."' "; //and is_admin='no'
	/* check if email id is alreadye exists or not */
	$checkUserExists = UserExists($condition);
	if($checkUserExists['count'] == 1)									//SIGN UP
	{
		$update_pass = mysql_query("UPDATE users set password='".$new_pass."' WHERE id='".$user_id."' ");
		if($update_pass)
		{
			echo "success";
		}
		else
		{
			echo "error";
		}
	}else
	{
		echo "wrong_pass";
	}
}
/*update personal details*/
if(isset($_POST['action']) && $_POST['action']=="personal_details")
{
	$full_name     	= mysql_real_escape_string(trim($_POST['full_name']));
	$city   		= mysql_real_escape_string(trim($_POST['city']));
	$user_id   		= trim($_SESSION['LoginUserId']);
	$country  		= mysql_real_escape_string(trim($_POST['country']));
	$phone 			= mysql_real_escape_string(trim($_POST['phone']));
	$dob  			= mysql_real_escape_string(trim($_POST['dob']));
	$timezone  		= mysql_real_escape_string(trim($_POST['timezone']));
	$dateofbirth    = date('Y-m-d', strtotime($dob));

	if (isset($_POST['languages']) && $_POST['languages']!="")
	{
		$languages  	= explode(",",mysql_real_escape_string(trim($_POST['languages'])));
		$id_array = array();
		foreach ($languages as $lang)
		{
			if (trim($lang)!="" && trim($lang)!="No record")
			{
				//echo "SELECT id from languages WHERE name='".trim($lang)."' ";
				$get_id = mysql_query("SELECT id from languages WHERE name='".trim($lang)."' ");
				$res = mysql_fetch_assoc($get_id);
				$id_array[]=$res['id'];
			}
		}
		$languages = implode(',',$id_array);
	}else {
		$languages = "";
	}
	$update_pass = "UPDATE users set username='".$full_name."',city='".$city."',country_id='".$country."' ,phone='".$phone."',";
	$update_pass .= " dob='".$dateofbirth."',language_id='".$languages."',timezone_id='".$timezone."' WHERE id='".$user_id."' ";
	$update_query = mysql_query($update_pass);
	if($update_query)
	{
		echo "success";
	}
	else
	{
		echo "error";
	}
}
///////////user logout///////////////////
if(isset($_GET['method']) && $_GET['method']==base64_encode("logout"))
{
	if(isset($_SESSION))
	{
		unset($_SESSION['LoginUserId']);
	}
	$_SESSION['msg'] = "success";
	?>
		<script>
		window.location.href="index.php";
		</script>
	<?php 
}
/*update personal details*/
if(isset($_POST['action']) && $_POST['action']=="update_email")
{
	$email     	= mysql_real_escape_string(trim($_POST['email']));
	$user_id   	= trim($_SESSION['LoginUserId']);
	$condition = " id!='".$user_id."'   and email = '".$email."' "; //and is_admin='no'
	/* check if email id is alreadye exists or not */
	$checkUserExists = UserExists($condition);
	if($checkUserExists['count'] == 0)									//SIGN UP
	{
		$update_pass = "UPDATE users set email='".$email."' WHERE id='".$user_id."' ";
		$update_query = mysql_query($update_pass);
		if($update_query)
		{
			echo "success";
		}
		else
		{
			echo "error";
		}
	}	
	else
	{
		echo "exists";
	}
}
/* apply as expert */
if (isset($_GET['set']) && $_GET['set']==base64_encode("apply_expert"))
{

	require_once 'SDK/OpenTokSDK.php';
    require_once 'SDK/OpenTokArchive.php';
    require_once 'SDK/OpenTokSession.php';
    
    $apiObj = new OpenTokSDK($tokboxApi, $tokboxApiSecret);
    
	$session = $apiObj->createSession();
    $sessionId=$session->getSessionId();
	
	$update_user = "UPDATE users set is_expert='1',tokbox_id='".$sessionId."' WHERE id='".trim(base64_decode($_GET['sid']))."' ";
	$update_query = mysql_query($update_user);
	if($update_query)
	{
		?>
		<script>
		window.location.href="<?php echo $root;?>expert_info.php";
		</script>
	<?php
	}
}
/* disable as expert */
if (isset($_GET['set']) && $_GET['set']==base64_encode("disable_expert"))
{
	$update_user = "UPDATE users set is_expert='0' WHERE id='".trim(base64_decode($_GET['sid']))."' ";
	$update_query = mysql_query($update_user);
	if($update_query)
	{
		?>
		<script>
		window.location.href="<?php echo $root;?>account.php";
		</script>
	<?php
	}
}
/* multiple select autocomplete */
if (isset($_GET['tags']) && $_GET['tags']!="")
{
	$search_query = mysql_real_escape_string(trim($_GET['tags']));
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
		$data[] = array("id"=>"0","label"=>"No record","value"=>"No record");
	}
	echo json_encode($data);
}
/*update personal details*/
if(isset($_POST['action']) && $_POST['action']=="expert_info")
{
	$short_description     	= mysql_real_escape_string(trim($_POST['short_description']));
	$help_offered   		= mysql_real_escape_string(trim($_POST['help_offered']));
	$user_id   				= trim($_SESSION['LoginUserId']);
	$category  				= mysql_real_escape_string(trim($_POST['category']));
	$hourly_rate			= mysql_real_escape_string(trim($_POST['hourly_rate']));
	$profile_url  			= mysql_real_escape_string(trim($_POST['profile_url']));
	//$uname = explode("/",$profile_url);
	//$uname = $uname[1];
	/* check if profile username is alreday exists or not  */
	//echo "SELECT count(id) as num from users WHERE profile_url='".$uname."' AND id!='".$_SESSION['LoginUserId']."' ";
	$check_url=mysql_query("SELECT count(id) as num from users WHERE profile_url='".$profile_url."' AND id!='".$_SESSION['LoginUserId']."' ");
	$rec=mysql_fetch_assoc($check_url);
	if(trim($rec['num'])==0)
	{
		if($hourly_rate=="free")
		{
			$hourly_rate="0";
		}
		if (isset($_POST['tags']) && $_POST['tags']!="")
		{
			$languages  	= explode(",",mysql_real_escape_string(trim($_POST['tags'])));
			$id_array = array();
			foreach ($languages as $lang)
			{
				if (trim($lang)!="" && trim($lang)!="No record")
				{
					//echo "SELECT id from languages WHERE name='".trim($lang)."' ";
					$get_id = mysql_query("SELECT id from tags WHERE name='".trim($lang)."' ");
					$res = mysql_fetch_assoc($get_id);
					$id_array[]=$res['id'];
				}
			}
			$languages = implode(',',$id_array);
		}else {
			$languages = "";
		}
		$update_pass = "UPDATE users set exp_description='".$short_description."',exp_help='".$help_offered."',exp_category_id='".$category."' ,";
		$update_pass .= " exp_tag_id='".$languages."',exp_rate='".$hourly_rate."',profile_url='".$profile_url."' WHERE id='".$user_id."' ";
		$update_query = mysql_query($update_pass);
		if($update_query)
		{
			echo "success";
		}
		else
		{
			echo "error";
		}
	}else {
		echo "purl_exists";
	}
}
/* search experts by name */
if (isset($_GET['expert_name']) && $_GET['expert_name']!="")
{
	$search_query = mysql_real_escape_string(trim($_GET['expert_name']));
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
		$data[] = array("id"=>"0","label"=>"No record","value"=>"No record");
	}
	echo json_encode($data);
}
 