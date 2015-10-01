<?php 
 ////// HEADER ////// 
require_once 'phpInclude/header.php';
?>
<script type="text/javascript">
$(document).ready(function(){
	var datastring = $("#form_search_public_session").serialize();
	search_public_request(datastring);
});
</script>
<section class="midsection accountsection"><!-- // MID MAIN SECTION // -->
	<div class="container">
    	<div class="row">
        	<div class="col-xs-12 col-sm-4 col-md-3">
            	<?php
				require_once('phpInclude/sidebar_public_session.php');
				?>
            </div>
            
            <div class="col-xs-12 col-sm-8 col-md-9">
            	<section class="right_main"><!-- // RIGHT MAIN // -->
                
                	<section class="browsemain" ><!-- // BROWSER EXPERTS MAIN // -->
                        <ul class="breadcrumb">
                            <li><a href="javascript:void(0);">Home</a></li>
                            <li>Browse Request</li>
                        </ul>
                        <div class="brwstoprow">
                            <div class="row">
                                <div class="col-xs-12 col-xss-6 col-sm-6">
                                    <h2>Browse <strong id="request_count">0</strong> public requests</h2>
                                </div> 
                            </div>
                        </div>
                        <!-- <div class="row">
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
                        <hr/> -->
                        <div id="serach_public_result"><!-- // BROWSE PUBLIC LIST // -->
                    </div>
                    </section><!-- // BROWSER EXPERTS MAIN // -->
                    
                </section><!-- // RIGHT MAIN // -->
            </div>
        </div>
    </div>
</section><!-- // MID MAIN SECTION // -->



<?php 
 ////// HEADER ////// 
require_once 'phpInclude/footer.php';
?>

