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
                            <li><a href="
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
                        </ul>					
                    </div><!-- FOR TOGGLED DASHBOARD -->
                </div><!-- // SIDE BAR NAV // -->