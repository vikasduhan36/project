<?php 
require_once('phpInclude/header.php');
	
$session_id = $_GET['id'];
$field = " sessions.*,u.exp_rate,u.fname,u.lname,u.profile_image, (select GROUP_CONCAT(datetime) FROM session_time WHERE session_time.session_id=sessions.id) as time_request ";
$table = "sessions LEFT JOIN users as u ON(sessions.user_id=u.id) ";
$condition 	= "and sessions.id='".$session_id."' ";
$session_detail = getDetail($field,$table,$condition);
$userTimezone = getUserTimezone($_SESSION['LoginUserId']);

$field = " u.id,u.exp_about,u.exp_rate,u.fname,u.lname,u.profile_image,u.language_id ";
$table = "session_time as st LEFT JOIN users as u ON(st.user_id=u.id) ";
$condition 	= "and st.session_id='".$session_id."' and st.user_id NOT IN('".$_SESSION['LoginUserId']."','".$session_detail[0]['user_id']."') GROUP BY st.user_id ";
$applied_detail = getDetail($field,$table,$condition);


?>
<form id="form_accept_session">

<section class="midsection accountsection"><!-- // MID MAIN SECTION // -->
	<div class="container">
    	<div class="row">
        	<div class="col-xs-12 col-sm-4 col-md-3">
           <?php
		   require_once('phpInclude/sidebar_schedule_respond.php');
		   ?>
            </div>
            
            <div class="col-xs-12 col-sm-8 col-md-9">
            	<section class="right_main"><!-- // RIGHT MAIN // -->
                
                	  	<div class="browsemain" ><!-- // BROWSER EXPERTS MAIN // -->
    
                    <section id="step2" class="Req_sections req_step2" style="display:block;"><!-- // STEP 2 // -->
                        <h2><?php echo $session_detail[0]['title'];?>
						<!--
						<a href="javascript:void(0);" class="editlink"><i class="fa fa-edit"></i> Edit</a>
						-->
						</h2>  
                        <div class="schedulemain">
                        	<div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-3 col-xss-4">
                                    <?php
									
									?>
									<span class="rply_req text-center">
									Request <?php echo count($applied_detail);?> reply
									</span>
									<?php
									
									?>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-9 col-xss-8">
                                	<p>You have to reply to your public profile. <br>You can review the replies and pick an expert below.</p>
                                </div>
                                
                                <div class="col-xs-12">
                                	<p><strong>
									<?php echo $session_detail[0]['description'];?>
									</strong></p>
                                    
                                    <div class="listcont browserreqlist Proposal_list"><!-- // PROPOSAL LIST // -->
                                       
									   <?php
									   foreach($applied_detail as $applied)
									   {
									   ?>
									   <div class="row">
                                            <div class="col-xs-12 col-sm-9"> 
                                                <div class="expertinforow">
                                                    <span class="expertimg"><img class="img-responsive" alt="expert1" src="
													
													<?php echo (!empty($applied['profile_image']))?$applied['profile_image']:'images/users/default.jpg';?>
													"></span>
                                                    <h4><a href="javascript:void(0);"><?php echo $applied['fname']." ".$applied['lname'];?></a></h4>
                                                    <ul class="MrgT0">
                                                        <li><i class="fa fa-dollar"></i> <span><?php echo (!empty($applied['exp_rate']))?$applied['exp_rate']:'Free';?></span></li>
                                                        <li><i class="fa fa-globe"></i> <?php 
														 //$applied['language_id'];
														$field = " GROUP_CONCAT(name) as name ";
														$table = "languages";
														$condition 	= " and id IN(".$applied['language_id'].") ";
														$languages = getDetail($field,$table,$condition);
														echo $languages[0]['name'];
														?></li>
                                                    </ul>
                                                    <p><?php echo $applied['exp_about'];?></p>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-3">
                                            	<a class="wishlistbtn details_btn" href="javascript:void(0);">Full Profile</a>
                                            </div>
                                            <div class="col-xs-12">
											<!--
                                            	<ul class="messagelist">
                                                	<li><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris condimentum consequat feugiat. <span>Aug 16, 15:10</span> </p></li>
                                                    <li><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris condimentum consequat feugiat.<span>Aug 16, 15:10</span></p></li>
                                                </ul>
											-->	
											<?php
											if($session_detail[0]['status'] == '2' && $session_detail[0]['exp_applied_id'] == $applied['id'])
											{
											?>
                                            	<a class="bookme_btn apply_btn" href="javascript:void(0);">Booked </a>
											<?php
											}
											else if($session_detail[0]['status'] == '1')
											{
												?>
												<a class="bookme_btn apply_btn" href="<?php echo $root.'public_accept.php?id='.$session_id.'&exp='.$applied['id'];?>">Accept </a>
												<?php
											}
											?>
											 <!--
												<a class="wishlistbtn details_btn" href="javascript:void(0);">Send Message</a>
												-->
                                            </div>
                                        </div>
										<?php
									   }
									   ?>
										
                                    </div><!-- // PROPOSAL LIST // -->
                                    
                                </div>
                            </div>
                        </div>
                    </section><!-- // STEP 2 // -->
                        
                    </div><!-- // BROWSER EXPERTS MAIN // -->
                    
                </section><!-- // RIGHT MAIN // -->
            </div>
        </div>
    </div>
</section><!-- // MID MAIN SECTION // -->



<?php
require_once('phpInclude/footer.php');
?>