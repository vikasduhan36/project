var root = "http://localhost/project/";
var current = new Date();
var date = current.getDate();
var month = (current.getMonth()+1);
var year = current.getFullYear();
$(document).ready(function(){

	$("#add_partner_category").click(function(){
	
		var html = '<div style="margin-top:10px;"><div class="col-xs-4"><select class="partner_category form-control" name="partner_category[]">'+$('#default_cat').html()+'</select></div>';
		html 	+= '<div class="col-xs-7"><input type="text" class="partner_link form-control" name="partner_link[]" placeholder="website_link"></div>';
		html 	+= '<div class="col-xs-1"><a href="javacsript:void(0);" title="Click to remove" class="remove_website">X</a></div></div>';
		$('#partner_html').append(html);
	});

	$("#submit_website").click(function(){
		
		var i = 0;
		var error = 0;
		$.each($(".partner_category"),function(){
			
			if($(".partner_category").eq(i).val() == '')
			{
				$(".partner_category").eq(i).focus();
				error = 1;
				return false;
			}
			if($(".partner_link").eq(i).val() == '')
			{
				$(".partner_link").eq(i).focus();
				error = 1;
				return false;
			}
			i++;
		});
		
		if(i>0 && error == 0)
		{
			var datastring = $('#partner_html').serialize();
			$.ajax({
				url:root+'handler.php',
				type:'post',
				data:datastring,
				beforeSend:function(){
				},
				success:function(response){
					window.location.reload();
				}
			});
		}
	});
	
	
	
		$("body").on("click",".remove_website",function(){
	
		var r = confirm("Are you sure you want to remove this site link.");
		if(r)
		{
		$(this).parents().eq(1).slideUp(function(){$(this).remove();});
		}
		
		});
	$(".delete_website").click(function(){
	
		var r = confirm("Are you sure you want to delete this site link.");
		if(r)
		{
		var $this = $(this);
		var id = $this.attr('alt');
			$.ajax({
				url:root+'handler.php',
				type:'post',
				data:{'action':'delete_website','id':id},
				beforeSend:function(){
				},
				success:function(response){
					$this.parents().eq(1).slideUp(function(){$(this).remove();});
				}
			});
		
		}
	
	});
	
   $('#photoimg').on('change', function()			{ 
			           $("#preview").html('');
			    $("#preview").html('<img src="images/loader.gif" alt="Uploading...."/>');
			$("#imageform").ajaxForm({
						target: '#preview'
		}).submit();
		
			});
			
	$('.date_pick').datepicker({
		
		});
		
	$( ".date_pick_icon" ).datepicker({
		  showOn: "button",
		  buttonImage: "images/calendar.gif",
		  buttonImageOnly: true,
		  buttonText: "Select date",
		  dateFormat: 'dd-mm-yy',
		minDate: new Date()
	});
		
	$(".date_pick,.date_pick_icon").not('.pre_select').val(date+"-"+month+"-"+year);
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
		var message = '';
		$.each($(".time_from"),function(key,value){
			
			if($(this).val() >= $(".time_to").eq(key).val())
			{
				message = 'Time to must be greater then time from';
				error = 1;
			}
			
		});
		
		if(error == 1)
		{
			$("#notification").addClass("error").removeClass("success").text(message).show();
			
			$('html, body').animate({
					scrollTop: $("#notification").offset().top
			}, 800);
				
			return false;
		}
		
		var datastring = $('#form_add_avail').serialize();
		$.ajax({
			url:root+'handler.php',
			type:'post',
			data:datastring,
			//dataType:'json',
			beforeSend:function(){
				
			},
			success:function(response){
				
				if(response == 'success')
				{
					$("#notification").addClass("success").removeClass("error").text('You availability has been updated successfully.').show();
				}
				else
				{
					$("#notification").addClass("error").removeClass("success").text('Something went wrong. Please try again later.').show();
				}
				$('html, body').animate({
					scrollTop: $("#notification").offset().top
				}, 800);
			}
		})
	});
	
	
	$('#add_more_avail').click(function(){

		var html = '<div class="row availability_inner">';
			html += '<div class="col-xs-12 col-md-4">'
			html += '<label class="lbl">Choose Date</label>';
			html += '<input type="text" name="date_avail[]" class="date_pick_icon form-control" readonly="readonly"/>';
			html += '<div id="date_schedule"  class="date_schedule"></div>';
			html += '</div>';
			html += '<div class="col-xs-12 col-md-3">';
			html += '<label class="lbl">Time from</label>';

			html += '<select name="timefrom[]" class="time_from form-control">';
			html += $('.time_from:first').html();
			html += '</select>';
			
			html += '</div><div class="col-xs-12 col-md-3"><label class="lbl">Time to</label>';
			html += '<select name="timeto[]" class="time_to form-control">';
			html += $('.time_to:first').html();
			html += '</select></div>';
			
			html += '<div class="col-xs-12 col-md-2"><label class="lbl">';
			html += '<a href="javascript:void(0);" class="remove_availability" title="Remove availability">';
			html += 'X</a></label></div>';
			
			html += '</div>';

		$(".availability_outer").append(html);
		
		
		//$('.date_pick:last').datepicker();
		$( ".date_pick_icon:last" ).datepicker({
			  showOn: "button",
			  buttonImage: "images/calendar.gif",
			  buttonImageOnly: true,
			  buttonText: "Select date",
			  dateFormat: 'dd-mm-yy',
				minDate: new Date()
		});
		$(".date_pick_icon:last").val(date+"-"+month+"-"+year);
		$(".time_from:last").val('09:00:00');
		$(".time_to:last").val('17:00:00');
	});

	$('body').on('click','.remove_availability',function(){
		var r = confirm('Are you sure you want to remove this availability?');
		if(!r)
		{
			return false;
		}
		$(this).parents().eq(2).slideUp(function(){$(this).remove();});
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
		console.log(error);
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
			$(".progresslist li:eq(0)").addClass("stepcomp").find(".count").html('<i class="fa fa-check"></i>');
		
			$("#step1").fadeOut(function(){$("#step2").fadeIn()});
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
			$(".progresslist li:eq(1)").addClass("stepcomp").find(".count").html('<i class="fa fa-check"></i>');
			var datetime_html = '';
			$.each($(".slot_selected:checked"),function(){
				if($.trim($(this).val()) != '')
				{
					datetime_html += '<li>'+$(this).val()+'</li>';
				}
				
			});
			console.log(datetime_html);
			if(datetime_html == '')
			{
				datetime_html = '<li>Experts will propose possible dates for this session.</li>';
			}
			
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
		
		if($("[name='action']").val() == 'submit_book_schedule' )
		{
		var datastring = $('#form_book_schedule').serialize();
		}
		else if($("[name='action']").val() == 'submit_book_schedule_public' )
		{
		var datastring = $('#form_book_schedule_public').serialize();
		}
		
		
		$.ajax({
			url:root+'handler.php',
			type:'post',
			data:datastring,
			dataType:'json',
			beforeSend:function(){
				$('#loader').show();
			},
			success:function(response){
				$('#loader').hide();
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
		
		var error = 0;
		var message = "";
		$("#notification").hide();
		if($(this).attr("id") == "request_schedule")
		{
			if($("#hidden_date_schedule").val() == '')
			{
				message = "Please select the session date.";
				error = 1;
			}
			else if($("[name='slot_selected[]']:checked").length == 0)
			{
				message = "Please select the session time.";
				error = 1;
			}
		}
		else
		{
			if($(this).hasClass('public') && !$(this).hasClass('exp_hired'))
			{
				if($("[name='slot[]']:checked").length == 0)
				{
					message = "Please select the session time.";
					error = 1;
				}
			}
			else
			{
				if($("[name='slot']:checked").length == 0)
				{
					message = "Please select the session time.";
					error = 1;
				}
			}
			
		}
		
		if(error == 1)
		{
			$("#notification").addClass("error").removeClass("success").text(message).show();
				$('html, body').animate({
					scrollTop: $("#notification").offset().top
				}, 800);
				return false;
		}
		if($(this).hasClass('public'))
		{
			var datastring = $('#form_accept_public').serialize();
		}
		else
		{
			var datastring = $('#form_accept_session').serialize();
		}
		
		$.ajax({
			url:root+'handler.php',
			type:'post',
			data:datastring,
			dataType:'json',
			beforeSend:function(){
				$('#loader').show();
			},
			success:function(response){
				$('#loader').hide();
				if(response.status == 'success')
				{
					if(response.is_expert == '1')
					{
						var url = 'exp_sessions.php';
					}
					else
					{
						var url = 'user_sessions.php';
					}
					
					window.location.href = root+url+"?tab="+response.tab;
				}
				else
				{
					alert('error');
				}
			}
		})
	});
	
	$("#cancel_session").click(function(){

	var r = confirm("Are you sure you want to cancel this session.");
	if(!r)
	{
		return false;
	}
		var datastring = {'action':'submit_cancel_session','id':$(this).attr('alt')};
		$.ajax({
			url:root+'handler.php',
			type:'post',
			data:datastring,
			dataType:'json',
			beforeSend:function(){
				$('#loader').show();
			},
			success:function(response){
				$('#loader').hide();
				if(response.status == 'success')
				{
					if(response.is_expert == '1')
					{
						window.location.href = root+'exp_sessions.php?tab=close';
					}
					else
					{
						window.location.href = root+'user_sessions.php?tab=close';
					}
					
				}
				else
				{
					alert('error');
				}
			}
		})
	
	
	});
	
	$("#validate_public_step1").click(function(){
	
		var message = '';
		var error = 0;
		var duration = $('#duration');
		var date_schedule = $('#hidden_date_schedule');
		var slot_selected = $(".slot_selected:checked");
		
		var category = $("#category");
		var tag = $("[name='tag_selected[]']").length;
		var language = $("[name='language_selected[]']").length;
	
	
		if(category.val() == '')
		{
			message = "Please select category.";
			error = 1;
		}
		else if(tag == 0)
		{
			message = "Please select tag.";
			error = 1;
		}
		else if(language == 0)
		{
			message = "Please select language.";
			error = 1;
		}
		else if(duration.val() == '')
		{
			message = "Please select session duration.";
			error = 1;
			//duration.focus();
		}
		else if($(".is_date_selected:checked").length == 0)
		{
			message = "Please select a method to schedule session date.";
			error = 1;
		}
		else if($(".is_date_selected:checked").val() == "1")
		{
			if(date_schedule.val() == '')
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
		}
		console.log(error);
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
			$(".progresslist li:eq(0)").addClass("stepcomp").find(".count").html('<i class="fa fa-check"></i>');
			$("#step1").fadeOut(function(){$("#step2").fadeIn()});
		}
	});
	
	$("#alternative_dates").click(function(){
		
		$("[name='type']").val('request');
		$("#public_select_date").slideDown();
		
	});
	
	$("#alternative_dates_cancel").click(function(){
		
		$("[name='type']").val('accept');
		$("#public_select_date").slideUp();
		
	});
	
	$("#cancel_request").click(function(){
	var datastring = $('#form_cancel_request').serialize();
			$.ajax({
			url:root+'handler.php',
			type:'post',
			data:datastring,
			dataType:'json',
			beforeSend:function(){
				$('#loader').show();
			},
			success:function(response){
				$('#loader').hide();
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
	var session_public=''
	if($(this).hasClass('session_public'))
	{
		session_public = 'session_public';
	}
	var tag = $.trim($(this).val());
	var tag_result = $("#tag_result");
	if(tag == '')
	{
		tag_result.html('');
		return false;
	}
	else if(tag.length < 2)
	{
		tag_result.html('<li><a href="javascript:void(0);">Keep typing ...</a></li>');
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
						
						html += '<li><a href="javascript:void(0);" class="select_tag '+session_public+'" data-id="'+value.id+'" >'+value.name+'</a></li>';
					});
					
					tag_result.html(html);
				}
				else
				{
					tag_result.html('<li><a href="javascript:void(0);">No tags found.</a></li>');
				}
			}
		})
	});
	
	
	$("#language_search").keyup(function(){
	var session_public=''
	if($(this).hasClass('session_public'))
	{
		session_public = 'session_public';
	}
	var language = $.trim($(this).val());
	var language_result = $("#language_result");
	if(language == '')
	{
		language_result.html('');
		return false;
	}
	else if(language.length < 2)
	{
		language_result.html('<li><a href="javascript:void(0);">Keep typing ...</a></li>');
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
						
						html += '<li ><a href="javascript:void(0);" class="select_language '+session_public+'" data-id="'+value.id+'" >'+value.name+'</a></li>';
					});
					
					language_result.html(html);
				}
				else
				{
					language_result.html('<li><a href="javascript:void(0);">No language found.</a></li>');
				}
			}
		})
	});
	
	$("body").on("click",".select_tag",function(){
		var session_public=''
		if($(this).hasClass('session_public'))
		{
			session_public = 'session_public';
		}
		var value=$(this).attr("data-id");
		$("#tag_selected").append("<input type='hidden' name='tag_selected[]' value='"+value+"'>");
		$("#tag_search_ui").append('<li>'+$(this).text()+'<a href="javascript:void(0);" class="remove_tag '+session_public+'" alt="'+value+'"><i class="fa fa-times"></i></a></li>');
		$("#tag_result").html("");
		$("#tag_search").val('');
		
		if($(this).hasClass('session_public'))
		{
			var datastring = $("#form_search_public_session").serialize();
			search_public_request(datastring);
		}
		else
		{
			var datastring = $("#form_search_expert").serialize();
			search_expert(datastring);
		}
		
	});
	
	
	$("body").on("click",".select_language",function(){
		var session_public=''
		if($(this).hasClass('session_public'))
		{
			session_public = 'session_public';
		}
		var value=$(this).attr("data-id");
		$("#language_selected").append("<input type='hidden' name='language_selected[]' value='"+value+"'>");
		$("#language_search_ui").append('<li>'+$(this).text()+'<a href="javascript:void(0);" class="remove_language '+session_public+'" alt="'+value+'"><i class="fa fa-times"></i></a></li>');
		$("#language_result").html("");
		$("#language_search").val('');
		
		if($(this).hasClass('session_public'))
		{
			var datastring = $("#form_search_public_session").serialize();
			search_public_request(datastring);
		}
		else
		{
			var datastring = $("#form_search_expert").serialize();
			search_expert(datastring);
		}
	});
	
	$("body").on("click",".remove_tag",function(){
		var value=$(this).attr("alt");
		$("[name='tag_selected[]'][value='"+value+"']").remove();
		$(this).parent().remove();
		
		if($(this).hasClass('session_public'))
		{
			var datastring = $("#form_search_public_session").serialize();
			search_public_request(datastring);
		}
		else
		{
			var datastring = $("#form_search_expert").serialize();
			search_expert(datastring);
		}		
	});
	
	$("body").on("click",".remove_language",function(){
		var value=$(this).attr("alt");
		$("[name='language_selected[]'][value='"+value+"']").remove();
		$(this).parent().remove();
		
		if($(this).hasClass('session_public'))
		{
			var datastring = $("#form_search_public_session").serialize();
			search_public_request(datastring);
		}
		else
		{
			var datastring = $("#form_search_expert").serialize();
			search_expert(datastring);
		}		
	});
	
	/*
	$("#book_schedule_public").click(function(){
	
	
	var datastring = $('#form_book_schedule_public').serialize();
	alert(datastring);
	
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
	*/
//	var datastring = $("#form_search_expert").serialize();
	//search_expert(datastring);

	$("#category").change(function(){
	
	if($(this).hasClass('session_public'))
	{
		var datastring = $("#form_search_public_session").serialize();
		search_public_request(datastring);
	}
	else
	{
		var datastring = $("#form_search_expert").serialize();
		search_expert(datastring);
	}	
		
	});
	
	
	
	$(".is_date_selected").click(function(){
		if($(this).val() == "1")
		{
			$("#public_select_date").slideDown();
		}
		else if($(this).val() == "0")
		{
			$("#public_select_date").slideUp();
		}
	});
	
	$("body").on("click",".wishlist",function(){
		var $this = $(this);
		var id = $this.attr("data-id");
		var type = $this.attr("data-type");
		
		var datastring = {'action':'submit_wishlist','id':id,'type':type};
		$.ajax({
			url:root+'handler.php',
			type:'post',
			data:datastring,
			//dataType:'json',
			beforeSend:function(){
				
			},
			success:function(response){
				
				if(response == 'success')
				{
					if(type == 'add')
					{
					
						$this.html('<i class="fa fa-heart"></i>wishlist').addClass('remove_list_btn').attr('data-type','remove');
					}
					else if(type == 'remove')
					{
						
						$this.html('<i class="fa fa-heart"></i>Add to wishlist').removeClass('remove_list_btn').attr('data-type','add');
						if($('#page_type').text() == 'wishlist')
						{
							$this.parents().eq(2).slideUp();
						}
					}
					
					
				
				}
				else
				{
					alert('error');
				}
			}
		});
	
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

function search_expert(datastring)
{
		$.ajax({
			url:root+'handler.php',
			type:'post',
			data:datastring,
			dataType:'json',
			beforeSend:function(){
				$('#loader').show();
			},
			success:function(response){
				$('#loader').hide();
			var html = '';
				if(response.status == 'success')
				{
				
$.each(response.result,function(key,value){
html += '<div class="listcont"><div class="row">';
html += '<div class="col-xs-12"><div class="expertinforow">';
html += '<div class="socialdrop">';
html += '<a href="javascript:void(0);" class="dropicon"><i class="fa fa-ellipsis-v"></i></a>';

html += '<div class="hovertip"><ul class="shareTip">';
html += '<li><a href="javascript:void(0);" data-toggle="tooltip" title="Facebook" class="FB_bg"><i class="fa fa-facebook"></i></a></li>';
html += '<li><a href="javascript:void(0);" data-toggle="tooltip" title="Twitter" class="TW_bg"><i class="fa fa-twitter"></i></a></li>';
html += '<li><a href="javascript:void(0);" data-toggle="tooltip" title="Google +" class="GPlus_bg"><i class="fa fa-google-plus"></i></a></li>';
html += '<li><a href="javascript:void(0);" data-toggle="tooltip" title="Linkedin" class="LKN_bg"><i class="fa fa-linkedin"></i></a></li>';
html += '<li><a href="javascript:void(0);" data-toggle="tooltip" title="Website" class=""><i class="fa fa-home"></i></a></li>';
html += '</ul>';
html += '</div>';
html += '</div>';
var profile_image = 'images/users/default.jpg';
if(value.profile_image != '')
{
	profile_image = value.profile_image;
}
html += '<span class="expertimg">';
html += '<img src="'+profile_image+'" alt="expert1" class="img-responsive"/>';
html += '</span><h4><a href="javascript:void(0);">'+value.fname+' '+value.lname+'</a></h4>';
html += '<ul>';
html += '<li><i class="fa fa-map-marker"></i> '+value.city+' '+value.country_id+'</li>';
html += '<li><i class="fa fa-globe"></i>'+value.language+'</li>';
html += '</ul></div></div><div class="col-xs-12 col-md-8 col-lg-9">';
if(value.tag != '')
{
html += '<ul class="tags">';
var tags = (value.tag).split(",");
$.each(tags,function(key,tag_val){
html += '<li><a href="javascript:void(0);">'+tag_val+'</a></li>';
});
//html += '<li><a href="javascript:void(0);">+ 3 more...</a></li>';
html += '</ul>';
}
html += '<p>'+value.exp_about+'</p>';
html += '</div><div class="col-xs-12 col-md-4 col-lg-3">';
html += '<a href="'+root+'schedule.php?id='+value.id+'" class="bookme_btn bookfree">';

if(value.exp_rate == '0')
{
html += '<span class="free">Always FREE<img src="images/round_arrow_blue.png" alt="arrow" class="img-responsive" /></span>';
}
else
{
html += '<span><i class="fa fa-dollar"></i> '+value.exp_rate+'</span>';
}
html += 'Book Me Now!</a>';

if(value.wished == null)
{
	html += '<a href="javascript:void(0);" class="wishlistbtn wishlist" data-type="add" data-id="'+value.id+'">';
	html += '<i class="fa fa-heart"></i>Add to wishlist</a>';
}
else
{
html += '<a href="javascript:void(0);" class="wishlistbtn wishlist remove_list_btn" data-type="remove" data-id="'+value.id+'" title="Remove From wishlist">';
	html += '<i class="fa fa-heart"></i>wishlist</a>';
}

html += '</div><div class="col-xs-12 has_reviews">';
html += '<ul class="haslist">';
html += '<li><a href="javascript:void(0);" class="haslink" data-toggle="tooltip" title="Number of reviews"><i class="fa fa-thumbs-o-up"></i> <span>50</span></a>';
html += '</li><li>';
html += '<a href="javascript:void(0);"  class="haslink" data-toggle="tooltip" title="Average rating"><i class="fa fa-star-o"></i> <span>7.3</span></a>';
html += '<div class="hasreview_drop"><ul class="shareTip">';
html += '<li><h3>Reviews of this Expert</h3></li>';
html += '<li><p>Rutgers is very knowledgable and open. Great entrepreneurial spirit. Very useful! Thanks a lot!</p>';
html += '<span class="hasrating">';
html += '<a href="javascript:void(0);" class="filled"><i class="fa fa-star"></i></a>';
html += '<a href="javascript:void(0);" class="filled"><i class="fa fa-star"></i></a>';
html += '<a href="javascript:void(0);" class="filled"><i class="fa fa-star-half-empty"></i></a>';
html += '<a href="javascript:void(0);"><i class="fa fa-star-o"></i></a>';
html += '<a href="javascript:void(0);"><i class="fa fa-star-o"></i></a>';
html += '<span>6/10</span></span>';
html += '<a href="javascript:void(0);" class="hasreview_name">christian Baudry </a>';
html += '</li><li><p>Rutgers is very knowledgable and open. Great entrepreneurial spirit. Very useful! Thanks a lot!</p>';
html += '<span class="hasrating">';
html += '<a href="javascript:void(0);" class="filled"><i class="fa fa-star"></i></a>';
html += '<a href="javascript:void(0);" class="filled"><i class="fa fa-star"></i></a>';
html += '<a href="javascript:void(0);" class="filled"><i class="fa fa-star-half-empty"></i></a>';
html += '<a href="javascript:void(0);"><i class="fa fa-star-o"></i></a>';
html += '<a href="javascript:void(0);"><i class="fa fa-star-o"></i></a>';
html += '<span>6/10</span>';
html += '</span>';
html += '<a href="javascript:void(0);" class="hasreview_name">christian Baudry </a>';
html += '</li>';
html += '<li><a href="javascript:void(0);" class="viewall_link">View All <i class="fa fa-angle-double-right"></i></a></li>';
html += '</ul></div></li><li>';
html += '<a href="javascript:void(0);"  class="haslink" data-toggle="tooltip" title="Number of session held"><i class="fa fa-video-camera"></i> <span>50</span></a>';
html += '</li></ul></div></div></div>';
});

				}
				else if(response.status == 'no_record')
				{
					html += '<div class="listcont"><div class="row">';
					html += '<div class="col-xs-12"><h3>No Expert Found.';
					html += '</h3></div></div></div>';
				}
				$("#serach_expert_result").html(html);
				$("#expert_count").text(response.count);
			},
			complete:function(){
			$('#loader').hide();
			}
		});
}


function search_public_request(datastring)
{
		$.ajax({
			url:root+'handler.php',
			type:'post',
			data:datastring,
			dataType:'json',
			beforeSend:function(){
				$('#loader').show();
			},
			success:function(response){
				$('#loader').hide();
			var html = '';
				if(response.status == 'success')
				{
				
				$.each(response.result,function(key,value){
					
                        html += '<div class="listcont browserreqlist"><div class="row">';
                        html += '<div class="col-xs-12"><h2><a href="'+root+'session_request.php?id='+value.id+'">'+value.title+'</a></h2>';
						html += '<p>'+value.description+'</p>';
												
						if(value.tag != '')
						{
						html += '<ul class="tags">';
						var tags = (value.tag).split(",");
						$.each(tags,function(key,tag_val){
						html += '<li><a href="javascript:void(0);">'+tag_val+'</a></li>';
						});
						html += '</ul>';
						}
						var profile_image = 'images/users/default.jpg';
						if(value.profile_image != '')
						{
							profile_image = value.profile_image;
						}
						html += '<div class="expertinforow"><span class="expertimg">';
						html += '<img src="'+profile_image+'" alt="expert1" class="img-responsive"/></span>';
						html += '<ul>';
						html += '<li><i class="fa fa-user"></i> Requested by : <span>'+value.fname+' '+value.lname+'</span> '+value.created+'</li>';
						html += '<li><i class="fa fa-globe"></i>'+value.language+'</li>';
						html += '</ul>';
						html += '<a href="'+root+'public_accept.php?id='+value.id+'" class="bookme_btn apply_btn">Apply </a>';
						html += '<a href="'+root+'public_request.php?id='+value.id+'" class="wishlistbtn details_btn">See Details</a>';
						html += '</div>';
						html += '</div>';
						html += '<div class="col-xs-12 col-md-4 col-lg-3">';
						html += '</div></div></div>';
						
				});

				}
				else if(response.status == 'no_record')
				{
					html += '<div class="listcont"><div class="row">';
					html += '<div class="col-xs-12"><h3>No Public request Found.';
					html += '</h3></div></div></div>';
				}
				$("#serach_public_result").html(html);
				$("#request_count").text(response.count);
			}
		});
}
/*sign up */
$(document).ready(function(){
///////// create account////////////
	$("#sign_up").validate({
	
	    rules: {
	    	
	    	email : {
	    	      required: true,
	    	      email: true
	    	    },
	    	password : "required",
	    	conf_password: {
	    	      equalTo: "#password"
	    	    }
	    },
	    messages: {
	    	
	    	email :  {
	    	      required: "Please enter email address",
	    	      email: "Please enter valid email address"
	    	    },
	    	password : "Please enter password",
	    	conf_password: {
	    	      equalTo: "Password must be same"
	    	    } 
			   
		   },
	    submitHandler: function(form) {
	    	var email = $('#email').val();
	    	var dataString = $('#sign_up').serialize();
	    	if($("#terms").prop('checked') == true)
	    	{
	    		$('#errors').html('');
			$.ajax({
				type: "POST",
				url: root+"handler.php",
				data: dataString,
				beforeSend: function(){
				$('#showLoder').show();	
			    },
				success: function(data){
					$('#showLoder').hide();	
					if($.trim(data)=="exists")
					{
						$('#errors').html('<span style="color:red;">Email address already exists,please try login.</span>');
						setTimeout(function() {
							  // Do something after 5 seconds
							$('#loginform').css('display','block');
							$('#signupform').css('display','none');
							$('#email_address').val($.trim(email));
						}, 3000);
						
					}else 
					if($.trim(data)=="success")
					{
						$('#errors').html('<span style="color:green;">Successfully registered with us. Please login to continue.</span>');
						setTimeout(function() {
							  // Do something after 5 seconds
							$('#loginform').css('display','block');
							$('#signupform').css('display','none');
							$('#email_address').val($.trim(email));
						}, 2000);
					}else {
					$('#errors').html('<span style="color:red;">Some error occur ,please try again later.</span>');
					}
				}
					
				}); 
	    	} else {
	    		$('#errors').html('<span style="color:red;">Please accept terms and condition for registration.</span>');
	    	}
	    }
	});
///////// login user////////////
	$("#login").validate({
	
	    rules: {
	    	
			    email_address : "required",
			    password : "required"
	    },
	    messages: {
	    	
			    email_address :"Please enter email or username",
			    password : "Please enter password"
		   },
	    submitHandler: function(form) {
	    	var dataString = $('#login').serialize();
			$.ajax({
				type: "POST",
				url: root+"handler.php",
				data: dataString,
				beforeSend: function(){
				$('#showLoder').show();	
			    },
				success: function(data){
					$('#showLoder').hide();	
					if($.trim(data)=="not_found")
					{
						$('#msg').html('<span style="color:red;">Invalid credential,please check you email or password.</span>');
					}else 
					if($.trim(data)=="success")
					{
						$('#msg').html('<span style="color:green;">You have been logged in successfully.</span>');
						setTimeout(function() {
						  // Do something after 5 seconds
							window.location.href = 'account.php';
					}, 2000);
					}else {
					$('#msg').html('<span style="color:red;">Some error occur ,please try again later.</span>');
					}
				}
					
				}); 
	    }
	});
////forgot password////
///////// login user////////////
$("#get_password").validate({

    rules: {
    	
    	email_address : "required"
    },
    messages: {
    	
    	email_address :"Please enter email or username"
	   },
    submitHandler: function(form) {
    	var dataString = $('#get_password').serialize();
		$.ajax({
			type: "POST",
			url: root+"handler_next.php",
			data: dataString,
			beforeSend: function(){
			$('#showLoder').show();	
		    },
			success: function(data){
				$('#showLoder').hide();	
				if($.trim(data)=="not_found")
				{
					$('#message').html('<span style="color:red;">Invalid email ,please check you email address.</span>');
				}else 
				if($.trim(data)=="success")
				{
					$('#message').html('<span style="color:green;">Please check your email ,password has been send successfully.</span>');
					setTimeout(function() {
					  // Do something after 5 seconds
						$('.modal').modal('toggle');
				}, 2000);
				}else {
				$('#message').html('<span style="color:red;">Some error occur ,please try again later.</span>');
				}
			}
				
			}); 
    }
});
///////// change password////////////
$("#password_info").validate({

    rules: {
    	current_pass : "required",
		    new_pass : "required",
		    pass_again: {
	    	      equalTo: "#new_pass"
	    	    }
    },
    messages: {
    	
    	current_pass :"Please enter current password",
    	new_pass : "Please enter new password",
    	pass_again: {
  	      equalTo: "Password must be same to the new password"
  	    }
	   },
    submitHandler: function(form) {
    	var dataString = $('#password_info').serialize();
		$.ajax({
			type: "POST",
			url: root+"handler.php",
			data: dataString,
			beforeSend: function(){
			$('#loader').show();	
		    },
			success: function(data){
				$('#loader').hide();	
				if($.trim(data)=="wrong_pass")
				{
					$('#errors_pop').html('<span style="color:red;">Current password is wrong ,please check again.</span>');
				}else 
				if($.trim(data)=="success")
				{
					$('#errors_pop').html('<span style="color:green;">Password changed successfully.</span>');
					setTimeout(function() {
					  // Do something after 5 seconds
						window.location.href = 'account.php';
				}, 2000);
				}else {
				$('#errors_pop').html('<span style="color:red;">Some error occur ,please try again later.</span>');
				}
			}
				
			}); 
    }
});
///////// update personal details////////////
$("#personal_details").validate({

    submitHandler: function(form) {
    	var dataString = $('#personal_details').serialize();
		$.ajax({
			type: "POST",
			url: root+"handler.php",
			data: dataString,
			beforeSend: function(){
			$('#showLoder').show();	
		    },
			success: function(data){
				$('#showLoder').hide();	
				if($.trim(data)=="success")
				{
					$('#errors').html('<span style="color:green;">Details updated successfully.</span>');
					$('html,body').animate({
				        scrollTop: $(".breadcrumb").offset().top},
				        'slow');
					setTimeout(function() {
					  // Do something after 5 seconds
						window.location.href = 'account.php';
				}, 2000);
				}else {
				$('#errors').html('<span style="color:red;">Some error occur ,please try again later.</span>');
				}
			}
				
			}); 
    }
});
///////// update account(email) details////////////
$("#update_email").validate({

    submitHandler: function(form) {
    	var dataString = $('#update_email').serialize();
		$.ajax({
			type: "POST",
			url: root+"handler.php",
			data: dataString,
			beforeSend: function(){
			$('#showLoder').show();	
		    },
			success: function(data){
				$('#showLoder').hide();	
				if($.trim(data)=="exists")
				{
					$('#errors').html('<span style="color:red;">Email address already used by other user.</span>');
				}else
				if($.trim(data)=="success")
				{
					$('#errors').html('<span style="color:green;">Details updated successfully.</span>');
					setTimeout(function() {
					  // Do something after 5 seconds
						window.location.href = 'account.php';
				}, 2000);
				}else {
				$('#errors').html('<span style="color:red;">Some error occur ,please try again later.</span>');
				}
				$('html,body').animate({
			        scrollTop: $(".breadcrumb").offset().top},
			        'slow');
			}
				
			}); 
    }
});
///////// update expert details////////////
$("#expert_info").validate({

    submitHandler: function(form) {
    	var dataString = $('#expert_info').serialize();
		$.ajax({
			type: "POST",
			url: root+"handler.php",
			data: dataString,
			beforeSend: function(){
			$('#showLoder').show();	
		    },
			success: function(data){
				$('#showLoder').hide();	
				if($.trim(data)=="success")
				{
					$('#errors').html('<span style="color:green;">Details updated successfully.</span>');
					$('html,body').animate({
				        scrollTop: $(".breadcrumb").offset().top},
				        'slow');
					setTimeout(function() {
					  // Do something after 5 seconds
						window.location.href = 'expert_info.php';
				}, 2000);
				}else {
				$('#errors').html('<span style="color:red;">Some error occur ,please try again later.</span>');
				}
			}
				
			}); 
    }
});
/*search experts by name */
$("#expert_search").autocomplete({
	source: function(request, response) {
        $.ajax({
            url: "handler.php",
            dataType: "json",
            data: {
            	expert_name : request.term
            },
            success: function(data) {
                response(data);
            }
        });
    },
    select: function(e, ui) {
        e.preventDefault() // <--- Prevent the value from being inserted.
        //$("#tag_id").val(ui.item.id);
        $(this).val(ui.item.label);
        var datastring = $("#form_search_expert").serialize();
		search_expert(datastring);
    }
});
});


