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
                        <li>My Sessions</li>
                    </ul>
                    <h2 class="accountheading"><small>My</small>Sessions</h2>
                    
                    <div class="MysessionCont">
                    	<ul class="session_tabs ">
                        	<li><a href="<?php echo $root;?>exp_sessions.php?tab=schedule" class="<?php if(empty($_GET['tab']) || (isset($_GET['tab']) && $_GET['tab'] == 'schedule')){echo 'active';}?>">Scheduled</a></li>
                            <li><a href="<?php echo $root;?>exp_sessions.php?tab=open" class="<?php if(isset($_GET['tab']) && $_GET['tab'] == 'open'){echo 'active';}?>">Open</a></li>
                            <li><a href="<?php echo $root;?>exp_sessions.php?tab=close" class="<?php if(isset($_GET['tab']) && $_GET['tab'] == 'close'){echo 'active';}?>">Inactive</a></li>
                        </ul>
                        
                        <ul class="session_list">
						<?php 
						if(empty($_GET['tab']) || (isset($_GET['tab']) && $_GET['tab'] == 'schedule'))
						{
							$sql = " SELECT s.title,s.session_datetime,u.fname,u.lname FROM sessions as s LEFT JOIN users as u ";
							$sql .= " ON(s.user_id = u.id) WHERE exp_applied_id='".$_SESSION['LoginUserId']."' and s.status='2' ";

							$query = mysql_query($sql) or die(mysql_error());
							
							
							if($query)
							{
								if(mysql_num_rows($query) > 0)
								{
									echo "<a href='".$root."exp_live.php'>Go to Session screen</a>";
									while($fetch = mysql_fetch_assoc($query))
									{
									?>
									<li>
									<div class="row">
										<div class="col-xs-12 col-sm-2 col-xss-2"><h5><?php echo $fetch['session_datetime'];?></h5></div>
										<div class="col-xs-12 col-sm-7 col-xss-10"><h3><?php echo $fetch['title'];?><span>Expert: <?php $fetch['fname']." ".$fetch['lname'];?></span></h3></div>
										<div class="col-xs-12 col-sm-3 date">
										
										<a href="javascript:void(0);" class="sess_btn">Scheduled</a>
										
										</div>
									</div>
									</li>
									
									<?php
									}
								}
								else
								{
								?>
								<li>
									<div class="row">
										
										<div class="col-xs-12 col-sm-7 col-xss-10"><h3>
										No sessions scheduled yet.
										</h3></div>
										
									</div>
									</li>
								<?php
								}
							}
						}
						else if(isset($_GET['tab']) && $_GET['tab'] == 'open')
						{
							$sql = " SELECT s.exp_applied_id,s.id as s_id,s.exp_reschedule,s.user_reschedule,s.title,s.session_datetime,u.fname,u.lname ";
							$sql .= " FROM session_time as st LEFT JOIN sessions as s ON(st.session_id = s.id) ";
							$sql .= " LEFT JOIN users as u ON(s.user_id = u.id) ";
							$sql .= " WHERE ((st.user_id='".$_SESSION['LoginUserId']."' and s.exp_applied_id='0') or (s.exp_applied_id='".$_SESSION['LoginUserId']."')) and s.status='1' group BY st.session_id ";

							$query = mysql_query($sql) or die(mysql_error());
							
							
							if($query)
							{
								if(mysql_num_rows($query) > 0)
								{
									
									while($fetch = mysql_fetch_assoc($query))
									{
									?>
									<li>
									<div class="row">
		
									<div class="col-xs-12 col-sm-2 col-xss-2"><h5>--</h5></div>
								
										<div class="col-xs-12 col-sm-7 col-xss-10"><h3><?php echo $fetch['title'];?><span>Expert: <?php $fetch['fname']." ".$fetch['lname'];?></span></h3></div>
										<div class="col-xs-12 col-sm-3 date">
										
										<?php
										if($fetch['exp_applied_id'] == 0)
										{
											
											echo '<a href="javascript:void(0);" class="sess_btn waitbtn">Waiting for reply</a>';
										}
										else if($fetch['exp_reschedule'] == 1)
										{
											echo '<a href="javascript:void(0);" class="sess_btn waitbtn">Waiting for reply</a>';
										}
										else if($fetch['user_reschedule'] == 1)
										{
											echo "<a href='".$root."session_request.php?id=".$fetch['s_id']."' class='sess_btn'>Reshcedule Request</a>";
											
										}
										else if($fetch['exp_reschedule'] == 0 && $fetch['user_reschedule'] == 0)
										{
											echo "<a href='".$root."session_request.php?id=".$fetch['s_id']."' class='sess_btn'>Booking Request</a>";
										}
										?>
										
										</div>
									</div>
									</li>
									
									<?php
									}
								}
								else
								{
								?>
								<li>
									<div class="row">
										
										<div class="col-xs-12 col-sm-7 col-xss-10"><h3>
										No open sessions yet.
										</h3></div>
										
									</div>
									</li>
								<?php
								}
							}
						}
						else if(isset($_GET['tab']) && $_GET['tab'] == 'close')
						{
							$sql = " SELECT s.session_datetime,u.fname,u.lname FROM sessions as s LEFT JOIN users as u ";
							$sql .= " ON(s.user_id = u.id) WHERE exp_applied_id='".$_SESSION['LoginUserId']."' and s.status='0' ";

							$query = mysql_query($sql) or die(mysql_error());
							
							
							if($query)
							{
								if(mysql_num_rows($query) > 0)
								{
									
									while($fetch = mysql_fetch_assoc($query))
									{
									?>
									<li>
									<div class="row">
		
									<div class="col-xs-12 col-sm-2 col-xss-2"><h5><?php echo $fetch['session_datetime'];?></h5></div>
								
										<div class="col-xs-12 col-sm-7 col-xss-10"><h3><?php echo $fetch['title'];?><span>Expert: <?php $fetch['fname']." ".$fetch['lname'];?></span></h3></div>
										<div class="col-xs-12 col-sm-3 date">
										
										<a href="javascript:void(0);" class="sess_btn canceled_btn">Cancelled</a>
										
										</div>
									</div>
									</li>
									
									<?php
									}
								}
								else
								{
								?>
								<li>
									<div class="row">
										
										<div class="col-xs-12 col-sm-7 col-xss-10"><h3>
										No inactive sessions yet.
										</h3></div>
										
									</div>
									</li>
								<?php
								}
							}
						}
						
						?>
                        	
                            
                        </ul>
                    </div>
                    
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
