<?php 
	require_once('phpInclude/header.php');
	
	
$session_id = $_GET['id'];
?>
<form id="form_cancel_request">
<input type="button" value="Mind Changed">
<input type="button" value="Confirm" id="cancel_request">
<input type="hidden" name="action" value="submit_cancel_session">
<input type="hidden" name="session_id" value="<?php echo $session_id;?>">
</form>
