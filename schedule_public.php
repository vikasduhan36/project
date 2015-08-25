<?php 
	require_once('phpInclude/header.php');
$field = "*";
$table = "categories";
$condition 	= "and status='1' ";
$categories = getDetail($field,$table,$condition);
	
?>
<style>
.available
{
    background-color: #d7eac0 !important;
    border-color: #afd581 !important;
    border-style: solid !important;
    border-width: 1px !important;
}
</style>
<form id="form_book_schedule_public">

<section class="midsection accountsection"><!-- // MID MAIN SECTION // -->
	<div class="container">
    	<div class="row">
        	<div class="col-xs-12 col-sm-10 col-sm-offset-1">
            	<ul class="progresslist">
				<!-- stepcomp -->
                    <li class=""><span class="stepblk"><span class="count">1</span></span><h6>Schedule session</h6></li>
                    <li class=""><span class="stepblk"><span class="count">2</span></span><h6>Add details</h6></li>
                    <li class=""><span class="stepblk"><span class="count">3</span></span><h6>Confirm</h6></li>
                </ul>
            </div>
        </div>
    	<div class="row">
        	<div class="col-xs-12 col-sm-4 col-md-3">
            <?php
			require_once("phpInclude/sidebar_schedule_public.php");
			?>
            </div>
            
            <div class="col-xs-12 col-sm-8 col-md-9">
            	<section class="right_main"><!-- // RIGHT MAIN // -->
				<div id="notification" style="display:none;"></div>
                
                <?php
				require_once("schedule_public_step1.php");
				?>
                    
                <?php
				require_once("schedule_step2.php");
				?>				
                    
                <?php
				require_once("schedule_step3.php");
				?>
				<input type="hidden" name="action" value="submit_book_schedule_public">
              
                </section><!-- // RIGHT MAIN // -->
            </div>
        </div>
    </div>
</section><!-- // MID MAIN SECTION // -->
</form>

<?php 
	require_once('phpInclude/footer.php');
?>