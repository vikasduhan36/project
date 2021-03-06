<?php 
	require_once('phpInclude/header.php');
	
?>
<div style="display:none;" id="page_type">expert</div>
<section class="midsection accountsection"><!-- // MID MAIN SECTION // -->
	<div class="container">
    	<div class="row">
        	<div class="col-xs-12 col-sm-4 col-md-3">
				<?php
				require_once("phpInclude/sidebar_experts.php");
				?>
            </div>
            
            <div class="col-xs-12 col-sm-8 col-md-9">
            	<section class="right_main"><!-- // RIGHT MAIN // -->
                
                	<section class="browsemain" ><!-- // BROWSER EXPERTS MAIN // -->
                       
                        <div class="brwstoprow">
						<?php
						if (isset($_GET['tags']) && empty($_GET['tag_id']) && !empty($_GET['tags']))
						{
						?>
						 <div class="row">
							<div class="col-xs-12 col-xss-12 col-sm-12">
									
                                    <h2>
									Search results for <strong id="text_search_desc"><u><?php echo trim($_GET['tags']);?></u></strong>
									
									
									
									
									<input type="text" class="form-control" id="input_search_desc" value="<?php echo trim($_GET['tags']);?>" style="width:45%;display:none;">
									&nbsp;
									<a href="javascript:void(0);" class="fa fa-pencil-square-o" title="Edit" id="edit_search_desc" alt="edit"></a>
									
									</h2>                               
							   </div>
							</div>
							<!--
							<div class="row">
							<div class="col-xs-12 col-xss-6 col-sm-6">
									<input type="text" class="form-control" id="input_search_desc" value="<?php echo trim($_GET['tags']);?>">
							</div>
							</div>
							-->
						<?php
						}
						?>						
                            <div class="row">
							
							
								
                                <div class="col-xs-12 col-xss-6 col-sm-6">
                                    <h2>Browse <strong id="expert_count"></strong> Experts</h2>
                                </div>
								<?php
								
								if($GLOBALS['is_expert'] != 1)
								{
								?>
                                <div class="col-xs-12 col-xss-6 col-sm-6">
                                    <span class="pull-right placereqbtn_otr">..or
									<?php									
									if(!isset($_SESSION['LoginUserId']) && empty($_SESSION['LoginUserId']))
									{
									?>
									<a href="javascript:void(0);" data-toggle="modal" data-target="#accountpopup" class="login_page placereq_btn btn1" data-login="reload">
									<?php
									}
									else
									{
									?>
									<a href="<?php echo $root;?>schedule_public.php" class="placereq_btn btn1">
									<?php
									}
									?>
									Place Public Request</a></span>
                                </div>
								<?php
								}
								?>
                            </div>
                        </div>
                        <div class="row">
                        	<div class="col-xs-12">
                            	<span class="pull-right sortbyOtr">
                                	<label>Sort By:</label>
                                    <span class="selectotr">
                                    	<select class="form-control custom-select">
                                        	<option>Best Match</option>
                                            <option>Heightes Rating</option>
                                            <option>Most Experianced</option>
                                        </select>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <hr/>
                        <div id="serach_expert_result"></div>
                   
                        
                        
                    </section><!-- // BROWSER EXPERTS MAIN // -->
                    
                </section><!-- // RIGHT MAIN // -->
            </div>
        </div>
    </div>
</section><!-- // MID MAIN SECTION // -->



<?php
require_once('phpInclude/footer.php');
?>