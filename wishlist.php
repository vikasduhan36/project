<?php 
 ////// HEADER ////// 
require_once 'phpInclude/header.php';
?>
<script type="text/javascript">
$(document).ready(function(){
var datastring =  {'action':'get_search_exp','search_type':'wishlist'};
search_expert(datastring);
});
</script>
<div style="display:none;" id="page_type">wishlist</div>
<section class="midsection accountsection"><!-- // MID MAIN SECTION // -->
	<div class="container">
    	<div class="row">
        	<div class="col-xs-12 col-sm-4 col-md-3">
            	<div class="sidebarnav"><!-- // SIDE BAR NAV // -->
                	<span class="dashbar clearfix">
                    	<i class="fa fa-dashboard"></i> Dashboard
                        <a href="javascript:void(0);" class="togglebtn2 visible-xs" data-toggle="tooltip" title="Click me">
                        	<i class="fa fa-circle"></i><i class="fa fa-circle"></i><i class="fa fa-circle"></i>
                        </a>
                    </span>
                    <div class="toggle_db"><!-- FOR TOGGLED DASHBOARD -->
                    <form id="imageform" method="post" enctype="multipart/form-data" action='handler.php'>
                        <div class="accountimgblk">
                            <span class="imgcont" id='preview'><img src="<?php echo $prof_pic;?>" alt="user" class="responsiveimg" id="output"/></span>
                            <span class="uploadimgotr">
                                <input type="file"  name="photoimg" id="photoimg" />
                                <span><i class="fa fa-camera"></i> Upload Image</span>
                            </span>
                        </div>
                        </form>
                        <div class="accountprogress">
                            <h6 class="progresstxt">Profile completeness: <span>55%</span></h6>
                            <div class="progress">
                              <div class="progress-bar progress-bar-striped active progress-bar-info" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                <span class="sr-only"></span>
                              </div>
                            </div>
                        </div>
                        <ul class="navlist">
                            <li><a href="javascript:void(0);"><i class="fa fa-caret-right"></i> My Account</a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-caret-right"></i> My Sessions</a></li>
                            <li><a href="javascript:void(0);"  class="active"><i class="fa fa-caret-right"></i> Expert Wishlist</a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-caret-right"></i> Finance</a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-caret-right"></i> Help</a></li>
                        </ul>					
                    </div><!-- FOR TOGGLED DASHBOARD -->
                </div><!-- // SIDE BAR NAV // -->
            </div>
            
             <div class="col-xs-12 col-sm-8 col-md-9">
            	
				<section class="right_main padL0"><!-- // RIGHT MAIN // -->
                
                	<section class="browsemain" ><!-- // BROWSER EXPERTS MAIN // -->
                        <ul class="breadcrumb">
                            <li><a href="javascript:void(0);">Home</a></li>
                            <li>Whislist</li>
                        </ul>
                        <div class="row">
                        	<div class="col-xs-12">
                            	<span class="pull-right sortbyOtr">
                                	<label>Sort By:</label>
                                    <span class="selectotr">
                                    	<select class="form-control custom-select">
                                        	<option>Date</option>
                                        </select>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <hr/>
                     <div id="serach_expert_result">    
                      </div>
                    </section><!-- // BROWSER EXPERTS MAIN // -->
                    
                </section><!-- // RIGHT MAIN // -->
				
            </div>
			
        </div>
    </div>
</section><!-- // MID MAIN SECTION // -->


<?php
require_once('phpInclude/footer.php');
?>