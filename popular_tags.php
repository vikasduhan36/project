<?php 
require_once('phpInclude/header.php');
	
?>
<section class="midsection accountsection tagsection"><!-- // MID MAIN SECTION // -->
	<div class="container">
    	<div class="row">
        	<div class="col-xs-12 col-sm-4 col-md-3">
            	<div class="sidebarnav"><!-- // SIDE BAR NAV // -->
                	<span class="dashbar clearfix">
                    	<i class="fa fa-random"></i> CATEGORIES
                        <a href="javascript:void(0);" class="togglebtn2 visible-xs" data-toggle="tooltip" title="Click me">
                        	<i class="fa fa-circle"></i><i class="fa fa-circle"></i><i class="fa fa-circle"></i>
                        </a>
                    </span>
                    <div class="toggle_db"><!-- FOR TOGGLED DASHBOARD -->
                        <ul class="navlist tagsCat_list">
                        <?php 
                    	$field= " * ";
                    	$table = " categories " ;
                    	$condition = " AND status='1' " ;
                    	$categ = getDetail($field,$table,$condition);
                    	foreach($categ as $key=>$value){
                    		$exp = mysql_query("Select count(id) as num from users WHERE is_expert='1' AND  exp_category_id='".$categ[$key]['id']."' ");
                    		if(  mysql_num_rows($exp) > 0){
                    		$res = mysql_fetch_assoc($exp);
                    	?>
                            <li><a href="<?php echo $root."experts.php?category=".$categ[$key]['name']."&cat_id=".$categ[$key]['id']."&search_type=category";?>"><?php echo $categ[$key]['name'];?> <span class="counts"><?php echo $res['num'];?> experts</span></a></li>
                            <?php } 
                    		}
                            ?>
                        </ul>					
                    </div><!-- FOR TOGGLED DASHBOARD -->
                </div><!-- // SIDE BAR NAV // -->
            </div>
            
            <div class="col-xs-12 col-sm-8 col-md-9">
            	<section class="right_main HelpCont"><!-- // RIGHT MAIN // -->
                    <ul class="breadcrumb">
                        <li><a href="javascript:void(0);">Home</a></li>
                        <li>Popular tags</li>
                    </ul>
                    
                    <div class="MainTagsOtr">
                    	<ul>
                    	<?php 
                    	$field= " * ";
                    	$table = " tags " ;
                    	$condition = " AND status='1' " ;
                    	$tags = getDetail($field,$table,$condition);
                    	foreach($tags as $key=>$value){
                    		$exp = mysql_query("Select count(id) as num from users WHERE is_expert='1' AND  find_in_set('".$tags[$key]['id']."',exp_tag_id) <> 0 ");
                    		if(  mysql_num_rows($exp) > 0){
                    		$res = mysql_fetch_assoc($exp);
                    		
                    	?>
                        	<li><a href="<?php echo $root."experts.php?tags=".$tags[$key]['short_name']."&tag_id=".$tags[$key]['id']."&search_type=tag";?>" ><?php echo $tags[$key]['name'];?> <span class="counts"><?php echo $res['num'];?> experts</span></a></li>
                           
                            <?php } 
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