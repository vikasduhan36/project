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
			$("#hidden_date_schedule").val(date);
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

	$("#validate_step1").click(function(){
	
		var message = '';
		var error = 0;
		var duration = $('#duration');
		var date_schedule = $('#hidden_date_schedule');
		var slot_selected = $(".slot_selected:checked");
		
		if(duration.val() == '')
		{
			message = "Please select session duration.";
			error = 1;
			//duration.focus();
		}
		else if(date_schedule.val() == '')
		{
			message = "Please select session date.";
			error = 1;
			$("#date_schedule").focus();
		}
		else if(slot_selected.length == 0)
		{
			message = "Please select session time.";
			error = 1;
			//slot_selected.focus();
		}
		if(error == 1)
		{
			$("#notification").addClass("error").removeClass("success").text(message).show();
			//window.scroll(0,0);
			$('html, body').animate({
				scrollTop: $("#notification").offset().top
			}, 800);
		}
		else
		{
			$("#notification").removeClass("error success").text('').hide();
			$(".progresslist li:eq(0)").addClass("stepcomp");
			
		}
	});
	
	$("#validate_step2").click(function(){
	
		var message = '';
		var error = 0;
		var title = $('#title');
		var description = $('#description');
		var question = $('#question');
		var other = $('#other');
		
		if(title.val() == '')
		{
			message = "Please enter session title.";
			//title.focus();
			error = 1;
		}
		else if(description.val() == '')
		{
			message = "Please enter session description.";
			//description.focus();
			error = 1;
		}
		else if(question.val() == '')
		{
			message = "Please enter session question.";
			//question.focus();
			error = 1;
		}
		
		
	
	if(error == 1)
		{
			$("#notification").addClass("error").removeClass("success").text(message).show();
			//window.scroll(0,0);
				$('html, body').animate({
				scrollTop: $("#notification").offset().top
			}, 800);
		}
		else
		{
			$("#notification").removeClass("error success").text('').hide();
			$(".progresslist li:eq(1)").addClass("stepcomp");
			var datetime_html = '';
			$.each($(".slot_selected:checked"),function(){
				
				datetime_html += '<li>'+$(this).val()+'<li>';
				
			});
			
			$("#display_title").text(title.val());
			$("#display_description").text(description.val());
			$("#display_question").text(question.val());
			$("#display_datetime").html(datetime_html);
			
			$("#step2").fadeOut(function(){$("#step3").fadeIn()});
			
		}
	});
	
	$("#edit_step1").click(function(){
		$("#step3").fadeOut(function(){$("#step1").fadeIn()});
	});
	
	$("#edit_step2").click(function(){
		$("#step3").fadeOut(function(){$("#step2").fadeIn()});
	});
	
	
	$("#book_schedule").click(function(){
		
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
					window.location.href = root+'schedule_confirmed.php?id='+response.id;
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
				var html = '<ul class="timelist" >';
				var avail_class = '';
				var i=0;
				
				$.each(response.all,function(key,value){
					if($.inArray(value,response.available) != '-1')
					{
						avail_class = "available"
					}
					else
					{
						avail_class = '';
					}
					//console.log(i+' | '+i%6);
					if(i%6 == 0 && i > 0)
					{
						html += '</ul><ul class="timelist" >';
					}
					//html += "<div class='"+avail_class+"'><input type='checkbox' name='slot_selected[]' class='slot_selected' value='"+value+"'>"+value+"</div>"
					html += '<li><input type="checkbox" id="t'+i+'"  name="slot_selected[]" class="slot_selected" value="'+value+'"/>';
                    html += '<label class="checkbox '+avail_class+'" for="t'+i+'">';
					html += '<img src="images/check.png" alt="check" />'+formatAMPM(value)+'</label></li>';
					i++;
				});
				html += "</ul>";
				$('#display_slot').fadeOut(function(){$(this).html(html).fadeIn()});
			}
		})
}

function formatAMPM(date) {
	var date = new Date(date);
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return strTime;
}