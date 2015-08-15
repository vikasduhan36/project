var root = "http://localhost/project/";
var current = new Date();
var date = current.getDate();
var month = (current.getMonth()+1);
var year = current.getFullYear();
$(document).ready(function(){

	$('.date_pick').datepicker({
		dateFormat: 'dd-mm-yy',
		minDate: new Date()
		});
		console.log(date+"-"+month+"-"+year);
	$(".date_pick").val(date+"-"+month+"-"+year);
	$('.date_schedule').datepicker({
		dateFormat: 'dd-mm-yy',
		minDate: new Date(),
		onSelect: function(dateText, inst) {
			var date = $(this).val();
			var user_id = $("#exp_id").val();
			getUserAvailability(user_id,date)
		}
		});
	
	$("#submit_add_avail").click(function(){
		var error = 0;
		$.each($(".time_from"),function(key,value){
			
			if($(this).val() >= $(".time_to").eq(key).val())
			{
				alert('To time must be greater then from time');
				error = 1;
			}
			
		});
		
		if(error == 1)
		{
			return false;
		}
		
		var datastring = $('#form_add_avail').serialize();
		$.ajax({
			url:root+'handler.php',
			type:'post',
			data:datastring,
			dataType:'json',
			beforeSend:function(){
				
			},
			success:function(response){
				if(response.status == 'success')
				{
					alert('success');
				}
				else
				{
					alert('error');
				}
			}
		})
	});
	
	
	$('#add_more_avail').click(function(){
		
		$(".availability_outer").append($(".availability").html());
		
		//$('.date_pick:last').removeClass('hasDatepicker date_pick').addClass('dynamic_datepicker');
		//$('.dynamic_datepicker').datepicker({dateFormat: 'dd-mm-yy', minDate: new Date()});
		
		
	});

	
	$("#book_schedule").click(function(){
		
		var error = 0;
		var duration = $('#duration');
		var date_schedule = $('#date_schedule');
		var title = $('#title');
		var description = $('#description');
		var question = $('#question');
		var other = $('#other');
		var slot_selected = $(".slot_selected:checked");
		
		if(duration.val() == '')
		{
			error = 1;
		}
		if(date_schedule.val() == '')
		{
			error = 1;
		}
		if(slot_selected.length == 0)
		{
			error = 1;
		}
		if(title.val() == '')
		{
			error = 1;
		}
		if(description.val() == '')
		{
			error = 1;
		}
		if(question.val() == '')
		{
			error = 1;
		}
		if(other.val() == '')
		{
			error = 1;
		}
		
		if(error == 1)
		{
			return false;
		}
		var datastring = $('#form_book_schedule').serialize();
		$.ajax({
			url:root+'handler.php',
			type:'post',
			data:datastring,
			dataType:'json',
			beforeSend:function(){
				
			},
			success:function(response){
				if(response.status == 'success')
				{
					alert('success');
				}
				else
				{
					alert('error');
				}
			}
		})
	});
	
	$(".request_slot").click(function(){
		
		var datastring = $('#form_accept_session').serialize();
		$.ajax({
			url:root+'handler.php',
			type:'post',
			data:datastring,
			dataType:'json',
			beforeSend:function(){
				
			},
			success:function(response){
				if(response.status == 'success')
				{
					alert('success');
				}
				else
				{
					alert('error');
				}
			}
		})
	});
	
	$("#alternative_dates").click(function(){
		
		$("[name='type']").val('request');
		
	});
	
	$("#alternative_dates_cancel").click(function(){
		
		$("[name='type']").val('accept');
		
	});
	
	$("#cancel_request").click(function(){
	var datastring = $('#form_cancel_request').serialize();
			$.ajax({
			url:root+'handler.php',
			type:'post',
			data:datastring,
			dataType:'json',
			beforeSend:function(){
				
			},
			success:function(response){
				if(response.status == 'success')
				{
					alert('success');
				}
				else
				{
					alert('error');
				}
			}
		})
	});
	
	
	$("#tag_search").keyup(function(){
	var tag = $.trim($(this).val());
	var tag_result = $("#tag_result");
	if(tag == '')
	{
		tag_result.html('');
		return false;
	}
	else if(tag.length < 2)
	{
		tag_result.html('<li>Keep typing ... </li>');
		return false;
	}
	var datastring = "action=tag_search&keyword="+tag;
			$.ajax({
			url:root+'handler.php',
			type:'post',
			data:datastring,
			dataType:'json',
			beforeSend:function(){
				
			},
			success:function(response){
				if(response.status == 'success')
				{
					var html = '';
					$.each(response.result,function(key,value){
						
						html += '<li><a href="javascript:void(0);" class="select_tag" data-id="'+value.id+'" >'+value.name+'</a></li>';
					});
					
					tag_result.html(html);
				}
				else
				{
					tag_result.html('<li>No tags found.</li>');
				}
			}
		})
	});
	
	
	$("#language_search").keyup(function(){
	var language = $.trim($(this).val());
	var language_result = $("#language_result");
	if(language == '')
	{
		language_result.html('');
		return false;
	}
	else if(language.length < 2)
	{
		language_result.html('<li>Keep typing ... </li>');
		return false;
	}
	var datastring = "action=language_search&keyword="+language;
			$.ajax({
			url:root+'handler.php',
			type:'post',
			data:datastring,
			dataType:'json',
			beforeSend:function(){
				
			},
			success:function(response){
				if(response.status == 'success')
				{
					var html = '';
					$.each(response.result,function(key,value){
						
						html += '<li ><a href="javascript:void(0);" class="select_language" data-id="'+value.id+'" >'+value.name+'</a></li>';
					});
					
					language_result.html(html);
				}
				else
				{
					language_result.html('<li>No language found.</li>');
				}
			}
		})
	});
	
	$("body").on("click",".select_tag",function(){
		var value=$(this).attr("data-id");
		$("#tag_selected").append("<input type='hidden' name='tag_selected[]' value='"+value+"'>");
		$("#tag_result").html("");
	});
	
	
	$("body").on("click",".select_language",function(){
		var value=$(this).attr("data-id");
		$("#language_selected").append("<input type='hidden' name='language_selected[]' value='"+value+"'>");
		$("#language_result").html("");
	});
	
	
	$("#book_schedule_public").click(function(){
	var error = 0;
	var category = $("#category");
	var tag = $("[name='tag_selected[]']").length;
	var language = $("[name='language_selected[]']").length;
	var type = $(".select_date:checked").val();
	
	var duration = $('#duration');
	var date_schedule = $('#date_schedule');
	var title = $('#title');
	var description = $('#description');
	var question = $('#question');
	var other = $('#other');
	var slot_selected = $(".slot_selected:checked");
	
	if(category.val() == '')
	{
		error = 1;
	}
	if(tag == 0)
	{
		error = 1;
	}
	if(language == 0)
	{
		error = 1;
	}
	
	if(type == 1)
	{
		if(date_schedule.val() == '')
		{
			error = 1;
		}
		if(slot_selected.length == 0)
		{
			error = 1;
		}
	}
	if(duration.val() == '')
	{
		error = 1;
	}
	
	if(title.val() == '')
	{
		error = 1;
	}
	if(description.val() == '')
	{
		error = 1;
	}
	if(question.val() == '')
	{
		error = 1;
	}
	if(other.val() == '')
	{
		error = 1;
	}
	
	if(error == 1)
	{
		return false;
	}
	
	var datastring = $('#form_book_schedule_public').serialize();
			$.ajax({
			url:root+'handler.php',
			type:'post',
			data:datastring,
			dataType:'json',
			beforeSend:function(){
				
			},
			success:function(response){
				if(response.status == 'success')
				{
					alert('success');
				}
				else
				{
					alert('error');
				}
			}
		})
	});
	
	
});

function getUserAvailability(user_id,date)
{
	var datastring = "action=get_user_avail&user_id="+user_id+"&date="+date;
		$.ajax({
			url:root+'handler.php',
			type:'post',
			data:datastring,
			dataType:'json',
			beforeSend:function(){
				
			},
			success:function(response){
				var html = '';
				var avail_class = '';
				$.each(response.all,function(key,value){
					if($.inArray(value,response.available) != '-1')
					{
						avail_class = "available"
					}
					else
					{
						avail_class = '';
					}
					html += "<div class='"+avail_class+"'><input type='checkbox' name='slot_selected[]' class='slot_selected' value='"+value+"'>"+value+"</div>"
				});
				
				$('#display_slot').html(html);
			}
		})
}
