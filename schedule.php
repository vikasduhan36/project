<?php 
	require_once('phpInclude/header.php');
	
	$exp_id = $_GET['id'];
?>
<style>
.available{background-color:green;}
</style>
<form id="form_book_schedule">
<input type="hidden" id="exp_id" name="exp_id" value="<?php echo $exp_id;?>">
Duration:
<select name="duration" id="duration">
<option>Select</option>
<?php
for($i=1;$i<=12;$i++)
{
	echo "<option>".($i*10)." min</option>";
}
?>
</select>

Date:
<input type="text" name="date_schedule" id="date_schedule" readonly="readonly"  class="date_schedule" value=""/>

<div id="display_slot">

</div>


title:
<input type="text" name="title" id="title">
description:
<textarea name="description" id="description"></textarea>
question:
<textarea name="question" id="question"></textarea>
other:
<textarea name="other" id="other"></textarea>
<input type="hidden" name="action" value="submit_book_schedule">
<input type="button" name="submit" value="submit" id="book_schedule">
</form>