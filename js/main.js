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
			$(".progresslist li:eq(0)").addClass("stepcomp");
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
	
	var datastring = $("#form_search_expert").serialize();
	search_expert(datastring);
	$("#form_search_expert").change(function(){
		var datastring = $("#form_search_expert").serialize();
	search_expert(datastring);
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
				
			},
			success:function(response){
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

html += '<span class="expertimg">';
html += '<img src="images/users/default.jpg" alt="expert1" class="img-responsive"/>';
html += '</span><h4><a href="javascript:void(0);">'+value.fname+' '+value.lname+'</a></h4>';
html += '<ul>';
html += '<li><i class="fa fa-map-marker"></i> '+value.city+' '+value.country_id+'</li>';
html += '<li><i class="fa fa-globe"></i>'+value.language+'</li>';
html += '</ul></div></div><div class="col-xs-12 col-md-8 col-lg-9">';
html += '<ul class="tags">';
html += '<li><a href="javascript:void(0);">'+value.tag+'</a></li>';
html += '<li><a href="javascript:void(0);">Business Development</a></li>';
html += '<li><a href="javascript:void(0);">Social Media Marketing</a></li>';
//html += '<li><a href="javascript:void(0);">+ 3 more...</a></li>';
html += '</ul>';
html += '<p>'+value.exp_about+'</p>';
html += '</div><div class="col-xs-12 col-md-4 col-lg-3">';
html += '<a href="'+root+'schedule.php?id='+value.id+'" class="bookme_btn bookfree">Book Me Now! ';
html += '<span class="free">Always FREE';
html += '<img src="images/round_arrow_blue.png" alt="arrow" class="img-responsive" /></span></a>';
html += '<a href="javascript:void(0);" class="wishlistbtn">';
html += '<i class="fa fa-heart"></i>Add to wishlist</a>';
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
			$('#showLoder').show();	
		    },
			success: function(data){
				$('#showLoder').hide();	
				if($.trim(data)=="wrong_pass")
				{
					$('#errors').html('<span style="color:red;">Current password is wrong ,please check again.</span>');
				}else 
				if($.trim(data)=="success")
				{
					$('#errors').html('<span style="color:green;">Password changed successfully.</span>');
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
});

function userTimer()                                                     
{
    if(sec > 0){
        document.getElementById('seconds').innerHTML = sec-1;
        sec--;
    }else{
        sec = 59;
        document.getElementById('seconds').innerHTML = sec;
        if(min > 0){
            document.getElementById('minutes').innerHTML = min-1;
            min--;
        }else{
            min = 59;
            document.getElementById('minutes').innerHTML = min;
            if(hrs > 0){
                document.getElementById('hours').innerHTML = hrs-1;
                hrs--;
            }else{
                hrs = 23;
                document.getElementById('hours').innerHTML = hrs;
                if(days > 0){
                    document.getElementById('days').innerHTML = days-1;
                    days--;
                }
            }
        }
    }
 
        if((hrs==0)&&(min==0)&&(sec == 0))                                                                                                                   // session
        {
            var r = confirm("Your scheduled duration for this session has been finished. \r\n Do you want to request more time to participate?");
			if(r)
			{
				alert('request expert');
			}
			else
			{
				alert('session complete');
			}
		}	
		
     
}

