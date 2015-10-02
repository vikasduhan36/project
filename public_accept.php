<?php 
	require_once('phpInclude/header.php');
	
	$session_id = $_GET['id'];
	$exp = '';
	if(!empty($_GET['exp']))
	{
		$exp = $_GET['exp'];
	}
	
$sq = " SELECT * FROM session_time WHERE session_id='".$session_id."' and session_time.user_id = '".$_SESSION['LoginUserId']."' and requested_by!='".$_SESSION['LoginUserId']."' and requested_to != '".$_SESSION['LoginUserId']."' ";

$app_query = mysql_query($sq);
$app_detail = mysql_fetch_assoc($app_query);
$is_app =  mysql_num_rows($app_query);

$sqr = " SELECT * FROM session_time WHERE session_id='".$session_id."'  and (requested_by='".$_SESSION['LoginUserId']."' OR requested_to = '".$_SESSION['LoginUserId']."') ";

$rq_query = mysql_query($sqr);
$req_detail = mysql_fetch_assoc($rq_query);
$is_req =  mysql_num_rows($rq_query);

$field = " sessions.*,u.fname,u.lname,u.profile_image, ";
$field .= " (select GROUP_CONCAT(datetime) FROM session_time WHERE "; 
$field .= " session_time.session_id=sessions.id ";

if($GLOBALS['is_expert'] == 1 && $is_req > 0)
{
	$field .= " and session_time.requested_to = '".$_SESSION['LoginUserId']."' ";
}

if(!empty($exp))
{
	$field .= " and session_time.user_id='".$exp."' ";
}
else
{
	$field .= " and session_time.user_id=sessions.user_id ";
}
$field .= " ) as time_request ";
$table = "sessions LEFT JOIN users as u ON(sessions.user_id=u.id) ";
$condition 	= "and sessions.id='".$session_id."' ";
$session_detail = getDetail($field,$table,$condition);
$userTimezone = getUserTimezone($_SESSION['LoginUserId']);



?>
<form id="form_accept_public">
<input type="hidden" name="exp_hired" value="<?php echo $exp;?>">
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

                            <div class="row">
                                <div class="col-xs-12">
								
								<?php
								$time_request = explode(",",$session_detail[0]['time_request']);
	if($GLOBALS['is_expert'] == '1' && $is_app >0 && $is_req == 0)
	{
	?>
		<a class="Acceptbtn bookme_btn apply_btn disable_button " href="javascript:void(0);">Applied</a>
		<?php
	}
	else if($GLOBALS['is_expert'] == '0'  && $is_req > 0)
	{
	?>
		<a class="Acceptbtn bookme_btn apply_btn disable_button " href="javascript:void(0);">Waiting for reply</a>
		<?php
	}
	else if($session_detail[0]['status'] == '1' )
	{							
		if(!empty($time_request[0]))
		{
			
					//&& $is_app == 0
								foreach($time_request as $req)
								{
									$request = convertTimezone($req,$default_tz,$userTimezone['timezone']);
									if(!empty($exp))
									{
										echo "<div><input type='checkbox' name='slot' value='".$request."'>".formatDate($request)."</div>";
									}
									else if($session_detail[0]['user_id'] != $_SESSION['LoginUserId'])
									{
										echo "<div><input type='checkbox' name='slot[]' value='".$request."'>".formatDate($request)."</div>";
									}
								}
								
				 
					?>		
					<a class="Acceptbtn bookme_btn apply_btn request_slot public <?php if(!empty($exp)){echo 'exp_hired';}?>" href="javascript:void(0);">Accept </a>
					<a class="Acceptbtn alternate_btn bookme_btn apply_btn" id="alternative_dates" href="javascript:void(0);">Request Alternative time</a>
					<?php
			}				
	}
								?>
								<section class="ChooseDatesCont" id="public_select_date" style="display:<?php if(empty($time_request[0])){echo 'block';}else{echo 'none';}?>;"><!-- CHOOSE DATE CONTAINER -->
                                <p><strong class="txt_lt_it">Select at least 1 (preferably 3) time slots that suit you.</strong><br/><small>(All times are in your selected timezone 
								"<?php
								$timezone = getUserTimezone($_SESSION['LoginUserId']);
								echo $timezone['name'];
								?>"
								)</small></p>
                                
                                <div class="row">
                                    <div class="col-xs-12 col-md-5">
                                        <label class="lbl">Choose Date</label>
										<!--
										<input type="text" name="date_schedule" id="date_schedule" readonly="readonly"  class="date_schedule" value=""/>
										-->
										<input type="hidden" name="date_schedule" id="hidden_date_schedule" value=""/>
										<div id="date_schedule"  class="date_schedule"></div>
										
								
								<input type="hidden" name="type" value="<?php if(empty($time_request[0])){echo 'request';}else{echo 'accept';}?>">
								<input type="hidden" name="action" value="submit_accept_public">
								<input type="hidden" name="session_id" value="<?php echo $session_id;?>">
								
								<input type="hidden" name="session_type" value="<?php echo $session_detail[0]['type'];?>">
								
								
								
									</div>
                                    <div class="col-xs-12 col-md-7">
                                        <label class="lbl">Choose Time</label>
                                        <div id="display_slot">
										
										</div>
										
                                    </div>
									
									<div class="col-xs-12 ">
									<div class="reschdl_grp"> 
									<?php
										if(!empty($time_request[0]))
										{
										?>
										<a href="javascript:void(0);" class="Acceptbtn sess_btn  date_schedule request_slot public" id="request_schedule" />Request Reschedule</a>
										<a href="javascript:void(0);" class="Acceptbtn sess_btn " id="alternative_dates_cancel" >Cancel</a>
										<?php
										}
										else
										{
										?>
										<a href="javascript:void(0);" class="Acceptbtn sess_btn  date_schedule request_slot public" id="request_schedule" />Request Time</a>
										<?php
										}
										?>
										</div>
									</div>
                                </div>
                                
                            </section><!-- CHOOSE DATE CONTAINER -->
                            
								

								
								
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
</form>


<?php
require_once('phpInclude/footer.php');
?>