<?php
$field = "*";
$table = "categories";
$condition 	= "and status='1' ";
$categories = getDetail($field,$table,$condition);
?>
	<form id="form_search_expert">
	<div class="sidebarnav sidebar2"><!-- // SIDE BAR NAV // -->
                	<span class="dashbar clearfix">
                    	<i class="fa fa-gears"></i> Refine results
                        <a href="javascript:void(0);" class="togglebtn2 visible-xs" data-toggle="tooltip" title="Click me">
                        	<i class="fa fa-circle"></i><i class="fa fa-circle"></i><i class="fa fa-circle"></i>
                        </a>
                    </span>
                 	<div class="toggle_db"><!-- FOR TOGGLED DASHBOARD -->
                        <div class="sidebarfilter">
                            <ul>
                            <li>
                                    <h5>Expert <i class="fa fa-angle-down"></i></h5>
                                    <div class="autocomp_blk">
									<input type="text" name="expert_search" id="expert_search" placeholder="search expert" class="form-control" value="<?php if (isset($_GET['tags']) && $_GET['search_type']=="expert"){echo trim($_GET['tags']);}?>">
									</div>
                                </li>
                                <li>
                                    <h5>Category <i class="fa fa-angle-down"></i></h5>
									<select name="category_id" id="category" class="form-control custom-select">
										<option value=''>Select</option>
										<?php
										foreach($categories as $category)
										{
											if (isset($_GET['category']) && $_GET['cat_id']==$category['id'])
											{
												$selected='selected="selected"';
											} else {
												$selected='';
											}
											echo "<option value='".$category['id']."' ".$selected.">".$category['name']."</option>";
										}
										?>
										</select>
                                </li>
                                <li>
                                    <h5>Tags <i class="fa fa-angle-down"></i></h5>
									<ul class="taglist" id="tag_search_ui">
									<?php 
									if (isset($_GET['tags']) && !empty($_GET['tags']) && $_GET['search_type']=="tag")
									{
									?>
									<li><?php echo trim($_GET['tags']);?><a href="javascript:void(0);" class="remove_tag" alt="<?php echo trim($_GET['tag_id']);?>"><i class="fa fa-times"></i></a></li>
									<?php }?>
									</ul>
									<div class="autocomp_blk">
									<input type="text" name="tag_search" id="tag_search" placeholder="Add Tags" class="form-control">
									
									<ul id="tag_result" class="autocomp_list">
									
									</ul>
									</div>
                                </li>
                                <li>
                                    <h5>Languages <i class="fa fa-angle-down"></i></h5>
									<ul class="taglist" id="language_search_ui">
									</ul>
                                    <div class="autocomp_blk">
									<input type="text" name="language_search" id="language_search" placeholder="Add Languages" class="form-control">
									<ul id="language_result" class="autocomp_list">
									</ul>
									</div>
                                </li>
                                <li>
                                    <h5>PRICE PER HOUR <i class="fa fa-angle-down"></i></h5>
                                    <input type="range" class="" id="range_03" />
									<input type="hidden" name="price_from" id="price_from" value="">
									<input type="hidden" name="price_to" id="price_to" value="">
                                </li>
                            </ul>
                        </div>
                    </div><!-- FOR TOGGLED DASHBOARD -->
                </div><!-- // SIDE BAR NAV // -->
				
				<div id="tag_selected">
				<?php 
				if (isset($_GET['tags']) && !empty($_GET['tags']) && $_GET['search_type']=="tag")
				{
				?>
				<input type="hidden" name="tag_selected[]" value="<?php echo trim($_GET['tag_id']);?>">
				<?php }?>
				</div>
				<div id="language_selected"></div>
				
				<input type="hidden" name="action" value="get_search_exp">
				
				
		</form>