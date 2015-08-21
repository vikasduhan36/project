<?php 
 ////// HEADER ////// 
require_once 'phpInclude/header.php';
?>
<section class="midsection accountsection"><!-- // MID MAIN SECTION // -->
	<div class="container">
    	<div class="row">
        	<div class="col-xs-12 col-sm-4 col-md-3">
            	<div class="sidebarnav"><!-- // SIDE BAR NAV // -->
                	<span class="dashbar clearfix">
                    	<i class="fa fa-dashboard"></i> Dashboard
                        <a href="javascript:void(0);" class="togglebtn2 visible-xs" data-toggle="tooltip" title="Click me">
                        	<i class="fa fa-circle"></i><i class="fa fa-circle"></i><i class="fa fa-circle"></i>
                        </a>
                    </span>
                    <div class="toggle_db"><!-- FOR TOGGLED DASHBOARD -->
                    <form id="imageform" method="post" enctype="multipart/form-data" action='handler.php'>
                        <div class="accountimgblk">
                            <span class="imgcont" id='preview'><img src="<?php echo $prof_pic;?>" alt="user" class="responsiveimg" id="output"/></span>
                            <span class="uploadimgotr">
                                <input type="file"  name="photoimg" id="photoimg" />
                                <span><i class="fa fa-camera"></i> Upload Image</span>
                            </span>
                        </div>
                        </form>
                        <div class="accountprogress">
                            <h6 class="progresstxt">Profile completeness: <span>55%</span></h6>
                            <div class="progress">
                              <div class="progress-bar progress-bar-striped active progress-bar-info" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                <span class="sr-only"></span>
                              </div>
                            </div>
                        </div>
                        <ul class="navlist">
                            <li><a href="javascript:void(0);" class="active"><i class="fa fa-caret-right"></i> My Account</a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-caret-right"></i> My Sessions</a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-caret-right"></i> Expert Wishlist</a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-caret-right"></i> Finance</a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-caret-right"></i> Help</a></li>
                        </ul>					
                    </div><!-- FOR TOGGLED DASHBOARD -->
                </div><!-- // SIDE BAR NAV // -->
            </div>
            
            <div class="col-xs-12 col-sm-8 col-md-9">
            	<section class="right_main"><!-- // RIGHT MAIN // -->
                    <ul class="breadcrumb">
                        <li><a href="javascript:void(0);">Home</a></li>
                        <li>My Account</li>
                    </ul>
                    <h2 class="accountheading"><small>My</small>Account</h2>
                    <div id="errors"></div>
                    <div class="myaccountinfo"><!-- // MY ACCOUNT INFORMATION // -->
                    <form id="update_email">
                        <div class="infoblks clearfix"><!-- Account information -->
                        	<h4>Account Detail</h4>
                        	<ul class="row infolist">
                            	<li>
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Email Address</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<span class="value"><?php echo $email;?></span>
                                        <input type="text" Placeholder="Enter your email" autocomplete="off" name="email" class="form-control valuefield" style="display:none;" value="<?php echo $email;?>"/>
                                    </div>
                                    <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-edit"></i> Edit</a>
                                    </div>
                                </li>
                                <li>
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Password</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<span class="value">***********</span>
                                    </div>
                                    <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" data-toggle="modal" data-target="#passwordmodal" class="editlink"><i class="fa fa-edit"></i> Edit</a>
                                    </div>
                                </li>
                            </ul>
                           <!--  <a href="javascript:void(0);" class="submitbtn btn1">Submit <i class="fa fa-check"></i></a> -->
                           <input type="hidden" value="update_email" name="action"/>
                        <input type="submit" value="Submit" class="submitbtn btn1" />
                        </div><!-- Account information -->
                        </form>
                        
                        <div class="infoblks clearfix"><!-- Personal information -->
                        <form id="personal_details">
                        	<h4>Personal Detail</h4>
                        	<ul class="row infolist">
                            	<li>
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Full Name</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<span class="value"><?php echo $username;?></span>
                                        <input type="text" Placeholder="Enter Full Name" autocomplete="off" name="full_name" class="form-control valuefield" style="display:none;" value="<?php echo $username;?>"/>
                                    </div>
                                    <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-edit"></i> Edit</a>
                                    </div>
                                </li>
                                <li>
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>City</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<span class="value"><?php echo $city;?></span>
                                        <input type="text" Placeholder="City" name="city" autocomplete="off" class="form-control valuefield" style="display:none;" value="<?php echo $city;?>"/>
                                    </div>
                                    <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-edit"></i> Edit</a>
                                    </div>
                                </li>
                                <li>
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Country</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<span class="value" id="country_span">India</span>
                                        <select class="form-control custom-select valuefield" name="country" id="country" style="display:none;" >
                                        <option value="">Select Country</option>
                                        <?php 
                                        $cond = " ";
                                        $field=" * ";
                                        $table=" country ";
                                        $country = getDetail($field,$table,$cond);
                                        foreach ($country as $key=>$value){
                                        	if(trim($value['country_code'])== trim($country_id)){
                                        		$selected='selected="selected"';
                                        	} else {
                                        		$selected='';
                                        	}
                                        ?>
                                        <option value="<?php echo $value['country_code'];?>" <?php echo $selected;?>><?php echo $value['country_name'];?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-edit"></i> Edit</a>
                                    </div>
                                </li>
                                <li class="not_set">
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Timezone</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<span class="value" id="time_span">Not Set</span>
                                        <select class="form-control custom-select valuefield" name="timezone" id="timezone" style="display:none;" >
                                        <option value="">Select Timezone</option>
                                        <?php 
                                        $cond = " ";
                                        $field=" * ";
                                        $table=" timezone ";
                                        $timezone = getDetail($field,$table,$cond);
                                        foreach ($timezone as $key=>$value){
                                        	if(trim($value['id'])== trim($timezone_id)){
                                        		$selected='selected="selected"';
                                        	} else {
                                        		$selected='';
                                        	}
                                        ?>
                                        <option value="<?php echo $value['id'];?>" <?php echo $selected;?>><?php echo $value['name'];?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-edit"></i> Edit</a>
                                    </div>
                                </li>
                                <li class="not_set">
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Languages</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<span class="value"><?php echo $language_id;?></span>
                                        <input type="text" Placeholder="Choose some languages.." name="languages" class="form-control valuefield" id="language" style="display:none;" value="<?php echo $language_id;?>"/>
                                    </div>
                                    <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-edit"></i> Edit</a>
                                    </div>
                                </li>
                                <li class="not_set">
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Birthdate</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<span class="value"><?php echo $dob;?></span>
                                        <input type="text" Placeholder="Birthdate" name="dob" class="form-control valuefield" style="display:none;"  value="<?php echo $dob;?>"  id="datepicker"/>
                                    </div>
                                    <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-edit"></i> Edit</a>
                                    </div>
                                </li>
                                <li class="not_set">
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Phone</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<span class="value"><?php echo $phone;?></span>
                                        <input type="text" Placeholder="Phone" autocomplete="off" name="phone" class="form-control valuefield" style="display:none;"  value="<?php echo $phone;?>"/>
                                    </div>
                                    <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-edit"></i> Edit</a>
                                    </div>
                                </li>
                            </ul>
                            <!-- <a href="javascript:void(0);" class="submitbtn btn1">Submit <i class="fa fa-check"></i></a> -->
                            <input type="hidden" value="personal_details" name="action"/>
                        <input type="submit" value="Submit" class="submitbtn btn1" />
                            </form>
                        </div><!-- Personal information -->
                        
                        <div class="infoblks clearfix"><!-- Social Account information -->
                        	<h4>Social Accounts</h4>
                        	<form>
                        	<ul class="row infolist">
                            	<li>
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>LinkedIn</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<a href="javascript:void(0);"><span class="value">https://www.linkedin.com/pub/amit-rawat/b2/116/462</span></a>
                                    </div>
                                    <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-chain-broken"></i> Disconnet</a>
                                    </div>
                                </li>
                                <li>
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Twitter</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<a href="javascript:void(0);"><span class="value">--</span></a>
                                    </div>
                                    <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-chain"></i> Connect</a>
                                    </div>
                                </li>
                                <li>
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Facebook</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<a href="javascript:void(0);"><span class="value">--</span></a>
                                    </div>
                                    <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-chain"></i> Connect</a>
                                    </div>
                                </li>
                                <li>
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Google+</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<a href="javascript:void(0);"><span class="value">--</span></a>
                                    </div>
                                    <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-chain"></i> Connect</a>
                                    </div>
                                </li>
                            </ul>
                            <a href="javascript:void(0);" class="submitbtn btn1">Submit <i class="fa fa-check"></i></a>
                            </form>
                        </div><!-- Social Account information -->
                        
                        <div class="infoblks clearfix"><!-- Partner sites information -->
                        	<h4>Partner sites</h4>
                        	<ul class="row infolist">
                            	<li>
                                	<div class="col-xs-12"><label><a href="javascript:void(0);">Add Link..</a></label></div>
                                </li>
                            </ul>
                            <a href="javascript:void(0);" class="submitbtn btn1">Submit <i class="fa fa-check"></i></a>
                        </div><!-- Partner sites information -->
                        
                        <div class="infoblks clearfix"><!-- Are you an expert -->
                        	<h4>Are you an expert?</h4>
                        	
                            <a href="javascript:void(0);" class="submitbtn btn1 pull-left applyexpertbtn">Apply to be an expert <i class="fa fa-check"></i></a>
                        </div><!-- Are you an expert -->
                        
                    </div><!-- // MY ACCOUNT INFORMATION // -->
                </section><!-- // RIGHT MAIN // -->
            </div>
        </div>
    </div>
</section><!-- // MID MAIN SECTION // -->



<footer class="footer"><!-- // FOOTER CONTAINER // -->
	<div class="container">
    	<div class="row">
        	<div class="col-xs-12 ft_blks text-center">
            	<h4>Quick Links</h4>
                <ul class="qlinkslist">
                	<li><a href="javascript:void(0);">Home</a></li>
                    <li><a href="javascript:void(0);">About us</a></li>
                    <li><a href="javascript:void(0);">The team</a></li>
                    <li><a href="javascript:void(0);">FAQ and support</a></li>
                    <li><a href="javascript:void(0);">Partnerships & opportunities</a></li>
                    <li><a href="javascript:void(0);">Press</a></li>
                    <li><a href="javascript:void(0);">Our blog</a></li>
                </ul>
            </div>
        </div>
  	</div>
    
    <section class="footerbtm">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="socialblk">
                        <ul>
                            <li><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                    <p class="copyrighttxt">©2015 eyeask.com. All rights reserved.</p>
                </div>
            </div>
        </div>
    </section>
</footer><!-- // FOOTER CONTAINER // -->

</section><!-- // MAIN INNER SECTION // -->
</section><!-- // MAIN ID SECTION // -->


<div class="modal fade AccountModal" id="passwordmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"><!-- // CHANGE PASSWORD // -->
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      	<h4>Change Password</h4>
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
      </div>
      <div class="modal-body">
      <div id="errors"></div>
      	<div class="formOtr">
        	<div id="loginform" style="display:block;">
                <form id="password_info">
                    <div class="form-group">
                    	<label class="lbl">Current Password</label>
                         <div class="fields">
                        	<input type="password" class="form-control" placeholder="Enter Current password" name="current_pass" id="current_pass"/>
                        	<i class="fa fa-key icons"></i>
                         </div>
                    </div>
                    <div class="form-group">
                    	<label class="lbl">New Password</label>
                         <div class="fields">
                        	<input type="password" class="form-control" placeholder="Enter New password" name="new_pass" id="new_pass"/>
                        	<i class="fa fa-key icons"></i>
                         </div>
                    </div>
                    <div class="form-group">
                    	<label class="lbl">Confirm New Password</label>
                         <div class="fields">
                        	<input type="password" class="form-control" placeholder="Confirm password" name="pass_again" id="pass_again"/>
                        	<i class="fa fa-key icons"></i>
                         </div>
                    </div>
                    <div class="form-group">
                    <input type="hidden" name="action" value="change_password" />
                        <input type="submit" value="Update" class="signin_btn updatepassbtn" />
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div><!-- // CHANGE PASSWORD MODAL // -->


<!-- // JQUERY AT BOTTOM // -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/jquery.lightSlider.js"></script> 
<script type="text/javascript" src="js/jquery.form.js"></script>

<script type="text/javascript" >
 $(document).ready(function() { 
		
            $('#photoimg').on('change', function()			{ 
			           $("#preview").html('');
			    $("#preview").html('<img src="images/loader.gif" alt="Uploading...."/>');
			$("#imageform").ajaxForm({
						target: '#preview'
		}).submit();
		
			});
        }); 
</script>
<script>
$(window).scroll(function() {
	// SCROLL HEADER //
	var scroll = $(window).scrollTop();
	if(scroll >= 100){
		$(".back_to_top").addClass("show");
	}
	else{
		$(".back_to_top").removeClass("show");
	}
});
$(document).ready(function() {
	 $( "#datepicker" ).datepicker({
	      changeMonth: true,
	      changeYear: true,
	      yearRange: '1960:2000',
	      dateFormat: 'mm-dd-yy'
	    });
	    
	$('.editlink').click(function(){
		$(this).text('Submit');
		$(this).parents('li').find('input,select').show();
		$(this).parents('li').find('span').hide();
	});
	// Testimonial //
	$("#testislide").lightSlider({
		loop:true,
		keyPress:true,
		controls:false,
		item:1,
	});
	// Video slider //
	$("#videoslide").lightSlider({
		loop:true,
		keyPress:true,
		controls:true,
		prevHtml:'<i class="fa fa-angle-left"></i>',
    	nextHtml:'<i class="fa fa-angle-right"></i>',
		item:1,
		slideMargin:0,
		pager:false,
	});
	// NAVIGATION TOGGLE //
	$(".navtogglebtn").on("click", function(e) {
		$(this).toggleClass('active');
		$('body,html').find('#maininnr').toggleClass('togglemain');
		$(this).next().toggleClass('expendnav');
		e.stopPropagation()
	});
	$(document).on("click", function(e) {
		if ($(e.target).is("ul.navlist, ul.navlist li a") === false) {
		  $('.navtogglebtn').removeClass('active');
		  $('body,html').find('#maininnr').removeClass('togglemain');
		  $('.navtogglebtn').next().removeClass('expendnav');
		}
	});
	// LOGIN SIGN UP FORM //
	$('.singinlink').click(function(){
		$('#loginform').css('display','block');
		$('#signupform').css('display','none');
	});
	$('.signuplink').click(function(){
		$('#loginform').css('display','none');
		$('#signupform').css('display','block');
	});
	// Animate scroll Top //
	$(".back_to_top").click(function(){
		$("html, body").animate({ scrollTop: 0 }, 600);
		return true;
	});
	// TOOL TIP //
	$('[data-toggle="tooltip"]').tooltip();
	// SIDEBAR TOGGLE IN 767px //
	$(".sidebarnav .togglebtn2").click(function(){
		$(this).parent().next('.toggle_db').slideToggle('slow');
	});
});
$(function() {
    function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
 
    $( "#language" )
      // don't navigate away from the field on tab when selecting an item
      .bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
          event.preventDefault();
        }
      })
      .autocomplete({
        source: function( request, response ) {
          $.getJSON( "handler.php", {
            term: extractLast( request.term )
          }, response );
        },
        search: function() {
          // custom minLength
          var term = extractLast( this.value );
          if ( term.length < 1 ) {
            return false;
          }
        },
        focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          this.value = terms.join( ", " );
          return false;
        }
      });
     var selected_time = $('#timezone').val();
    $('#time_span').text($("#timezone option[value='"+selected_time+"']").text());
    var selected_country = $('#country').val();
    $('#country_span').text($("#country option[value='"+selected_country+"']").text());
  });
</script>
</body>
</html>
