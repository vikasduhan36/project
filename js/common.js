//////admin login code for validation and ajax form submit/////////////////
$(document).ready(function(){
	$.validator.setDefaults({ 
	    ignore: [],
	    // any other default options and/or rules
	});
	
///////// create account////////////
	$("#submit_buiseness").validate({
	
	    rules: {
	    	title: "required",
	    	short_description: {
			      required: true
			    },
			    location : "required",
			    price : "required",
			    select_level : "required",
				image : "required",
			    long_description : "required"
	    },
	    messages: {
	    	title: "Please enter heading",
	    	short_description: {
			      required: "Please enter short description"
			    },
			    location :"Please enter address",
			    price : "Please enter price",
			    select_level : "Please select activity level",
				image : "Please select ad image",
			    long_description : "Please enter long description"
		   },
	    submitHandler: function(form) {
	    	//var dataString = $('#submit_buiseness').serialize();
	    	var formData = new FormData($('#submit_buiseness')[0]);
			$.ajax({
				type: "POST",
				url: root+"handler.php",
				data: formData,
				contentType: false,       // The content type used when sending data to the server.
				cache: false,             // To unable request pages to be cached
				processData:false,        // To send DOMDocument or non processed data file it is set to false
				mimeType:"multipart/form-data",
				beforeSend: function(){
				$('#showLoder').show();	
			    },
				success: function(data){
					$('#showLoder').hide();	
					
					if($.trim(data)=="success")
					{
						$('#errors').html('<span style="color:green;">You have been logged in successfully.</span>');
						setTimeout(function() {
						  // Do something after 5 seconds
							window.location.href = 'user_profile.php';
					}, 2000);
					}else {
					$('#errors').html('<span style="color:red;">Some error occur ,please try again later.</span>');
					}
				}
					
				}); 
	    }
	});


	});