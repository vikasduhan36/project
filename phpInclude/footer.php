
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
                    <p class="copyrighttxt">&copy;2015 eyeask.com. All rights reserved.</p>
                </div>
            </div>
        </div>
    </section>
</footer><!-- // FOOTER CONTAINER // -->

</section><!-- // MAIN INNER SECTION // -->
</section><!-- // MAIN ID SECTION // -->

<?php /*
<div class="modal fade AccountModal" id="passwordmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"><!-- // CHANGE PASSWORD // -->
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      	<h4>Change Password</h4>
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
      </div>
      <div class="modal-body">
      	<div class="formOtr">
        	<div id="loginform" style="display:block;">
                <form>
                    <div class="form-group">
                    	<label class="lbl">Current Password</label>
                         <div class="fields">
                        	<input type="password" class="form-control" placeholder="Enter Current password" />
                        	<i class="fa fa-key icons"></i>
                         </div>
                    </div>
                    <div class="form-group">
                    	<label class="lbl">New Password</label>
                         <div class="fields">
                        	<input type="password" class="form-control" placeholder="Enter New password" />
                        	<i class="fa fa-key icons"></i>
                         </div>
                    </div>
                    <div class="form-group">
                    	<label class="lbl">Confirm New Password</label>
                         <div class="fields">
                        	<input type="password" class="form-control" placeholder="Confirm password" />
                        	<i class="fa fa-key icons"></i>
                         </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Update" class="signin_btn updatepassbtn" />
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div><!-- // CHANGE PASSWORD MODAL // -->
*/?>
<div class="modal fade AccountModal" id="accountpopup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"><!-- // LOGIN & SIGNUP MODAL // -->
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
      </div>
      <div class="modal-body">
      	<div class="formOtr">
        	<div id="loginform" style="display:block;">
                <form id="login">
				<input type="hidden" id="pagename">
                    <h5>Sign in to continue your account</h5>
                    <div class="form-group">
                    	<p class="text-center">Login with one click with LinkedIn, Facebook & Google+</p>
                        <a href="javascript:void(0);" class="socialbtn"><i class="fa fa-linkedin"></i> Login with LinkedIn</a>
                        <a href="javascript:void(0);" class="socialbtn FB_bg"><i class="fa fa-facebook"></i> Login with Facebook</a>
                        <a href="javascript:void(0);" class="socialbtn GPlus_bg" onClick="login()"><i class="fa fa-google-plus"></i> Login with Google+</a>
                        <p class="text-center">...or use your email address and password</p>
                    </div>
                    <div id="msg"></div>
                    <div class="form-group">
                    	<label class="lbl">Email address</label>
                        <div class="fields">
                        	<input type="text" class="form-control" placeholder="Enter you email here" name="email_address" id="email_address" value="<?php if (isset($_COOKIE['email']) && $_COOKIE['email']!=""){echo trim($_COOKIE['email']);}?>"/>
                        	<i class="fa fa-user icons"></i>
                        </div>
                    </div>
                    <div class="form-group">
                    	<label class="lbl">Password</label>
                         <div class="fields">
                        	<input type="password" class="form-control" placeholder="Enter password" name="password" value="<?php if (isset($_COOKIE['password']) && $_COOKIE['password']!=""){echo trim($_COOKIE['password']);}?>"/>
                        	<i class="fa fa-key icons"></i>
                         </div>
                        <a href="javascript:void(0);" class="forgot_pass" id="send_pass">Forgot your password?</a>
                    </div>
                    <div class="form-group">
                        <div class="switch">
                            <input id="cmn-toggle-1" class="cmn-toggle cmn-toggle-round" type="checkbox" value="select" name="remember_me">
                            <label for="cmn-toggle-1"><i class="fa fa-times"></i><i class="fa fa-check"></i></label>
                            <span class="rembrme">Remenber me!</span>
                        </div>
                        <input type="hidden" value="login" name="action"/>
                        <input type="submit" value="Sign in" class="signin_btn" />
                    </div>
                    <span class="or_seprator"><span>OR</span></span>
                </form>
                <p class="content-text-outr">Not a registered user yet? &nbsp;&nbsp;<a href="javascript:void(0);" class="signuplink"> Sign up now!</a></p>
            </div>
            <div id="signupform" style="display:none;">
                <form id="sign_up">
                    <h5>Creat an account</h5>
                    <div class="form-group">
                    	<p class="text-center">Sign up with one click with LinkedIn, Facebook & Google+</p>
                        <a href="javascript:void(0);" class="socialbtn"><i class="fa fa-linkedin"></i> Sign up with LinkedIn</a>
                        <a href="javascript:void(0);" class="socialbtn FB_bg"><i class="fa fa-facebook"></i> Sign up with Facebook</a>
                        <a href="javascript:void(0);" class="socialbtn GPlus_bg" onClick="login()"><i class="fa fa-google-plus"></i> Sign up with Google+</a>
                        <p class="text-center">...or enter your email address and pick a password</p>
                    </div>
                    <div id="errors"></div>
                    <div class="form-group">
                    	<label class="lbl">Email address</label>
                        <div class="fields">
                        	<input type="text" class="form-control" placeholder="Enter you email here" name="email" id="email"/>
                        	<i class="fa fa-user icons"></i>
                        </div>
                    </div>
                    <div class="form-group">
                    	<label class="lbl">Password</label>
                         <div class="fields">
                        	<input type="password" class="form-control" placeholder="Enter password" name="password"  id="password"/>
                        	<i class="fa fa-key icons"></i>
                         </div>
                    </div>
                    <div class="form-group">
                    	<label class="lbl">Confirm Password</label>
                         <div class="fields">
                        	<input type="password" class="form-control" placeholder="Enter password" name="conf_password" id="conf_password"/>
                        	<i class="fa fa-key icons"></i>
                         </div>
                    </div>
                    <div class="form-group">
                    	<p class="trmtxt"><input type="checkbox" id="terms"/> I accept the <a href="javascript:void(0);">Terms & Conditions</a> and <a href="javascript:void(0);">Privacy Policy.</a></p>
                    </div>
                    <div class="form-group">
                    <input type="hidden" value="register" name="action"/>
                        <input type="submit" value="Sign Up" class="signin_btn" />
                    </div>
                    <span class="or_seprator"><span>OR</span></span>
                </form>
                <p class="content-text-outr">Already have an account?  &nbsp;&nbsp;<a href="javascript:void(0);" class="singinlink"> Login now!</a></p>
            </div>
            <div id="forgot_password" style="display:none;"><!-- FORGOT PASSWORD FORM -->
                <form id="get_password">
                    <h5>Forgot Password</h5>
                    <div id="message"></div>
                    <div class="form-group">
                    	<p>Enter your email address below and we'll send you instructions on how to change your password.</p>
                    </div>
                    <div class="form-group">
                    	<label class="lbl">Email address</label>
                        <div class="fields">
                        	<input type="text" class="form-control" placeholder="Enter you email here" name="email_address"/>
                        	<i class="fa fa-user icons"></i>
                        </div>
                    </div>
                    <div class="form-group">
                    <input type="hidden" name="action" value="send_password" />
                        <input type="submit" value="Send" class="signin_btn" style="width:100%;" />
                    </div>
                    <span class="or_seprator"><span>OR</span></span>
                </form>
                <p class="content-text-outr">Already have password?  &nbsp;&nbsp;<a href="javascript:void(0);" class="singinlink"> Login now!</a></p>
            </div><!-- FORGOT PASSWORD FORM -->
        </div>
      </div>
    </div>
  </div>
</div><!-- // LOGIN & SIGNUP MODAL // -->


<!-- // JQUERY AT BOTTOM // -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/jquery.lightSlider.js"></script>
<script src="js/jquery.datetimepicker.js"></script>
<script src="js/ion.rangeSlider.min.js" type="text/javascript"></script>
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
	
	$("body").on("click",".forgot_pass",function(){
		$('#loginform').css('display','none');
		$('#forgot_password').css('display','block');
		$('#signupform').css('display','none');
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
		$('#forgot_password').css('display','none');
		$('#loginform').css('display','block');
		$('#signupform').css('display','none');
	});
	$('.signuplink').click(function(){
		$('#forgot_password').css('display','none');
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
	// CUSTOME SELECT //
	$(".custom-select").each(function(){
		$(this).wrap("<span class='select-wrapper'></span>");
		$(this).after("<span class='holder'></span>");
	});
	$(".custom-select").change(function(){
		var selectedOption = $(this).find(":selected").text();
		$(this).next(".holder").text(selectedOption);
	}).trigger('change');
	// CALENDER //
	$('#datetimepicker3').datetimepicker({
		inline:true,
		timepicker:false,
	});
	
	$("#range_03").ionRangeSlider({
		type: "double",
		grid: false,
		min: 0,
		max: 500,
		from: 0,
		to: 500,
		prefix: "<i class='fa fa-usd'></i> ",
		onFinish: function (data) {
        console.log(data);
		$("#price_from").val(data.from);
		$("#price_to").val(data.to);
		
		var datastring = $("#form_search_expert").serialize();
		search_expert(datastring);
		
    },
	});
	
});

</script>
</body>
</html>
