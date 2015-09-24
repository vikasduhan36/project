<?php 
	require_once('phpInclude/header.php');
	
	$session_id = $_GET['id'];
$field = " sessions.*,u.fname,u.lname,u.profile_image, (select GROUP_CONCAT(datetime) FROM session_time WHERE session_time.session_id=sessions.id) as time_request ";
$table = "sessions LEFT JOIN users as u ON(sessions.user_id=u.id) ";
$condition 	= "and sessions.id='".$session_id."' ";
$session_detail = getDetail($field,$table,$condition);
$userTimezone = getUserTimezone($_SESSION['LoginUserId']);

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
                    
                    <section id="step1" class="Req_sections req_step1" style="display:block;"><!-- // STEP 1 // -->
                    	<h2><?php echo $session_detail[0]['title'];?></h2>  
                        <div class="schedulemain">
                        	<p><strong><?php echo $session_detail[0]['description'];?></strong></p>
                            <div class="confirmdetail">
                            	<h4>Specific Questions</h4>
                                <p><?php echo (!empty($session_detail[0]['title']))?$session_detail[0]['title']:"--";?></p>
                            </div>
                            
                            <div class="confirmdetail">
                            	<h4>Other</h4>
                                <p><?php echo (!empty($session_detail[0]['other']))?$session_detail[0]['other']:"--";?></p>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
								<?php
								if($session_detail[0]['status'] == '0')
								{
									?>
										
										<a href="javascript:void(0);" class="sess_btn canceled_btn  Acceptbtn disable_button">Canceled</a>
									<?php
								}
								else if($session_detail[0]['type'] == 'schedule' && $session_detail[0]['exp_applied_id'] == $_SESSION['LoginUserId'])
								{
									if($session_detail[0]['status'] == '2')
									{
										?>
										<a href="javascript:void(0);" class="sess_btn  Acceptbtn disable_button">Scheduled</a>
										<?php
									}
									else if($session_detail[0]['exp_reschedule'] == '1')
									{
										?>
										
										<a href="javascript:void(0);" class="sess_btn waitbtn  Acceptbtn disable_button">Waiting for reply</a>
										<?php
									}
									else if($session_detail[0]['exp_reschedule'] == '0' && $session_detail[0]['user_reschedule'] == '1' )
									{
										?>
										
										<a href="<?php echo $root.'session_accept.php?id='.$session_id;?>" class="btn1 proceedbtn  Acceptbtn">Accept Reschedule<i class="fa fa-angle-double-right"></i></a>
										<?php
									}
									else 
									{
										?>
										
										<a href="<?php echo $root.'session_accept.php?id='.$session_id;?>" class="btn1 proceedbtn  Acceptbtn ">Accept<i class="fa fa-angle-double-right"></i></a>
										<?php
									}
								}
								else if($session_detail[0]['type'] == 'schedule' && $session_detail[0]['user_id'] == $_SESSION['LoginUserId'])
								{
									if($session_detail[0]['status'] == '2')
									{
										?>
										
										<a href="javascript:void(0);" class="sess_btn Acceptbtn disable_button">Scheduled</a>
										<?php
									}
									else if($session_detail[0]['exp_reschedule'] == '0')
									{
										?>
										<a href="javascript:void(0);" class="sess_btn waitbtn  Acceptbtn disable_button">Waiting for reply</a>
										<?php
									}
									else if($session_detail[0]['exp_reschedule'] == '1')
									{
										?>
										<a href="<?php echo $root.'session_accept.php?id='.$session_id;?>" class="btn1 proceedbtn  Acceptbtn">Accept Reschedule<i class="fa fa-angle-double-right"></i></a>	
										<?php
									}
								}
								?>
                                    <!--
                                    <p>Are you interested <br/>in this public request?</p>
									-->
                                </div>
                            </div>
                        </div>
                    </section><!-- // STEP 1 // -->

                    </div><!-- // BROWSER EXPERTS MAIN // -->
                    
                </section><!-- // RIGHT MAIN // -->
            </div>
        </div>
    </div>
</section><!-- // MID MAIN SECTION // -->



<?php
require_once('phpInclude/footer.php');
?>