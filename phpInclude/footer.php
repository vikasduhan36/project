
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


<!-- // JQUERY AT BOTTOM // -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/jquery.lightSlider.js"></script>
<script src="js/jquery.datetimepicker.js"></script>
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
});

</script>
</body>
</html>
