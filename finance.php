<?php 
 ////// HEADER ////// 
require_once 'phpInclude/header.php';
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
            	<section class="right_main HelpCont"><!-- // RIGHT MAIN // -->
                    <ul class="breadcrumb">
                        <li><a href="javascript:void(0);">Home</a></li>
                        <li>Finance</li>
                    </ul>
                    
                    <div class="financeOtr">
                    	<div class="financeblks">
                        	
                            <hr/>
                        </div>
                        <div class="financeblks">
                        	<div class="row">
                            	<div class="col-xs-12 col-md-4 col-md-push-8">
                                	<h2 class="">Total Earning</h2>
                                    <div class="totalearn">
                                        <i class="fa fa-dollar"></i> 000.00
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-8 col-md-pull-4">
                                	<h2 class="">Payment methods</h2>
                                    <div style="display:none;">
                                    <label class="crdhead">Card Number:</label>
                                    <span class="detail">1234567891234567</span><br/>
                                    <label class="crdhead">Exp. Date:</label>
                                    <span class="detail">Sep, 2020</span><br/>
                                    <label class="crdhead">CVV:</label>
                                    <span class="detail">****</span><br/>
                                    </div>
                                    <p class="clearfix ntadded_pay">You haven't added any payment cards yet.</p>
                                    <a href="finance_detail.php" class="addnewcard_link"><i class="fa fa-credit-card"></i>&nbsp; Add New Card</a>
                                    
                                </div>
                            </div>
                        	<hr/>
                        </div>
                        <div class="financeblks">
                            <div class="checkOpt">
                                <input type="checkbox" id="compnay_account" />
                                <label class="check1" for="compnay_account"><i class="fa fa-check"></i>This is a company account</label>
                            </div>
                            <div class="myaccountinfo comp_ac_blk" style="display:none;">
                            	<div class="infoblks clearfix">
                                	<ul class="row infolist">
                                        <li>
                                            <div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Company Name</label></div>
                                            <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                                <span class="value">Not set</span>
                                                <input type="text" style="display:none;" class="form-control valuefield" placeholder="Enter Company Name" />
                                            </div>
                                            <div class="col-xs-12 col-xss-2 col-sm-2">
                                                <a class="editlink" href="javascript:void(0);"><i class="fa fa-edit"></i> Edit</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>TAX number</label></div>
                                            <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                                <span class="value">Not set</span>
                                                <input type="text" style="display:none;" class="form-control valuefield" placeholder="Enter Company Name" />
                                            </div>
                                            <div class="col-xs-12 col-xss-2 col-sm-2">
                                                <a class="editlink" href="javascript:void(0);"><i class="fa fa-edit"></i> Edit</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Address</label></div>
                                            <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                                <span class="value">Not set</span>
                                                <input type="text" style="display:none;" class="form-control valuefield" placeholder="Enter Company Name" />
                                            </div>
                                            <div class="col-xs-12 col-xss-2 col-sm-2">
                                                <a class="editlink" href="javascript:void(0);"><i class="fa fa-edit"></i> Edit</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>City</label></div>
                                            <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                                <span class="value">Not set</span>
                                                <input type="text" style="display:none;" class="form-control valuefield" placeholder="Enter Company Name" />
                                            </div>
                                            <div class="col-xs-12 col-xss-2 col-sm-2">
                                                <a class="editlink" href="javascript:void(0);"><i class="fa fa-edit"></i> Edit</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Zipcode</label></div>
                                            <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                                <span class="value">Not set</span>
                                                <input type="text" style="display:none;" class="form-control valuefield" placeholder="Enter Company Name" />
                                            </div>
                                            <div class="col-xs-12 col-xss-2 col-sm-2">
                                                <a class="editlink" href="javascript:void(0);"><i class="fa fa-edit"></i> Edit</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col-xs-12 col-xss-10 col-sm-4 col-md-3"><label>Country</label></div>
                                            <div class="col-xs-12 col-xss-10 col-sm-6 col-md-7">
                                                <span class="value">Not set</span>
                                                <input type="text" style="display:none;" class="form-control valuefield" placeholder="Enter Company Name" />
                                            </div>
                                            <div class="col-xs-12 col-xss-2 col-sm-2">
                                                <a class="editlink" href="javascript:void(0);"><i class="fa fa-edit"></i> Edit</a>
                                            </div>
                                        </li>
                                    </ul>
                                    <button class="submitbtn btn1" type="submit">Submit <i class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <hr/>
                        </div>
                        <div class="financeblks">
                        	<h2>Transactions history</h2>
                        </div>
                    </div>
                    
                </section><!-- // RIGHT MAIN // -->
            </div>
        </div>
    </div>
</section><!-- // MID MAIN SECTION // -->

<script>
$(document).ready(function() {
$(".sidebarnav .togglebtn2").click(function(){
		$(this).parent().next('.toggle_db').slideToggle('slow');
	});
	
	// SHOW COMPANY ACCOUNT INFORMATION 
	$('#compnay_account').change(function () {
		if (this.checked) {
			$(this).parent().next('.comp_ac_blk').slideDown();
		}
		else {
			$(this).parent().next('.comp_ac_blk').slideUp();
		}
	});
});
</script>	
<?php
require('phpInclude/footer.php');
?>