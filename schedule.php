<?php 
	require_once('phpInclude/header.php');
		$exp_id = $_GET['id'];
?>

<section class="midsection accountsection"><!-- // MID MAIN SECTION // -->
	<div class="container">
    	<div class="row">
        	<div class="col-xs-12 col-sm-10 col-sm-offset-1">
            	<ul class="progresslist">
				<!-- stepcomp -->
                    <li class=""><span class="stepblk"><span class="count"><i class="fa fa-check"></i></span></span><h6>Schedule session</h6></li>
                    <li class=""><span class="stepblk"><span class="count"><i class="fa fa-check"></i></span></span><h6>Add details</h6></li>
                    <li class=""><span class="stepblk"><span class="count">3</span></span><h6>Confirm</h6></li>
                </ul>
            </div>
        </div>
    	<div class="row">
        	<div class="col-xs-12 col-sm-4 col-md-3">
            <?php
			require_once("phpInclude/sidebar_schedule.php");
			?>
            </div>
            
            <div class="col-xs-12 col-sm-8 col-md-9">
            	<section class="right_main"><!-- // RIGHT MAIN // -->
				<div id="notification" style="display:none;"></div>
                <form id="form_book_schedule">
					<input type="hidden" id="exp_id" name="exp_id" value="<?php echo $exp_id;?>">
                <?php
				require_once("schedule_step1.php");
				?>
                    
                <?php
				require_once("schedule_step2.php");
				?>				
                    
                <?php
				require_once("schedule_step3.php");
				?>
				<input type="hidden" name="action" value="submit_book_schedule">
              </form>
                </section><!-- // RIGHT MAIN // -->
            </div>
        </div>
    </div>
</section><!-- // MID MAIN SECTION // -->

<?php
require_once('phpInclude/footer.php');
?>