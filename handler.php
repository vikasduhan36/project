<?php
require_once 'config/dbconnection.php';
db_open();
require_once('phpInclude/function.php');
//require_once 'phpInclude/functions.php';

$user_id = $_SESSION['user_id'];

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
	
	
	foreach($date_avail as $key_val => $date_val)
	{

		$from_dtime = date("Y-m-d H:i:s",strtotime((string)$date_val." ".(string)$timefrom[$key_val]));
		$to_dtime = date("Y-m-d H:i:s",strtotime((string)$date_val." ".(string)$timeto[$key_val]));
		
		$from = convertTimezone($from_dtime, $userTimezone['timezone'],$default_tz);
		$to = convertTimezone($to_dtime, $userTimezone['timezone'],$default_tz);
		
		//$default_tz
		$sql = " INSERT INTO user_availability SET user_id='".$user_id."', `from`='".$from."', `to`='".$to."',created='".$date."' ";
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
	$user_id = $_POST['user_id'];
	$date_selected = $_POST['date'];
	$field = "`from`,`to`";
	$table = "user_availability";
	$condition = "and user_id = '".$user_id."' ";
	$get_avail = getDetail($field,$table,$condition);
	
	$default_availability = default_availability();
	$available = array();

	$userTimezone = getUserTimezone($user_id);
	$all = array();
	foreach($get_avail as  $datetime)
	{
		$from_dtime = $datetime['from'];
		$to_dtime = $datetime['to'];

		$from = convertTimezone($from_dtime,$default_tz,$userTimezone['timezone']);
		$to = convertTimezone($to_dtime,$default_tz,$userTimezone['timezone']);

		foreach($default_availability as $time_val)
		{
			$time = $date_selected." ".$time_val;
			if( (strtotime($time) >= strtotime($from)) && (strtotime($time) < strtotime($to)) )
			{
				$available[] = date("Y-m-d H:i:s",strtotime($time));
			}
		}
	}
	
	foreach($default_availability as $time_val)
	{
		$time = $date_selected." ".$time_val;
		$all[] = date("Y-m-d H:i:s",strtotime($time));
	}
		
	echo json_encode(array('all'=>array_unique($all),'available'=>array_unique($available)));
}
else if(isset($_POST['action']) && $_POST['action'] == 'submit_book_schedule')
{
	$error = array();
	foreach($_POST as $key => $value)
	{
		$$key = $value;
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
	if($type == 'accept')
	{
		$sql= " UPDATE sessions SET session_datetime='".$slot."',exp_reschedule='0',user_reschedule='0', status='2' WHERE id='".$session_id."' ";
		$query = mysql_query($sql);
	}
	else if($type == 'request')
	{
		$field = "is_expert";
		$table = "users";
		$condition = "and id = '".$user_id."' ";
		$get_avail = getDetail($field,$table,$condition);
		
		$userTimezone = getUserTimezone($user_id);
		
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
			}
		}
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
else if(isset($_POST['action']) && $_POST['action'] == 'submit_cancel_session')
{
	$session_id = $_POST['session_id'];
	$sql = " UPDATE sessions SET status='0' WHERE id='".$session_id."' ";
	$query = mysql_query($sql);
	if($query)
	{
		echo "success";exit();
	}
	else
	{
		echo "error";exit();
	}
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

	$error = array();
	foreach($_POST as $key => $value)
	{
		$$key = $value;
	}
	$userTimezone = getUserTimezone($user_id);
	//exp_id
	
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
		echo "error";exit();
	}
	else
	{
		echo "success";exit();
	}
	
	

}
