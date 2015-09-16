<?php 
 ////// HEADER ////// 
require_once 'phpInclude/header.php';
?>
<section class="midsection accountsection"><!-- // MID MAIN SECTION // -->
	<div class="container">
    	<div class="row">
		
        	<div class="col-xs-12 col-sm-8 col-sm-offset-2">
            	<div class="payment_cont">
                	<h2>Payment Details</h2>
                    <p>Enter your card information to add a credit card to your 24sessions account.<br/>
When you press 'Validate', you may be redirected to a MasterCard SecureCode or Verified by Visa verification screen.<br/>
As part of the validation process, a payment of 1 € may appear as 'pending' on your card statement.<br/>
Your card will not be charged until you have held a session.</p>
                
                	<form class="pymnt_info_frm">
                    	<div class="form-group">
                        	<input type="checkbox" /> <strong>Please update your payment details</strong>
                        </div>
                        
                        <div class="form-group">
                        	<label>Card Type</label>
                        	<img src="images/credit_cards.png" class="img-responsive" alt="cards" width="200px" />
                        </div>
                        <div class="form-group">
                        	<label>Card Number</label>
                        	<div class="row">
                            	<div class="col-sm-6 col-xs-12 col-xss-6">
                                	<input type="text" placeholder="Card Number" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                        	<label>Expiration date</label>
                        	<div class="row">
                            	<div class="col-sm-3 col-xs-6 col-xss-3">
                                	<select class="form-control custom-select">
                                    	<option>Month</option>
                                    </select>
                                </div>
                                <div class="col-sm-3 col-xs-6 col-xss-3">
                                	<select class="form-control custom-select">
                                    	<option>Year</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                        	<label>Card Security code</label>
                        	<div class="row">
                            	<div class="col-sm-6 col-xs-11 col-xss-6">
                                	<input type="text" placeholder="CVV" class="form-control" />
                                    <span class="cvv_info">
                                    	<i class="fa fa-info-circle"></i>
                                    	<span class="shareTip">The CVV Number ("Card Verification Value") on your credit card or debit card is a 3 digit number on VISA®, MasterCard® and Discover® branded credit and debit cards. On your American Express® branded credit or debit card it is a 4 digit numeric code.</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
						<a href="finance.php">
                        	<input type="button" value="validate" class="btns_grp" />
                          </a>
<a href="finance.php">
						  <input type="button" value="Cancel" class="btns_grp cancelbtn" />
						  </a>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    	
    </div>
</section><!-- // MID MAIN SECTION // -->

<script>
$(document).ready(function() {
// SIDEBAR TOGGLE IN 767px //
	$(".queotr .quelink").click(function(){
		$('body,html').find('.ansblk').slideUp('slow');
		if($(this).next('.ansblk').is(':visible')) {
			$(this).next('.ansblk').slideUp();
		}
		else {
			$(this).next('.ansblk').slideDown();
		}
	});
});
</script>	
<?php
require('phpInclude/footer.php');
?>