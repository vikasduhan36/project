	
</section><!--//// REQUEST SUCCESS PAGE SECTION ////-->




<!-- // JQUERY AT BOTTOM // -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<!-- custom scrollbar plugin -->
<script src="js/jquery.mCustomScrollbar.js"></script>
<script>
(function($){
	$(window).load(function(){
		
		$("#scrollbar").mCustomScrollbar({
			scrollInertia:350
		});
		
	});
})(jQuery);
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
	//-- Custom Scroll Bar --//
	$('.viewusrbtn').click(function(e){
		$('.SessionContMain').find('.SessionInner').toggleClass('opened_userlist');
		$('.SessionContMain').find('.OtherUserList').toggleClass('userlist_opened');
	});
	$('.OtherUserList .closebtn').click(function(e){
		$('.SessionContMain').find('.SessionInner').toggleClass('opened_userlist');
		$('.SessionContMain').find('.OtherUserList').toggleClass('userlist_opened');
	});
});
</script>
</body>
</html>
