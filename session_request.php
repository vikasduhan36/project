<?php 
	require_once('phpInclude/header.php');

$session_id = $_GET['id'];
$field = " *, (select GROUP_CONCAT(datetime) FROM session_time WHERE session_time.session_id=sessions.id) as time_request ";
$table = "sessions";
$condition 	= "and id='".$session_id."' ";
$session_detail = getDetail($field,$table,$condition);
$userTimezone = getUserTimezone($_SESSION['user_id']);
?>
<form id="form_accept_session">
<?php
echo "<h3>".$session_detail[0]['title']."</h3>";
echo "<h4>".$session_detail[0]['description']."</h4>";


$time_request = explode(",",$session_detail[0]['time_request']);
echo "<h3>requested time</h3>";
foreach($time_request as $request_val)
{
	$request = convertTimezone($request_val, $default_tz, $userTimezone['timezone']);
	echo "<div>".$request."</div>";
}
if($session_detail[0]['status'] == '0')
{
	?>
		<input type='button' name='cancel_session' value='Canceleled'>
	<?php
}
else if($session_detail[0]['type'] == 'schedule' && $session_detail[0]['exp_applied_id'] == $_SESSION['user_id'])
{
	if($session_detail[0]['status'] == '2')
	{
		?>
		<input type='button'  value='Scheduled'>
		<?php
	}
	else if($session_detail[0]['exp_reschedule'] == '1')
	{
		?>
		<input type='button'  value='Waiting for reply'>
		<?php
	}
	else if($session_detail[0]['exp_reschedule'] == '0' )
	{
		?>
		<a href="<?php echo $root.'session_accept.php?id='.$session_id;?>">
			<input type='button'  value='Accept'>
		</a>
		<?php
	}
}
else if($session_detail[0]['type'] == 'schedule' && $session_detail[0]['user_id'] == $_SESSION['user_id'])
{
	if($session_detail[0]['status'] == '2')
	{
		?>
		<input type='button'  value='Scheduled'>
		<?php
	}
	else if($session_detail[0]['exp_reschedule'] == '0')
	{
		?>
		<input type='button'  value='Waiting for reply'>
		<?php
	}
	else if($session_detail[0]['exp_reschedule'] == '1')
	{
		?>
		<a href="<?php echo $root.'session_accept.php?id='.$session_id;?>">
			<input type='button'  value='Accept Reschedule'>
		</a>	
		<?php
	}
}

if($session_detail[0]['status'] == '1')
{
	?>
	<a href="<?php echo $root.'session_cancel.php?id='.$session_id;?>">
		<input type='button' name='cancel_session' value='Cancel'>
	</a>
	<?php
}
?>
</form>
