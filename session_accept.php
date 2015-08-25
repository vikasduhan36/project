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
<input type="hidden" id="exp_id" name="exp_id" value="<?php echo $_SESSION['LoginUserId'];?>">

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
                <div id="notification" style="display:none;"></div>
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
					<?php
				 if($session_detail[0]['status'] == '1' /*&& $session_detail[0]['user_id'] != $_SESSION['LoginUserId']*/)
				 {
					?>
                            <div class="row">
                                <div class="col-xs-12">
								
								<?php
								$userTimezone = getUserTimezone($_SESSION['LoginUserId']);
								$time_request = explode(",",$session_detail[0]['time_request']);
								foreach($time_request as $req)
								{
									$request = convertTimezone($req,$default_tz,$userTimezone['timezone']);
									echo "<div><input type='checkbox' name='slot' value='".$request."'>".$request."</div>";
								}
								?>
								
								<a class="bookme_btn apply_btn request_slot" href="javascript:void(0);">Accept </a>
								
								<br>
								
								<a class="bookme_btn apply_btn" id="alternative_dates" href="javascript:void(0);">Request Alternative time</a>
								
								<section class="ChooseDatesCont" id="public_select_date" style="display:none;"><!-- CHOOSE DATE CONTAINER -->
                                <p><strong class="txt_lt_it">Select at least 1 (preferably 3) time slots that suit you.</strong><br/><small>(All times are in your local timezone AsialKolkata)</small></p>
                                
                                <div class="row">
                                    <div class="col-xs-12 col-md-5">
                                        <label class="lbl">Choose Date</label>
										<!--
										<input type="text" name="date_schedule" id="date_schedule" readonly="readonly"  class="date_schedule" value=""/>
										-->
										<input type="hidden" name="date_schedule" id="hidden_date_schedule" value=""/>
										<div id="date_schedule"  class="date_schedule"></div>
										<a href="javascript:void(0);" class="sess_btn canceled_btn date_schedule request_slot" id="request_schedule" />Request Reschedule</a>
								<a href="javascript:void(0);" class="sess_btn canceled_btn" id="alternative_dates_cancel" >Cancel</a>
								<input type="hidden" name="type" value="accept">
								<input type="hidden" name="action" value="submit_accept_session">
								<input type="hidden" name="session_id" value="<?php echo $session_id;?>">
								
								<input type="hidden" name="session_type" value="<?php echo $session_detail[0]['type'];?>">
								
								
								
									</div>
                                    <div class="col-xs-12 col-md-7">
                                        <label class="lbl">Choose Time</label>
                                        <div id="display_slot">
										
										</div>
										
                                    </div>
								
                                </div>
                                
                            </section><!-- CHOOSE DATE CONTAINER -->
                            
								

								
								
								</div>
                            </div>
					<?php
					}
					?>
							
                        </div>
                    </section><!-- // STEP 1 // -->

                    </div><!-- // BROWSER EXPERTS MAIN // -->
                    
                </section><!-- // RIGHT MAIN // -->
            </div>
        </div>
    </div>
</section><!-- // MID MAIN SECTION // -->
</form>


<?php
require_once('phpInclude/footer.php');
?>