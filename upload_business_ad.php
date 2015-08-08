<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>DoNow Admin</title>

<link href="css/grid.css" type="text/css" rel="stylesheet" />
<link href="css/style.css" type="text/css" rel="stylesheet" />
<link href="css/responsive.css" type="text/css" rel="stylesheet" />
<link href="font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
<link href="fonts/fonts.css" type="text/css" rel="stylesheet" />

 <script type="text/javascript" src="js/jquery.min.js"></script> 
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="js/html5shiv.min.js"></script>
  <script src="js/respond.min.js"></script>
<![endif]-->

<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript">

var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
</script>
<Style>
label.error {color : red !important;}
</Style>
</head>

<body>

<header><!-- FIXED HEADER -->
	<div class="container-fluid">
    	<div class="row">
        	<div class="col-md-6 col-sm-4 col-xs-2">
            	<a href="javascript:void(0);" class="navtoggle hidden-xs hidden-sm">
                	<span></span>
                    <span></span>
                    <span></span>
                </a>
                <a href="javascript:void(0);" class="mob_navtoggle hidden-md hidden-lg">
                	<span></span>
                    <span></span>
                    <span></span>
                </a>
                <a href="javascript:void(0);" class="logo hidden-xs"><img src="images/logo.png" alt="DoNow" class="img-responsive" /></a>
                <div class="headsearch hidden-xs hidden-sm">
                	<i class="fa fa-search"></i>
                    <input type="search" placeholder="Type to search" />
                </div>
            </div>
            <div class="col-md-6 col-sm-8 col-xs-10 mob_pad0">
            	<div class="left_nav pull-right">
                	<ul>
                    	<li class="notification"><a href="javascript:void(0);"><i class="fa fa-bell"><span>5</span></i></a></li>
                        <li class="wlcmUser">
                        	<a href="javascript:void(0);">
                            	<span class="usrimg"><img src="images/usrimg.jpg" alt="user" class="img-responsive" /></span>
                                <h5>Welcome<span>Administrator</span></h5>
                        	</a>
                        </li>
                        <li class="logout"><a href="javascript:void(0);"><span>Log out</span><i class="fa fa-sign-out"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header><!-- FIXED HEADER -->

<section class="mainSection">
	<div class="sidebar"><!-- FIXED SIDEBAR -->
    	<h5>Overview</h5>
        <ul class="navigation">
        	<li><a href="javascript:void(0);"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
            <li><a href="javascript:void(0);" class="active"><i class="fa fa-cloud-upload"></i> <span>Upload ad</span> </a></li>
            <li><a href="javascript:void(0);"><i class="fa fa-gears"></i> <span>Manage ads</span> </a></li>
            <li><a href="javascript:void(0);"><i class="fa fa-briefcase"></i> <span>Businesses</span></a></li>
            <li><a href="javascript:void(0);"><i class="fa fa-users"></i> <span>Users</span></a></li>
        </ul>
    </div><!-- FIXED SIDEBAR -->
    
    <div class="InnerSection"><!-- INNER SECTION -->
    	<div class="container-fluid">
        	<div class="row">
            	<div class="col-xs-12">
                	<ul class="breadcrumb">
                    	<li><a href="javascript:void(0);">Home</a></li>
                        <li>Upload ads</li>
                    </ul>
                </div>
                <div class="col-xs-12">
                	<h2 class="heading">Upload ads</h2>
                    <div class="InnrCont">
                    	<h3 class="subhead">Upload your business ad</h3>
                        <div class="upload_ad_otr">
                        	<form id="submit_buiseness" enctype="multipart/form-data">
                            	<div class="row">
                                	<div class="col-sm-6 col-xs-12">
                                    	<div class="form-group">
                                        	<label>Title</label>
                                            <input type="text" placeholder="Ad heading" class="form-control" name="title"/>
                                        </div>
                                        <div class="form-group">
                                        	<label>Short Description</label>
                                            <input type="text" placeholder="Enter Short Description" class="form-control" name="short_description"/>
                                        </div>
                                        <div class="form-group">
                                        	<label>Location</label>
                                            <input type="text" placeholder="Enter Your Location" class="form-control" name="location"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                    	<div class="form-group">
                                        	<label>Title</label>
                                            <textarea class="form-control" placeholder="Enter Long Description" name="long_description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                	<div class="col-sm-4 col-xs-12">
                                    	<div class="form-group">
                                            <label>Time of activity</label>
                                            <div class="selectcell">
                                                <div class="cell_left">
                                                    <select class="form-control custom-select" name="time_start">
                                                        <option>Starting Time</option>
                                                        <?php
												$start=strtotime('00:00');
												$end=strtotime('23:30');
												for ($halfhour=$start;$halfhour<=$end;$halfhour=$halfhour+30*60) {?>
												<option value="<?php echo date('H:i',$halfhour);?>" ><?php echo date('H:i',$halfhour);?></option>	   
												<?php }?>
                                                    </select>
                                                </div>
                                                <div class="cell_right">
                                                    <select class="form-control custom-select" name="end_time">
                                                        <option>Ending Time</option>
                                                        <?php
												$start=strtotime('00:00');
												$end=strtotime('23:30');
												for ($halfhour=$start;$halfhour<=$end;$halfhour=$halfhour+30*60) {?>
												<option value="<?php echo date('H:i',$halfhour);?>" ><?php echo date('H:i',$halfhour);?></option>	   
												<?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                       	</div>
                                    </div>
                                    <div class="col-sm-4 col-xs-12 col-xss-6">
                                    	<div class="form-group">
                                        	<label>Price</label>
                                            <div class="input-group">
                                            	<i class="addon_input fa fa-dollar"></i>
                                            	<input type="text" placeholder="00" class="form-control" name="price"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-12 col-xss-6">
                                    	<div class="form-group clearfix">
                                        	<label>Activity Level <span class="activityTip" data-toggle="tooltip" title="How active the activity is?">?</span></label>
                                            <select class="form-control custom-select" name="select_level">
                                                <option value="">Select Level (1 - 5)</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                            	<div class="row">
                                	<div class="col-sm-4 col-xs-12">
                                    	<div class="form-group ImgUpldOtr">
                                        	<label>UpLoad Image</label>
                                            <div class="img_prev" id='preview'><img id="output" /></div></div>
                                            <span class="CustomUpload">
                                            	<input type="file" accept="image/*" onchange="loadFile(event)" class="responsiveimg" name="photoimg"/>
                                                <span>Select Image</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="image" id="image" value="sdsa"/>
                                 <input type="hidden" name="action" value="upload_ad"/>
                                <input type="submit" name="save" value="SAVE" id="save" class="signin_btn submitbtn1"/>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- INNER SECTION -->
</section>


<!-- ////// JQUERY ////// -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
	$(".custom-select").each(function(){
		$(this).wrap("<span class='select-wrapper'></span>");
		$(this).after("<span class='holder'></span>");
	});
	$(".custom-select").change(function(){
		var selectedOption = $(this).find(":selected").text();
		$(this).next(".holder").text(selectedOption);
	}).trigger('change');
	
	// TOOL TIP //
	$('[data-toggle="tooltip"]').tooltip();
	
	// SIDER BAR SLIDER NAV //
    $('.navtoggle').click(function() {
        $('body .mainSection').toggleClass('maincollapsed');
		$('.mainSection .sidebar').toggleClass('collapsed');
    });
	
	// SIDER BAR MOBILE SLIDER NAV //
	$('.mob_navtoggle').click(function() {
        $('body .mainSection').toggleClass('mob_maincollapsed');
		$('.mainSection .sidebar').toggleClass('mob_collapsed');
    });
})

</script>
</body>
</html>
