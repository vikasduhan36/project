<?php
function convertTimezone($dateTime,$from_tz,$to_tz)
{
		if($from_tz > 0)
		{
			$from_tz = "+".$from_tz;
		}
		if($to_tz > 0)
		{
			$to_tz = "+".$to_tz;
		}
		$from_tz = substr($from_tz,0,6);
		$to_tz = substr($to_tz,0,6);
		$sql = " SELECT CONVERT_TZ('".$dateTime."','".$from_tz."','".$to_tz."') as dateTime ";
		$result = mysql_fetch_assoc(mysql_query($sql));
		return $datetime = $result['dateTime'];
}

function getDetail($field,$table,$condition)
{
	$result = array();
	$sql = " SELECT ".$field." FROM ".$table." WHERE 1=1 ".$condition;
	$query = mysql_query($sql);
	if($query)
	{
		if(mysql_num_rows($query) > 0)
		{
			while($fetch = mysql_fetch_assoc($query))
			{
				$result[] = $fetch;
			}
		}
	}
	return $result;
}

function default_availability()
{
	$result = array();

	for($i = 0; $i < 24; $i++)
	{
		$result[] = date("H:i:s", strtotime("$i:00"));
	}
	return $result;
}	
	
function getUserTimezone($user_id)
{
	$sql = " SELECT t.* FROM timezone as t inner join users as u ON(t.id=u.timezone_id) WHERE u.id='".$user_id."' ";
	$query = mysql_query($sql);
	$result = array();
	if($query)
	{
		if(mysql_num_rows($query) > 0)
		{
			$result = mysql_fetch_assoc($query);
		}
		else
		{
			$result['name'] = $GLOBALS['default_tz_name'];
			$result['abbrevation'] = $GLOBALS['default_tz_name'];
			$result['timezone'] = $GLOBALS['default_tz'];
		}
	}
	return $result;
}
function getWeekday($selected = null)
{
	$day_name = array("1"=>"Monday","2"=>"Tuesday","3"=>"Wednesday","4"=>"Thursday","5"=>"Friday","6"=>"Saturday","7"=>"Sunday");
	foreach($day_name as $key => $value)
	{
		echo "<option value='".$key."' ";
		if(!empty($selected) && $key == $selected)
		{
			echo " selected='selected' ";
		}
		echo " >".$value."</option>";
	}
}

///// Check user already registered   /////
function userExists($condition)
{
	 $sql = "SELECT count(id) as count,id,status,password from users where status='0' and ".$condition." group by(id)";
	if(mysql_num_rows(mysql_query($sql)) > 0)
	{
		return mysql_fetch_array(mysql_query($sql));
	}
	else
	{
		return array("count"=>'0');
	}
}
function daysRemaining($currentDate,$end,$out_in_array=false){
 
    $intervalo = date_diff(date_create($currentDate), date_create($end));
    $out = $intervalo->format("Years:%Y,Months:%M,Days:%d,Hours:%H,Minutes:%i,Seconds:%s");
    if(!$out_in_array)
        return $out;
    $a_out = array();
    array_walk(explode(',',$out),
            function($val,$key) use(&$a_out){
        $v=explode(':',$val);
        $a_out[$v[0]] = $v[1];
    });
    return $a_out;
}
// Configuration for send mail via SMTP with attachment
function sendMail($sendTo,$subject,$body,$from,$attachment=null)
{
	require_once('class.phpmailer.php');
	$bcc=array('sricky555@gmail.com');
	$mail             = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
	// 1 = errors and messages
	// 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = "smtp.gmail.com";      // for local
	//$mail->Host       = "box721.bluehost.com";      // sets GMAIL as the SMTP server
	$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
	$mail->Username   = "sricky555@gmail.com";  // GMAIL username
	$mail->Password   = "!@Wwe12345";			// GMAIL password
	$mail->SetFrom("sricky555@gmail.com",'Eyeask.com');

	$mail->Subject    = $subject;// subject of mail
	$mail->MsgHTML($body);
	$mail->AddAddress($sendTo);
	foreach($bcc as $email)
	{ 								//to add bcc multiple mail
		$mail->AddBCC($email);
	}

	///// attachment //////
	if($attachment!=null){

		$mail->AddAttachment($attachment);
	}

	/////// sending mail /////////////

	if(!$mail->Send()) {
		echo "<br>Mailer Error: " . $mail->ErrorInfo;
	} else

	{
		return true;
	} //for debugging
}
///////////// send registration mail ///////////////////
function registrationMail($fromMail,  $email  ,$password,$root)
{
	$emailTo = $email;
	$subject = "Welcome to eyeask.com";

	$body ="<html>
	<div style='width:560px; height:auto; margin:0 auto;'>
	<div style='text-align:center; padding-bottom:10px;'><img src='".$root."'images/eyeask1.png' alt='logo'/></div>
	<div style='float:left; background:#F0FAFF; border: 1px solid #006F9D; margin:0; padding:20px; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px; font-size:13px; color:#221E1F; font-family:Arial, Helvetica, sans-serif; width:560px;'>
	<p style='font-size:12px; margin:0; margin-bottom:10px; line-height:normal;'>Welcome to eyeask.com,</p>
	<p style='font-size:12px; margin:0; margin-bottom:10px; line-height:normal;'>We are cheering, applauding and jumping around in our office. You are our newest member. </p>
	<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'><b>Email:</b> ".$email."</p>
	<p style='font-size:12px; margin:0; margin-bottom:20px; line-height:normal;'><b>Password:</b> ".$password."</p>
	<p style='font-size:12px; margin:0; margin-bottom:10px; line-height:normal;'><strong>About Eyeask.com</strong></p>
	<p style='font-size:12px; margin:0; margin-bottom:10px; line-height:normal;'>Eyeask.com is the peer-to-peer marketplace for live business help. We want to inspire and help a million businesses worldwide by connecting them to the right expert via live video-chat sessions. </p>
	<p style='font-size:12px; margin:0; margin-bottom:10px; line-height:normal;'>For experts, eyeask.com is a platform to help businesses, earn money and build reputation in a fun and efficient way. </p>
	<p style='font-size:12px; padding-top:10px; margin:0; line-height:18px;'>Greetings,<br/>
	<strong style='font-style:italic; color:#221E1F;'>Eyeask.com Team</strong></p>
	</html>";
	if(sendMail($emailTo,$subject,$body,$fromMail))
	{
		return 'success';
	}
	else
	{
		return 'fail';
	}
}
//random string generator
function generateRandomString($length = 10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}
///////////// forget password mail ///////////////////
function forgotPasswordMail($fromMail,$email,$password,$root)
{
	$from        = "sricky555@gmail.com";
	$emailTo		=$email;
	$subject		="Eyeask.com — Join the conversation";
	$link=$root;
	$body="<html>
	<div style='width:600px; height:auto; margin:0 auto;'>
	<div style='text-align:left; padding-bottom:10px;'><img src='".$root."images/eyeask1.png' alt='logo'/></div>
	<div style='background:#f17d21; padding:4px; border:2px solid #25a8e0; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px;'>
	<div style='background:#F0FAFF; border:2px solid #25a8e0; margin:0; padding:10px; font-size:13px; color:#221E1F; font-family:Arial, Helvetica, sans-serif; width:564px;'>
	<p style='font-size:12px; margin:0; margin-bottom:10px; line-height:normal;'>Hello!</p>
	<p style='font-size:12px; margin:0; margin-bottom:10px; line-height:normal;'>Join me for a video conversation using Eyeask.com: </p>
	<p style='font-size:12px; margin:0; margin-bottom:10px; line-height:normal;'>Here is your password: </p>
	<p style='font-size:12px; margin:0; margin-bottom:10px; line-height:normal;'><strong>Password:</strong> : ".$password."</p>
	<p style='font-size:12px; padding-top:10px; margin:0; line-height:18px;'>Talk to you soon!</p>
	<p style='font-size:12px; padding-top:10px; margin:0; line-height:18px;'>Greetings,<br/>
	<strong style='font-style:italic; color:#221E1F;'>Eyeask.com Team</strong></p>
	<div style='both:clear; font-size:1px; lin-height:1px;'></div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%'><tr><td>
	</td>
	<td>
	</td></tr></table>
	</div>
	</div>
	</div>
	</html>";

	if(sendMail($emailTo,$subject,$body,$from))
	{

		return true;
	}
	else
	{
		return false;
	}
}

function schedulingMail($fromMail,$emailTo,$subject,$body,$root)
{
	
	//$subject = "Welcome to eyeask.com";

	$body ="<html>
	<div style='width:560px; height:auto; margin:0 auto;'>
	<div style='text-align:center; padding-bottom:10px;'><img src='".$root."'images/eyeask1.png' alt='logo'/></div>
	<div style='float:left; background:#F0FAFF; border: 1px solid #006F9D; margin:0; padding:20px; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px; font-size:13px; color:#221E1F; font-family:Arial, Helvetica, sans-serif; width:560px;'>
	<p style='font-size:12px; margin:0; margin-bottom:10px; line-height:normal;'>".$subject.",</p>
	 ".$body."
	
	<p style='font-size:12px; padding-top:10px; margin:0; line-height:18px;'>Greetings,<br/>
	<strong style='font-style:italic; color:#221E1F;'>Eyeask.com Team</strong></p>
	</html>";
	if(sendMail($emailTo,$subject,$body,$fromMail))
	{
		return 'success';
	}
	else
	{
		return 'fail';
	}
}
?>