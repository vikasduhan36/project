<?php 
 ////// HEADER ////// 
require_once 'phpInclude/header.php';
$userTimezone = getUserTimezone($_SESSION['LoginUserId']);
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
                    <ul class="breadcrumb">
                        <li><a href="javascript:void(0);">Home</a></li>
                        <li>My Sessions</li>
                    </ul>
                    <h2 class="accountheading"><small>My</small>Sessions</h2>
                    
                    <div class="MysessionCont">
                    	<ul class="session_tabs ">
                        	<li><a href="<?php echo $root;?>exp_sessions.php?tab=schedule" class="<?php if(empty($_GET['tab']) || (isset($_GET['tab']) && $_GET['tab'] == 'schedule')){echo 'active';}?>">Scheduled</a></li>
                            <li><a href="<?php echo $root;?>exp_sessions.php?tab=open" class="<?php if(isset($_GET['tab']) && $_GET['tab'] == 'open'){echo 'active';}?>">Open</a></li>
                            <li><a href="<?php echo $root;?>exp_sessions.php?tab=close" class="<?php if(isset($_GET['tab']) && $_GET['tab'] == 'close'){echo 'active';}?>">Inactive</a></li>
                        </ul>
                        
                        <ul class="session_list">
						<?php 
						if(empty($_GET['tab']) || (isset($_GET['tab']) && $_GET['tab'] == 'schedule'))
						{
							$sql = " SELECT s.id as s_id,s.title,s.session_datetime, s.status,s.duration, u.fname,u.lname FROM sessions as s LEFT JOIN users as u ";
							$sql .= " ON(s.user_id = u.id) WHERE exp_applied_id='".$_SESSION['LoginUserId']."' ";// and s.status='2'

							$query = mysql_query($sql) or die(mysql_error());
							
							
							if($query)
							{
								if(mysql_num_rows($query) > 0)
								{
									echo "<a href='".$root."exp_live.php'>Go to Session screen</a>";
									while($fetch = mysql_fetch_assoc($query))
									{
									?>
									<li>
									<div class="row">
										<div class="col-xs-12 col-sm-2 col-xss-2"><h5>
										<?php 
										$datetime = convertTimezone($fetch['session_datetime'],$default_tz,$userTimezone['timezone']);
										echo $datetime;
										?></h5></div>
										<div class="col-xs-12 col-sm-7 col-xss-10"><h3>
										<a href="<?php echo $root.'session_request.php?id='.$fetch['s_id'];?>">
										<?php echo $fetch['title'];?>
										</a>
										<span>User: <?php $fetch['fname']." ".$fetch['lname'];?></span></h3></div>
										<div class="col-xs-12 col-sm-3 date">
										
										<?php
										if($fetch['status'] == '3')
										{
											echo '<a href="javascript:void(0);" class="sess_btn">Completed</a>';
										}
										else if(strtotime($date) > strtotime($fetch['session_datetime']."+".$fetch['duration']." MINUTES "))
										{
											echo '<a href="javascript:void(0);" class="sess_btn">Missed</a>';
										}
										else
										{
											echo '<a href="javascript:void(0);" class="sess_btn">Scheduled</a>';
										}
										//echo date("Y-m-d H:i:s",strtotime($fetch['session_datetime']."+".$fetch['duration']." MINUTES "));
										?>
										
										
										</div>
									</div>
									</li>
									
									<?php
									}
								}
								else
								{
								?>
								<li>
									<div class="row">
										
										<div class="col-xs-12 col-sm-7 col-xss-10"><h3>
										No sessions found.
										</h3></div>
										
									</div>
									</li>
								<?php
								}
							}
						}
						else if(isset($_GET['tab']) && $_GET['tab'] == 'open')
						{
							$sql = " SELECT s.type,s.exp_applied_id,s.id as s_id,s.exp_reschedule,s.user_reschedule,s.title,s.session_datetime,u.fname,u.lname ";
							$sql .= " FROM session_time as st LEFT JOIN sessions as s ON(st.session_id = s.id) ";
							$sql .= " LEFT JOIN users as u ON(s.user_id = u.id) ";
							$sql .= " WHERE ((st.user_id='".$_SESSION['LoginUserId']."' and s.exp_applied_id='0') or (s.exp_applied_id='".$_SESSION['LoginUserId']."')) and s.status='1' group BY st.session_id ";

							$query = mysql_query($sql) or die(mysql_error());
							
							
							if($query)
							{
								if(mysql_num_rows($query) > 0)
								{
									
									while($fetch = mysql_fetch_assoc($query))
									{
										if($fetch['type'] == 'request')
										{
											$url = "public_request.php";
										}
										else
										{
											$url = "session_request.php";
										}
									?>
									<li>
									<div class="row">
		
									<div class="col-xs-12 col-sm-2 col-xss-2"><h5>--</h5></div>
								
										<div class="col-xs-12 col-sm-7 col-xss-10"><h3>
										<a href="<?php echo $root.'session_request.php?id='.$fetch['s_id'];?>">
										<?php echo $fetch['title'];?>
										</a>
										<span>Expert: <?php $fetch['fname']." ".$fetch['lname'];?></span></h3></div>
										<div class="col-xs-12 col-sm-3 date">
										
										<?php
										if($fetch['exp_applied_id'] == 0)
										{
											
											echo '<a href="javascript:void(0);" class="sess_btn waitbtn">Waiting for reply</a>';
										}
										else if($fetch['exp_reschedule'] == 1)
										{
											echo '<a href="javascript:void(0);" class="sess_btn waitbtn">Waiting for reply</a>';
										}
										else if($fetch['user_reschedule'] == 1)
										{
											echo "<a href='".$root.$url."?id=".$fetch['s_id']."' class='sess_btn'>Reshcedule Request</a>";
											
										}
										else if($fetch['exp_reschedule'] == 0 && $fetch['user_reschedule'] == 0)
										{
											echo "<a href='".$root."session_request.php?id=".$fetch['s_id']."' class='sess_btn'>Booking Request</a>";
										}
										?>
										
										</div>
									</div>
									</li>
									
									<?php
									}
								}
								else
								{
								?>
								<li>
									<div class="row">
										
										<div class="col-xs-12 col-sm-7 col-xss-10"><h3>
										No sessions found.
										</h3></div>
										
									</div>
									</li>
								<?php
								}
							}
						}
						else if(isset($_GET['tab']) && $_GET['tab'] == 'close')
						{
							$sql = " SELECT s.id as s_id,s.title,s.session_datetime,u.fname,u.lname FROM sessions as s LEFT JOIN users as u ";
							$sql .= " ON(s.user_id = u.id) WHERE exp_applied_id='".$_SESSION['LoginUserId']."' and s.status='0' ";

							$query = mysql_query($sql) or die(mysql_error());
							
							
							if($query)
							{
								if(mysql_num_rows($query) > 0)
								{
									
									while($fetch = mysql_fetch_assoc($query))
									{
									?>
									<li>
									<div class="row">
		
									<div class="col-xs-12 col-sm-2 col-xss-2"><h5>
									<?php //echo $fetch['session_datetime'];?>
									--
									</h5></div>
								
										<div class="col-xs-12 col-sm-7 col-xss-10"><h3>
										<a href="<?php echo $root.'session_request.php?id='.$fetch['s_id'];?>">
										<?php echo $fetch['title'];?>
										</a>
										<span>Expert: <?php $fetch['fname']." ".$fetch['lname'];?></span></h3></div>
										<div class="col-xs-12 col-sm-3 date">
										
										<a href="javascript:void(0);" class="sess_btn canceled_btn">Cancelled</a>
										
										</div>
									</div>
									</li>
									
									<?php
									}
								}
								else
								{
								?>
								<li>
									<div class="row">
										
										<div class="col-xs-12 col-sm-7 col-xss-10"><h3>
										No sessions found.
										</h3></div>
										
									</div>
									</li>
								<?php
								}
							}
						}
						
						?>
                        	
                            
                        </ul>
                    </div>
                    
                </section><!-- // RIGHT MAIN // -->
            </div>
			
        </div>
    </div>
</section><!-- // MID MAIN SECTION // -->

<?php
require_once('phpInclude/footer.php');
?>