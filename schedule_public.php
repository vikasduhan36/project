<?php 
	require_once('phpInclude/header.php');

$field = "*";
$table = "categories";
$condition 	= "and status='1' ";
$categories = getDetail($field,$table,$condition);
	
?>
<style>
.available{background-color:green;}
</style>
<form id="form_book_schedule_public">

Category:
<select name="category_id" id="category">
<option value=''>Select</option>
<?php
foreach($categories as $category)
{
	echo "<option value='".$category['id']."'>".$category['name']."</option>";
}
?>
</select>

<br>
Tags:
<input type="text" name="tag_search" id="tag_search">
<ul id="tag_result">
</ul>
<br>
Languages:
<input type="text" name="language_search" id="language_search">
<ul id="language_result">
</ul>
<br>
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

Session date:
<br>
<input type="radio" class="select_date" value="1" name="select_date">
Yes, please let me select possible dates
<br>
<input type="radio" class="select_date" value="0" name="select_date">
No, let experts propose a date for this session
<br>

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
<input type="hidden" name="action" value="submit_book_schedule_public">
<br>
<input type="button" name="submit" value="submit" id="book_schedule_public">
<div id="tag_selected">
</div>
<div id="language_selected">
</div>
</form>