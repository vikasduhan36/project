<?php 
 ////// HEADER ////// 
require_once 'phpInclude/header.php';

$userTimezone = getUserTimezone($_SESSION['LoginUserId']);
$field = "`from`,`to`";
$table = "user_availability";
$condition = "and user_id = '".$_SESSION['LoginUserId']."'  "; //and `to` >='".$date."'
$get_avail = getDetail($field,$table,$condition);

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
				<div id="notification" style="display:none;"></div>
				<form id="form_add_avail">
	<!--
                        <ul class="breadcrumb">
                            <li><a href="javascript:void(0);">Home</a></li>
                            <li>Schedule Session</li>
                        </ul>
						-->
                        <h2 class="accountheading">Your availability</h2>
                        
                        <div class="schedulemain">
                            <p>Tip: You can add multiple available hours per day by clicking 'Add more available hours' below<br/><br/>
							<strong>Your timezone is set to "<?php echo $userTimezone['name'];?>"</strong><br/>
							</p>
                         	
                           
							
							
                            
                            <section class="ChooseDatesCont availability_outer" ><!-- CHOOSE DATE CONTAINER -->
                                
                            <?php
							
						if(count($get_avail)>0)
						{
							
							foreach($get_avail as $avail)
							{
								
								$from = convertTimezone(date("Y-m-d")." ".$avail['from'],$default_tz,$userTimezone['timezone']);
								$to = convertTimezone(date("Y-m-d")." ".$avail['to'],$default_tz,$userTimezone['timezone']);
								
							?>							
                                <div class="row availability_inner">
                                    <div class="col-xs-12 col-md-4">
                                        <label class="lbl">On</label>
										<!--
										<input type="text" name="date_avail[]" class="date_pick_icon form-control pre_select" readonly="readonly" value="<?php echo date('d-m-Y',strtotime($from));?>"/>
										-->
										<Select name="date_avail[]" class="form-control">
										<?php
										
										$change = 0;
										if(date("Y-m-d",strtotime($from)) < date("Y-m-d",strtotime(date("Y-m-d")." ".$avail['from'])))
										{
											$change = "-1";
										}
										else if(date("Y-m-d",strtotime($from)) > date("Y-m-d",strtotime(date("Y-m-d")." ".$avail['from'])))
										{
											$change = "+1";
										}
										//echo " || ".$date_val;
										$dayname = changeWeekday($date_val,$change);
										
										getWeekday($dayname);
										?>
										</select>
									</div>
                                    <div class="col-xs-12 col-md-3">
                                        <label class="lbl">Time from</label>
                                        
										<select name="timefrom[]" class="time_from form-control">
										<?php
										$availability = default_availability();
										foreach($availability as $avail)
										{
											echo "<option value='".$avail."' ";
											if($avail == date('H:i:s',strtotime($from)))
											{
												echo " selected='selected' ";
											}
											echo " >".date('h:i a',strtotime($avail))."</option>";
										}
										?>
										</select>
										</div>
								<div class="col-xs-12 col-md-3">
									<label class="lbl">Time to</label>
										<select name="timeto[]" class="time_to form-control">
										<?php
										$availability = default_availability();
										foreach($availability as $avail)
										{
											echo "<option value='".$avail."' ";
											if($avail == date('H:i:s',strtotime($to)))
											{
												echo " selected='selected' ";
											}
											echo " >".date('h:i a',strtotime($avail))."</option>";
										}
										?>
										</select>
										
										
										
                                    </div>
									<div class="col-xs-12 col-md-2">
									<label class="lbl">
									<a href="javascript:void(0);" class="remove_availability" title="Remove availability">
									X
									</a>
									</label>
									</div>
                                </div>
								<?php
							}
						}
						else
						{
						?>
								<div class="row availability_inner">
                                    <div class="col-xs-12 col-md-4">
                                        <label class="lbl">On</label>
										<Select name="date_avail[]" class="form-control">
									<?php
										getWeekday();
										?>
										</select>
									</div>
                                    <div class="col-xs-12 col-md-3">
                                        <label class="lbl">Time from</label>
                                        
										<select name="timefrom[]" class="time_from form-control">
										<?php
										$availability = default_availability();
										foreach($availability as $avail)
										{
											echo "<option value='".$avail."' ";
											if($avail == '09:00:00')
											{
												echo " selected='selected' ";
											}
											echo " >".date('h:i a',strtotime($avail))."</option>";
										}
										?>
										</select>
										</div>
								<div class="col-xs-12 col-md-3">
									<label class="lbl">Time to</label>
										<select name="timeto[]" class="time_to form-control">
										<?php
										$availability = default_availability();
										foreach($availability as $avail)
										{
											echo "<option value='".$avail."' ";
											if($avail == '17:00:00')
											{
												echo " selected='selected' ";
											}
											echo " >".date('h:i a',strtotime($avail))."</option>";
										}
										?>
										</select>
										
										
										
                                    </div>
									<div class="col-xs-12 col-md-2">
									<label class="lbl">
									<a href="javascript:void(0);" class="remove_availability" title="Remove availability">
									X
									</a>
									</label>
									</div>
                                </div>						
						<?php
						}						
						?>
                                
                            </section><!-- CHOOSE DATE CONTAINER -->
                            
                            <div class="row">
                                <div class="col-xs-6">
								<a href="javascript:void(0);" class="btn1 proceedbtn" id="add_more_avail">+Add more</a>
                                </div><div class="col-xs-6">
								<a href="javascript:void(0);" class="btn1 proceedbtn" id="submit_add_avail">Save <i class="fa fa-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
						<input type="hidden" name="action" value="submit_add_avail" >
					</form>
                </section><!-- // RIGHT MAIN // -->
            </div>
        </div>
    </div>
</section><!-- // MID MAIN SECTION // -->

<?php
require('phpInclude/footer.php');
?>