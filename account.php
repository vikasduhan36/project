<?php 
 ////// HEADER ////// 
require_once 'phpInclude/header.php';
?>
<section class="midsection accountsection"><!-- // MID MAIN SECTION // -->
	<div class="container">
    	<div class="row">
        	<div class="col-xs-12 col-sm-4 col-md-3">
            <?php
			require_once('phpInclude/sidebar_expert_profile.php');
			?>
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
									<!--
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-edit"></i> Edit</a>
										-->
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
                        <button type="submit" class="submitbtn btn1">Submit <i class="fa fa-check"></i></button>
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
                                        	if(trim($value['country_code'])== "US"){
                                        		$selected='selected="selected"';
                                        	}
                                        	else
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
								<!-- not_set -->
                                <li class="">
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Timezone</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<span class="value" id="time_span">Not Set</span>
                                        <select class="form-control custom-select valuefield" name="timezone" id="timezone" style="display:none;" >
                                        <option value="">Select Timezone</option>
                                        <?php 
                                        $cond = " ORDER BY id ASC ";
                                        $field=" * ";
                                        $table=" timezone ";
                                        $timezone = getDetail($field,$table,$cond);
                                        foreach ($timezone as $key=>$value){
                                        	if(trim($value['id'])== "151"){
                                        		$selected='selected="selected"';
                                        	}
                                        else if(trim($value['id'])== trim($timezone_id)){
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
                                <li class="">
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Languages</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<span class="value"><?php echo $language_id;?></span>
                                        <input type="text" Placeholder="Choose some languages.." name="languages" class="form-control valuefield" id="language" style="display:none;" value="<?php echo $language_id;?>"/>
                                    </div>
                                    <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-edit"></i> Edit</a>
                                    </div>
                                </li>
                                <li class="">
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Birthdate</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<span class="value"><?php echo $dob;?></span>
                                        <input type="text" Placeholder="Birthdate" name="dob" class="form-control valuefield" style="display:none;"  value="<?php echo $dob;?>"  id="datepicker"/>
                                    </div>
                                    <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-edit"></i> Edit</a>
                                    </div>
                                </li>
                                <li class="">
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
                        <button type="submit" class="submitbtn btn1">Submit <i class="fa fa-check"></i></button>
                            </form>
                        </div><!-- Personal information -->
                        
                        <div class="infoblks clearfix"><!-- Social Account information -->
                        	<h4>Social Accounts</h4>
                        	<form id="social_acc">
                        	<ul class="row infolist">
                            	<li>
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>LinkedIn</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<a href="javascript:void(0);"><span class="value">--</span></a>
                                    </div>
                                    <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-chain-broken"></i> Connect</a>
                                    </div>
                                </li>
                                <li>
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Twitter</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<a href="<?php if ($twitter_url!=""){ echo $twitter_url; }else {echo "javascript:void(0);";}?>" target="_blank"><span class="value"><?php echo $twitter_url;?></span></a>
                                    </div>
                                    <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="<?php if ($twitter_url==""){ echo $root."handler_next.php?userSignUp=twitter"; }else {echo "javascript:void(0);";}?>" class="editlink <?php if ($twitter_url!=""){echo "delete_link";}?>" data-id="<?php echo $_SESSION['LoginUserId'];?>" alt="twitter"><i class="fa fa-chain"></i> <?php if ($twitter_url==""){echo "Connect";}else {echo "Disconnect";}?></a>
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
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3" ><label>Google+</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<a href="javascript:void(0);"><span class="value"><?php echo $google_url;?></span></a>
                                    </div>
                                    <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink <?php if ($google_url!=""){echo "delete_link";}?>" <?php if ($google_url==""){?>onClick="google_social();"  <?php  }else {echo 'alt="gplus"';} ?> data-id="<?php echo $_SESSION['LoginUserId'];?>"/><i class="fa fa-chain"></i> <?php if ($google_url==""){echo "Connect";}else {echo "Disconnect";}?></a>
                                    </div>
                                </li>
                            </ul>
                            <!-- <a href="javascript:void(0);" class="submitbtn btn1">Submit <i class="fa fa-check"></i></a> -->
                            <input type="hidden" value="social_accounts" name="action"/>
                       <!--  <button type="submit" class="submitbtn btn1">Submit <i class="fa fa-check"></i></button> -->
                            </form>
                        </div><!-- Social Account information -->
                        
                        <div class="infoblks clearfix"><!-- Partner sites information -->
                        	<h4>Partner sites</h4>
                        	<ul class="row infolist">
                            	<li>
								<div class="col-xs-12" >
								
								<?php
									$field = " w.id,w.link,c.name ";
									$table = " user_website as w LEFT JOIN partner_category as c ON(w.cat_id=c.id) ";
									$condition 	= " ";
									$wb_details = getDetail($field,$table,$condition);
									
									if(count($wb_details  > 0))
									{
										foreach($wb_details as $wb_detail)
										{
										?>
										<div>
										<div class="col-xs-4" ><?php echo $wb_detail['name'];?></div>
										<div class="col-xs-7" ><a href="<?php echo addhttp($wb_detail['link']);?>" target="_blank"><?php echo $wb_detail['link'];?></a></div>
										<div class="col-xs-1" ><a href="jaavscript:void(0);" title="Click to delete" class="delete_website" alt="<?php echo $wb_detail['id'];?>">X</a></div>
										</div>
										<?php
										}
									}
								
								?>
								<form id="partner_html">
								
								<?php
									$field = " id,name ";
									$table = " partner_category ";
									$condition 	= " ";
									$partner_detail = getDetail($field,$table,$condition);
									?>
									<select id='default_cat' style="display:none;">
									<option value=''>Select a cetegory</option>
									<?php
									foreach($partner_detail as $partner)
									{
										echo "<option value='".$partner['id']."'>".$partner['name']."</option>";
									}
									?>
									</select>
									
									<input type="hidden" name="action" value="add_partner_website">
									</form>
								</div>
                                	<div class="col-xs-12">
									<label>
									<a href="javascript:void(0);" id="add_partner_category">Add Link..</a>
									</label></div>
                                </li>
                            </ul>
                            <a href="javascript:void(0);" class="submitbtn btn1" id="submit_website">Submit <i class="fa fa-check"></i></a>
                        </div><!-- Partner sites information -->
                        <?php if(isset($user_detail[0]['is_expert']) && $user_detail[0]['is_expert']=="0"){?>
                        <div class="infoblks clearfix"><!-- Are you an expert -->
                        	<h4>Are you an expert?</h4>
                        	
                            <a href="<?php echo $root;?>handler.php?sid=<?php echo base64_encode($_SESSION['LoginUserId']);?>&set=<?php echo base64_encode("apply_expert");?>" class="submitbtn btn1 pull-left applyexpertbtn">Apply to be an expert <i class="fa fa-check"></i></a>
                        </div><!-- Are you an expert -->
                        <?php }else { ?>
                         <div class="infoblks clearfix"><!-- Are you an expert -->
                        	
                        	
                        <a href="<?php echo $root;?>handler.php?sid=<?php echo base64_encode($_SESSION['LoginUserId']);?>&set=<?php echo base64_encode("disable_expert");?>" class="submitbtn btn1 pull-left applyexpertbtn disableexpertbtn">Disable expert status <i class="fa fa-times"></i></a>
                        </div><!-- Are you an expert -->
                        <?php } ?>
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
      <div id="errors_pop"></div>
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
		//alert($(this).text());
		if($(this).text() == 'cancel')
		{
			$(this).html('<i class="fa fa-edit"></i>Edit');
			$(this).parents('li').find('input,select').hide();
			$(this).parents('li').find('span').show();
		
		}
		if($(this).text() == ' Disconnect')
		{
			$(this).html('<i class="fa fa-edit"></i>Connect');
			$(this).parents('li').find('input,select').hide();
			$(this).parents('li').find('span').html("");
		
		}
		else if($(this).text() == ' Edit')
		{
			$(this).text('cancel');
			$(this).parents('li').find('input,select').show().focus();
			$(this).parents('li').find('span').hide();
		}
		
		
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
