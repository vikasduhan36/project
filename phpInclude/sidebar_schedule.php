<div class="sidebarnav"><!-- // SIDE BAR NAV // -->
                	<span class="dashbar clearfix">
                    	You're about to book 
							<h4><?php echo $exp_detail[0]['fname']." ".$exp_detail[0]['lname'];?></h4>
						as your expert.
                        <a href="javascript:void(0);" class="togglebtn2 visible-xs" data-toggle="tooltip" title="Click me">
                        	<i class="fa fa-circle"></i><i class="fa fa-circle"></i><i class="fa fa-circle"></i>
                        </a>
                    </span>
                    <div class="toggle_db"><!-- FOR TOGGLED DASHBOARD -->
                        <div class="accountimgblk">
                            <span class="imgcont">
							<img src="<?php echo (!empty($exp_detail[0]['profile_image']))?$exp_detail[0]['profile_image']:'images/users/default.jpg';?>" alt="user" class="responsiveimg" /></span>
                        </div>
                        <a href="#" class="back_exprt_pro_btn">Back to expert profile</a>				
                    </div><!-- FOR TOGGLED DASHBOARD -->
                </div><!-- // SIDE BAR NAV // -->