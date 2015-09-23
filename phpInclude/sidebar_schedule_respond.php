
	<div class="sidebarnav sidebar2 requestsidebar"><!-- // SIDE BAR NAV // -->
                	<span class="dashbar clearfix">
                    	<i class="fa fa-info-circle"></i> Information
                        <a href="javascript:void(0);" class="togglebtn2 visible-xs" data-toggle="tooltip" title="Click me">
                        	<i class="fa fa-circle"></i><i class="fa fa-circle"></i><i class="fa fa-circle"></i>
                        </a>
                    </span>
                 	<div class="toggle_db"><!-- FOR TOGGLED DASHBOARD -->
                        <div class="sidebarfilter">
                            <ul>
                                <li>
                                    <h5>Requested by </h5>
                                    <span class="req_by">
                                    	<span class="imgblk">
										<img src="<?php echo (!empty($session_detail[0]['profile_image']))?$session_detail[0]['profile_image']:'images/users/default.jpg';?>" alt="user" />
										</span>
                                        <h6><?php echo $session_detail[0]['fname']." ".$session_detail[0]['lname'];?>
										<small>On: <?php 
										$datetime = convertTimezone($session_detail[0]['created'],$default_tz,$userTimezone['timezone']);
										echo $datetime;
										/*
										if(!empty(strtotime($session_detail[0]['session_datetime'])))
										{
										echo $session_detail[0]['session_datetime'];
										}
										else
										{
										foreach(explode(",",$session_detail[0]['time_request']) as $time)
										{
											echo "<br>".$time;
										}
										}
										*/
										?></small></h6>
                                    </span>
                                   
									
									
                                </li>
                                
                                    	
										<?php
										$field = " name ";
										$table = "languages ";
										$condition 	= "and id IN(".$session_detail[0]['language_id'].") ";
										$language_detail = getDetail($field,$table,$condition);
										if(!empty($language_detail))
										{
										?>
										<li>
                                    <h5>Languages</h5>
                                    <span class="lang">
										<?php
										foreach($language_detail as $language)
										{
											echo "<span>".$language['name']."</span>";
										}
										?>
										</span>
                                </li>
										<?php
										}
										?>
                                    
                               	<?php
										$field = " name ";
										$table = "categories ";
										$condition 	= "and id = '".$session_detail[0]['language_id']."' ";
										$category_detail = getDetail($field,$table,$condition);
										if(!empty($category_detail))
										{
										?>
										<li>
                                    <h5>Requested in</h5>
                                    <span class="req_in">
										<?php
										
											echo "<span>".$category_detail[0]['name']."</span>";
										
										?>
										</span>
                                </li>
										<?php
										}
										?>
										
										  	<?php
										$field = " name ";
										$table = "tags";
										$condition 	= "and id IN(".$session_detail[0]['tag_id'].") ";
										$tag_detail = getDetail($field,$table,$condition);
										if(!empty($tag_detail))
										{
										?>
										<li>
                                    <h5>Tagged As</h5>
                                    <span class="lang tagsused">
										<?php
										foreach($tag_detail as $tag)
										{
											echo "<span>".$tag['name']."</span>";
										}
										?>
										</span>
                                </li>
										<?php
										}
										?>
										
								<?php
								   if($session_detail[0]['status'] == '1' && $session_detail[0]['user_id'] == $_SESSION['LoginUserId'])
									{
										?><li>
											<a href="javascript:void(0);" class="apply_btn cancel_req_btn" id="cancel_session" alt="<?php echo $session_id;?>">Cancel</a>
										</li>
										<?php
									}
								   ?>
								
                            </ul>
                        </div>
                    </div><!-- FOR TOGGLED DASHBOARD -->
                </div><!-- // SIDE BAR NAV // -->