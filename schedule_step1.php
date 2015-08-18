	<section id="step1" style="display:block;"><!-- // STEP 1 // -->
	<!--
                        <ul class="breadcrumb">
                            <li><a href="javascript:void(0);">Home</a></li>
                            <li>Schedule Session</li>
                        </ul>
						-->
                        <h2 class="accountheading">Schedule Session</h2>
                        
                        <div class="schedulemain">
                            <p>YOU are about to post a public session request so we can find you some great experts. Experts will respond to your request so you can choose the expert you pcefer<br/><br/><strong>How long would you like the session to be?</strong><br/><span class="txt_lt_it">You can always extend or shorten the actual sessions as you are in it.</span></p>
                            <div class="row">
                                <div class="col-xs-12 col-xss-6 col-sm-6 form-group">
                              <select name="duration" id="duration" class="form-control custom-select">
								<option value=''>Select</option>
								<?php
								for($i=1;$i<=12;$i++)
								{
									echo "<option>".($i*10)." min</option>";
								}
								?>
								</select>
                                </div>
                            </div>
							
                            <p><strong>Session date</strong>
							
							
                            
                            <section class="ChooseDatesCont"><!-- CHOOSE DATE CONTAINER -->
                                <p><strong class="txt_lt_it">Select at least 1 (preferably 3) time slots that suit you.</strong><br/><small>(All times are in your local timezone AsialKolkata)</small></p>
                                
                                <div class="row">
                                    <div class="col-xs-12 col-md-5">
                                        <label class="lbl">Choose Date</label>
										<!--
										<input type="text" name="date_schedule" id="date_schedule" readonly="readonly"  class="date_schedule" value=""/>
										-->
										<input type="hidden" name="date_schedule" id="hidden_date_schedule" value=""/>
										<div id="date_schedule"  class="date_schedule"></div>
									</div>
                                    <div class="col-xs-12 col-md-7">
                                        <label class="lbl">Choose Time</label>
                                        <div id="display_slot">
										
										</div>
                                    </div>
                                </div>
                                
                            </section><!-- CHOOSE DATE CONTAINER -->
                            
                            <div class="row">
                                <div class="col-xs-12">
                                    <a href="javascript:void(0);" class="btn1 proceedbtn" id="validate_step1">Proceed <i class="fa fa-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </section><!-- // STEP 1 // -->