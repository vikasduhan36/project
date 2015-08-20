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
                                    <h5>Category <i class="fa fa-angle-down"></i></h5>
									<select name="category_id" id="category" class="form-control custom-select">
										<option value=''>Select</option>
										<?php
										foreach($categories as $category)
										{
											echo "<option value='".$category['id']."'>".$category['name']."</option>";
										}
										?>
										</select>
                                </li>
                                <li>
                                    <h5>Tags <i class="fa fa-angle-down"></i></h5>
									<input type="text" name="tag_search" id="tag_search" placeholder="Add Tags" class="form-control">
									<ul id="tag_result">
									</ul>
                                </li>
                                <li>
                                    <h5>Languages <i class="fa fa-angle-down"></i></h5>
                                    
									<input type="text" name="language_search" id="language_search" placeholder="Add Languages" class="form-control">
									<ul id="language_result">
									</ul>
                                </li>
                                <li>
                                    <h5>PRICE PER HOUR <i class="fa fa-angle-down"></i></h5>
                                    <input type="range" class="" id="range_03" />
                                </li>
                            </ul>
                        </div>
                    </div><!-- FOR TOGGLED DASHBOARD -->
                </div><!-- // SIDE BAR NAV // -->
				
				<div id="tag_selected"></div>
				<div id="language_selected"></div>
				
				<input type="hidden" name="action" value="get_search_exp">
				
				
		</form>