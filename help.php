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
            	<section class="right_main HelpCont"><!-- // RIGHT MAIN // -->
                    <ul class="breadcrumb">
                        <li><a href="javascript:void(0);">Home</a></li>
                        <li>Help</li>
                    </ul>
                    
                    <div class="helpdetailOtr">
                    	<h1>How can we help you?</h1>
                        <ul class="questionlist">
                        	<li>
                            	<div class="queotr">
                                	<a href="javascript:void(0);" class="quelink">What is eyeask?</a>
                                	<div class="ansblk"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer et tellus nec neque malesuada viverra. Morbi risus tellus, euismod et purus sed, consequat feugiat lorem. Pellentesque fermentum scelerisque nunc, vel volutpat lorem vulputate id. Nulla sit amet leo elit. In hendrerit id nunc non rhoncus. Vivamus quis nisl a diam vestibulum tincidunt. Donec nunc enim, semper quis scelerisque at, commodo vel justo. Nullam neque sem, fermentum rhoncus ultrices non, tempor sit amet ex.</p></div>
                                </div>
                            </li>
                            <li>
                            	<div class="queotr">
                                	<a href="javascript:void(0);" class="quelink">How eyeask works?</a>
                                	<div class="ansblk" style="display:none;"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer et tellus nec neque malesuada viverra. Morbi risus tellus, euismod et purus sed, consequat feugiat lorem. Pellentesque fermentum scelerisque nunc, vel volutpat lorem vulputate id. Nulla sit amet leo elit. In hendrerit id nunc non rhoncus. Vivamus quis nisl a diam vestibulum tincidunt. Donec nunc enim, semper quis scelerisque at, commodo vel justo. Nullam neque sem, fermentum rhoncus ultrices non, tempor sit amet ex.</p></div>
                                </div>
                            </li>
                            <li>
                            	<div class="queotr">
                                	<a href="javascript:void(0);" class="quelink">How i using session in eyeask?</a>
                                	<div class="ansblk" style="display:none;"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer et tellus nec neque malesuada viverra. Morbi risus tellus, euismod et purus sed, consequat feugiat lorem. Pellentesque fermentum scelerisque nunc, vel volutpat lorem vulputate id. Nulla sit amet leo elit. In hendrerit id nunc non rhoncus. Vivamus quis nisl a diam vestibulum tincidunt. Donec nunc enim, semper quis scelerisque at, commodo vel justo. Nullam neque sem, fermentum rhoncus ultrices non, tempor sit amet ex.</p></div>
                                </div>
                            </li>
                            <li>
                            	<div class="queotr">
                                	<a href="javascript:void(0);" class="quelink">How can we search experts?</a>
                                	<div class="ansblk" style="display:none;"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer et tellus nec neque malesuada viverra. Morbi risus tellus, euismod et purus sed, consequat feugiat lorem. Pellentesque fermentum scelerisque nunc, vel volutpat lorem vulputate id. Nulla sit amet leo elit. In hendrerit id nunc non rhoncus. Vivamus quis nisl a diam vestibulum tincidunt. Donec nunc enim, semper quis scelerisque at, commodo vel justo. Nullam neque sem, fermentum rhoncus ultrices non, tempor sit amet ex.</p></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    
                </section><!-- // RIGHT MAIN // -->
            </div>
        </div>
    </div>
</section><!-- // MID MAIN SECTION // -->
<script>
$(document).ready(function() {
// SIDEBAR TOGGLE IN 767px //
	$(".queotr .quelink").click(function(){
		$('body,html').find('.ansblk').slideUp('slow');
		if($(this).next('.ansblk').is(':visible')) {
			$(this).next('.ansblk').slideUp();
		}
		else {
			$(this).next('.ansblk').slideDown();
		}
	});
});
</script>	
<?php
require('phpInclude/footer.php');
?>