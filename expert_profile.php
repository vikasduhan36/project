<?php 
 ////// HEADER ////// 
require_once 'phpInclude/header.php';
//print_r($user_detail);
/* echo "<pre>";
	print_r($_GET);
	die; */
if (isset($_GET['id']) && $_GET['id']!=""){
$field = " * ";
$table = " users ";
$condition = " AND profile_url='".trim($_GET['id'])."' ";
$user_detail = getDetail($field,$table,$condition);
	$short_description     	= trim($user_detail[0]['exp_description']);
	$help_offered   		= trim($user_detail[0]['exp_help']);
	$category  				= trim($user_detail[0]['exp_category_id']);
	$hourly_rate			= trim($user_detail[0]['exp_rate']);
	$profile_url  			= trim($user_detail[0]['profile_url']);
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
                            <!-- <span class="uploadimgotr">
                                <input type="file"  name="photoimg" id="photoimg" />
                                <span><i class="fa fa-camera"></i> Upload Image</span>
                            </span> -->
                        </div>
                        </form>
                         <?php 
                            $count=0;
                            //print_r($user_detail[0]);
                            foreach($user_detail[0] as $key => $value){//echo $key;
                           	if($value!=""){
                            	 $count+=5;
                            	}
                            } $count=$count-30;
                             ?>
							 <!--
                        <div class="accountprogress">
                            <h6 class="progresstxt">Profile completeness: <span><?php echo trim($count);?>%</span></h6>
                            <div class="progress">
                           
                            	<div class="progress-bar progress-bar-striped active progress-bar-info" role="progressbar" aria-valuenow="<?php echo trim($count);?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo trim($count);?>%">
                                <span class="sr-only"></span>
                              </div>
                            </div>
                        </div>
						-->
                        <ul class="navlist">
                            <li><a href="<?php echo $root.'account.php';?>" class="<?php if($pagename=='account.php'){echo 'active';}?>"><i class="fa fa-caret-right"></i> My Account</a></li>
                            <?php /*<li><a href="
							<?php
							if($GLOBALS['is_expert'] == '1')
							{
								echo $root.'exp_sessions.php';	
							}
							else
							{
								echo $root.'user_sessions.php';	
							}
							?>" class="<?php if($pagename=='exp_sessions.php' || $pagename=='user_sessions.php'){echo 'active';}?>"><i class="fa fa-caret-right"></i> My Sessions</a></li>
                            <li><a href="<?php echo $root.'wishlist.php';?>" class="<?php if($pagename=='wishlist.php'){echo 'active';}?>"><i class="fa fa-caret-right"></i> Expert Wishlist</a></li>
							<?php
							if($GLOBALS['is_expert'] == 1)
							{
							?>
							<li><a href="<?php echo $root.'expert_info.php';?>" class="<?php if($pagename=='expert_info.php'){echo 'active';}?>"><i class="fa fa-caret-right"></i>Expert Profile</a></li>
							<li><a href="<?php echo $root.'exp_availability.php';?>" class="<?php if($pagename=='exp_availability.php'){echo 'active';}?>"><i class="fa fa-caret-right"></i> Expert Availability</a></li>
                            <?php
							}
							?>
							<li><a href="<?php echo $root.'finance.php';?>" class="<?php if($pagename=='finance.php'){echo 'active';}?>"><i class="fa fa-caret-right"></i> Finance</a></li>
                            <li><a href="<?php echo $root.'help.php';?>" class="<?php if($pagename=='help.php'){echo 'active';}?>"><i class="fa fa-caret-right"></i> Help</a></li>
                            */?>
                        </ul>					
                    </div><!-- FOR TOGGLED DASHBOARD -->
                </div><!-- // SIDE BAR NAV // -->
            </div>
            
            <div class="col-xs-12 col-sm-8 col-md-9">
            	<section class="right_main"><!-- // RIGHT MAIN // -->
                    <ul class="breadcrumb">
                        <li><a href="javascript:void(0);">Home</a></li>
                        <li>Expert</li>
                    </ul>
                    <!-- <h2 class="accountheading"><small>Become an</small> expert</h2> -->
                    <div id="errors"></div>
                    <div class="myaccountinfo"><!-- // MY ACCOUNT INFORMATION // -->
                        <div class="infoblks clearfix"><!-- Account information -->
                        	<h4>Short Description</h4>
                        	<form id="expert_info">
                        	<ul class="row infolist">
                            	<li>
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label><?php if(isset($user_detail[0]['is_expert']) && $user_detail[0]['is_expert']=="1"){echo $short_description;}?></label></div>
                                   <?php /* <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<span class="value"><?php if(isset($user_detail[0]['is_expert']) && $user_detail[0]['is_expert']=="1"){echo $short_description;}?></span>
                                        <textarea class="form-control valuefield" placeholder="Short Description" style="display:none;" name="short_description"><?php if(isset($user_detail[0]['is_expert']) && $user_detail[0]['is_expert']=="1"){echo $short_description;}?></textarea>
                                    </div>
                                    <!-- <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-edit"></i> Edit</a>
                                    </div> -->
                                </li>
                                <li>
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>How you can help out</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<span class="value"><?php if(isset($user_detail[0]['is_expert']) && $user_detail[0]['is_expert']=="1"){echo $help_offered;}?></span>
                                        <textarea class="form-control valuefield" name="help_offered" placeholder="Shortly describe the services or help your offering on 24sessions. For example: Book a session with me to receive advice on..." style="display:none;"><?php if(isset($user_detail[0]['is_expert']) && $user_detail[0]['is_expert']=="1"){echo $help_offered;}?></textarea>
                                    </div>
                                   <!--  <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-edit"></i> Edit</a>
                                    </div> -->
                                </li>
                                <li>
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Area of expertise</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<span class="value" id="categ_span">-</span>
                                        <select class="form-control valuefield" style="display:none;" name="category" id="category1">
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
                                    <!-- <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-edit"></i> Edit</a>
                                    </div> -->
                                </li>
                                <li>
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Expertise tags</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<span class="value"><?php if(isset($user_detail[0]['is_expert']) && $user_detail[0]['is_expert']=="1"){echo $exp_tag_id;}?></span>
                                        <input type="text" id="tags" name="tags" value="<?php if(isset($user_detail[0]['is_expert']) && $user_detail[0]['is_expert']=="1"){echo $exp_tag_id;}?>" Placeholder="Choose up to 10 areas of expertise that you have" class="form-control valuefield" style="display:none;" />
                                    </div>
                                    <!-- <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-edit"></i> Edit</a>
                                    </div> -->
                                </li>
                                <li>
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Hourly rate</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<span class="value"><?php if( $user_detail[0]['is_expert']=="1" && $hourly_rate!="0"){echo $hourly_rate;}else {echo "Free";}?></span>
                                        <div style="display:none;">
                                            <div class="h_rate"><input type="radio" name="rate" value="free" <?php if($user_detail[0]['is_expert']=="1" && $hourly_rate =="0"){echo 'checked="checked"';}?> /> Free</div>
                                            <div class="h_rate"><input type="radio" name="rate" value="rate" <?php if($user_detail[0]['is_expert']=="1" && $hourly_rate !="0"){echo 'checked="checked"';}?>/> 
                                            <input type="text" class="form-control valuefield" style="width:100px;" name="hourly_rate" value="<?php if(isset($user_detail[0]['is_expert']) && $user_detail[0]['is_expert']=="1"){echo $hourly_rate;}else {echo "0";}?>"/> <i class="fa fa-usd"></i>/hour</div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-edit"></i> Edit</a>
                                    </div> -->
                                </li>
                                <li>
                                	<div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Profile URL</label></div>
                                    <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                    	<span class="value"><?php echo $root;?><?php if(isset($user_detail[0]['is_expert']) && $user_detail[0]['is_expert']=="1"){echo $profile_url;}?></span>
                                        <input type="text" value="<?php if(isset($user_detail[0]['is_expert']) && $user_detail[0]['is_expert']=="1"){echo $profile_url;}?>" name="profile_url" class="form-control valuefield" style="display:none;" />
                                    </div>
                                    <!-- <div class="col-xs-12 col-xss-2 col-sm-2">
                                    	<a href="javascript:void(0);" class="editlink"><i class="fa fa-edit"></i> Edit</a>
                                    </div> -->
                                </li>*/?>
                            </ul>
                            <!-- <a href="javascript:void(0);" class="submitbtn btn1">Proceed <i class="fa fa-angle-double-right"></i></a> -->
                             <input type="hidden" value="expert_info" name="action"/>
                        	<!-- <button type="submit" class="submitbtn btn1">Submit <i class="fa fa-check"></i></button> -->
							<!--
							<input type="submit" value="Proceed" class="submitbtn btn1" />
							-->
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
		
		if($(this).text() == 'cancel')
		{
			$(this).html('<i class="fa fa-edit"></i>Edit');
			$(this).parents('li').find('input,select,textarea').hide();
			$(this).parents('li').find('span').show();
		
		}
		else
		{
			$(this).text('cancel');
			$(this).parents('li').find('input,select,textarea,div').show().focus();
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
    var selected_categ = $('#category1').val();
    $('#categ_span').text($("#category1 option[value='"+selected_categ+"']").text());
});
</script>
</body>
</html>
