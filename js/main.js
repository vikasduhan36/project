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