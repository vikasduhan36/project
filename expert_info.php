<?php 
 ////// HEADER ////// 
require_once 'phpInclude/header.php';
//print_r($user_detail);
if(isset($user_detail[0]['is_expert']) && $user_detail[0]['is_expert']=="1"){
	$short_description     	= trim($user_detail[0]['exp_description']);
	$help_offered   		= trim($user_detail[0]['exp_help']);
	$category  				= trim($user_detail[0]['exp_category_id']);
	$hourly_rate			= trim($user_detail[0]['exp_rate']);
	$profile_url  			= trim($user_detail[0]['username']);
	if ($user_detail[0]['exp_tag_id']!="") {
		$exp_tag_id   			= trim($user_detail[0]['exp_tag_id']);
		$diff_lang=array();
		$lang_detail = mysql_query("SELECT * from tags WHERE id IN($exp_tag_id)");
		while($res = mysql_fetch_assoc($lang_detail)){
			$diff_tags[]=$res['name'];
		}
		$exp_tag_id = implode(',',$diff_tags);
	} else {
		$exp_tag_id = "";
	}
} 
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
                        <li>Expert</li>
                    </ul>
                    <h2 class="accountheading"><small>Become an</small> expert</h2>
                    <div id="errors"></div>
                    <div class="myaccountinfo"><!-- // MY ACCOUNT INFORMATION // -->
                        <div class="infoblks clearfix"><!-- Account information -->
                        	<h4>Expert Detail</h4>
                        	<form id="expert_info">
                        	<ul class="row infolist">
                            	<li>
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Short description</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<span class="value"><?php if(isset($user_detail[0]['is_expert']) && $user_detail[0]['is_expert']=="1"){echo $short_description;}?></span>
                                        <textarea class="form-control valuefield" placeholder="Short Description" style="display:none;" name="short_description"><?php if(isset($user_detail[0]['is_expert']) && $user_detail[0]['is_expert']=="1"){echo $short_description;}?></textarea>
                                    </div>
                                    <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-edit"></i> Edit</a>
                                    </div>
                                </li>
                                <li>
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>How you can help out</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<span class="value"><?php if(isset($user_detail[0]['is_expert']) && $user_detail[0]['is_expert']=="1"){echo $help_offered;}?></span>
                                        <textarea class="form-control valuefield" name="help_offered" placeholder="Shortly describe the services or help your offering on 24sessions. For example: Book a session with me to receive advice on..." style="display:none;"><?php if(isset($user_detail[0]['is_expert']) && $user_detail[0]['is_expert']=="1"){echo $help_offered;}?></textarea>
                                    </div>
                                    <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-edit"></i> Edit</a>
                                    </div>
                                </li>
                                <li>
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Area of expertise</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<span class="value" id="categ_span">-</span>
                                        <select class="form-control valuefield" style="display:none;" name="category" id="category">
                                        	<option value="">Select Category</option>
                                        <?php 
                                        $cond = " ";
                                        $field=" * ";
                                        $table=" categories ";
                                        $timezone = getDetail($field,$table,$cond);
                                        foreach ($timezone as $key=>$value){
                                        	if(trim($value['id'])== trim($category)){
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
                                <li>
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Expertise tags</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<span class="value"><?php if(isset($user_detail[0]['is_expert']) && $user_detail[0]['is_expert']=="1"){echo $exp_tag_id;}?></span>
                                        <input type="text" id="tags" name="tags" value="<?php if(isset($user_detail[0]['is_expert']) && $user_detail[0]['is_expert']=="1"){echo $exp_tag_id;}?>" Placeholder="Choose up to 10 areas of expertise that you have" class="form-control valuefield" style="display:none;" />
                                    </div>
                                    <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-edit"></i> Edit</a>
                                    </div>
                                </li>
                                <li>
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Hourly rate</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<span class="value"><?php if( $user_detail[0]['is_expert']=="1" && $hourly_rate!="0"){echo $hourly_rate;}else {echo "Free";}?></span>
                                        <div style="display:none;">
                                            <div class="h_rate"><input type="radio" name="rate" value="free" <?php if($user_detail[0]['is_expert']=="1" && $hourly_rate =="0"){echo 'checked="checked"';}?> /> Free</div>
                                            <div class="h_rate"><input type="radio" name="rate" value="rate" <?php if($user_detail[0]['is_expert']=="1" && $hourly_rate !="0"){echo 'checked="checked"';}?>/> 
                                            <input type="text" class="form-control valuefield" style="width:100px;" name="hourly_rate" value="<?php if(isset($user_detail[0]['is_expert']) && $user_detail[0]['is_expert']=="1"){echo $hourly_rate;}else {echo "0";}?>"/> <i class="fa fa-eur"></i>/hour</div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-edit"></i> Edit</a>
                                    </div>
                                </li>
                                <li>
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Profile URL</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<span class="value"><?php if(isset($user_detail[0]['is_expert']) && $user_detail[0]['is_expert']=="1"){echo $profile_url;}?></span>
                                        <input type="text" value="24sessions.com/vikasduhan" name="profile_url" class="form-control valuefield" style="display:none;" value="<?php if(isset($user_detail[0]['is_expert']) && $user_detail[0]['is_expert']=="1"){echo $profile_url;}?>"/>
                                    </div>
                                    <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-edit"></i> Edit</a>
                                    </div>
                                </li>
                            </ul>
                            <!-- <a href="javascript:void(0);" class="submitbtn btn1">Proceed <i class="fa fa-angle-double-right"></i></a> -->
                             <input type="hidden" value="expert_info" name="action"/>
                        	<input type="submit" value="Proceed" class="submitbtn btn1" />
                            </form>
                        </div><!-- Account information -->
                        
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





<!-- // JQUERY AT BOTTOM // -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/jquery.lightSlider.js"></script> 
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
	$('.editlink').click(function(){
		$(this).text('Submit');
		$(this).parents('li').find('input,select,textarea,div').show();
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
 
    $( "#tags" )
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
            tags: extractLast( request.term )
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
    var selected_categ = $('#category').val();
    $('#categ_span').text($("#category option[value='"+selected_categ+"']").text());
});
</script>
</body>
</html>
