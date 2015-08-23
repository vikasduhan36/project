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
	$tab = "schedule";
	if($type == 'accept')
	{
		$sql= " UPDATE sessions SET session_datetime='".$slot."',exp_reschedule='0',user_reschedule='0', status='2' WHERE id='".$session_id."' ";
		$query = mysql_query($sql);
	}
	else if($type == 'request')
	{
	$tab = "open";
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
	$condition = "";
	$result = array();
	$status = "error";
	$count = 0;
	
	if(!empty($category_id))
	{
		$condition .= " and u.exp_category_id = '".$category_id."' ";
	}
	
	if(!empty($tag_selected))
	{
		$condition .= " and ( 1=1 ";
		foreach($tag_selected as $id)
		{
			$condition .= " OR FIND_IN_SET('u.exp_tag_id','".$id."') ";
		}
		$condition .= " ) ";
	}
	
	if(!empty($language_selected))
	{
		$condition .= " and ( 1=1 ";
		foreach($language_selected as $id)
		{
			$condition .= " OR FIND_IN_SET('u.language_id','".$id."') ";
		}
		$condition .= " ) ";
	}
	
	$sql  = " SELECT SQL_CALC_FOUND_ROWS u.id, u.fname,u.lname, u.profile_image, u.city,u.country_id,u.exp_about,exp_rate, ";
	$sql .= " ( SELECT name FROM categories WHERE id = u.exp_category_id) as category, "; 
	$sql .= " ( SELECT GROUP_CONCAT(name) FROM languages WHERE id IN(u.language_id)) as language, "; 
	$sql .= " ( SELECT GROUP_CONCAT(name) FROM tags WHERE id IN(u.exp_tag_id)) as tag "; 
	$sql .= " FROM users as u ";
	$sql .= " WHERE 1=1 and is_expert='1' ".$condition." ";
	
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
				$result[] = $fetch;
			}
		}
		else
		{
			$status = "no_record";
		}
	}
	
	echo json_encode( array('status'=>$status,'count'=>$count,'result'=>$result) );
}

if(isset($_POST['action']) && $_POST['action']=="googleLogin")
{
	//print_r($_POST);die;
	$login_type="google";
	$condition 		 = " email = '".$_POST['email']."' ";
	$checkUserExists = UserExists($condition);
	if($checkUserExists['count'] == 0)									//SIGN UP
	{
		$fb_login ="Insert into users set login_type='".mysql_real_escape_string(strip_tags(trim($login_type)))."'  ,username='".mysql_real_escape_string(strip_tags(trim($_POST['name'])))."' ,profile_image='".mysql_real_escape_string(strip_tags(trim($_POST['image'])))."' , ";
		$fb_login .="email='".mysql_real_escape_string(strip_tags(trim($_POST['email'])))."',gender='".mysql_real_escape_string(strip_tags(trim($_POST['gender'])))."' ,fname='".mysql_real_escape_string(strip_tags(trim($_POST['fname'])))."' ,lname='".mysql_real_escape_string(strip_tags(trim($_POST['lname'])))."' ";
		$mysql=mysql_query($fb_login) or die(mysql_error());
		if($mysql)
		{
			$id=mysql_insert_id();
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
		lastVisit($user_login['id']);
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
			$_SESSION['LoginUserId']=mysql_insert_id();

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
	$user_id   = trim($_SESSION['db_session_id']);

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
