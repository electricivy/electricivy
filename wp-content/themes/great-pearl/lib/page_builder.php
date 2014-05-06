<?php
global $index_page_option;

//get post categories
	$args = array(
		'type'		 =>'post',
		'taxonomy'   => 'category',
		'hide_empty' => '0'
	); 
	$post_categories = get_categories($args); 
	
	//get project categories
	$args = array(
		'type'		 =>'project',
		'taxonomy'   => 'project-category',
		'hide_empty' => '0'
	); 
	$project_taxonomies = get_categories($args); 
	
	//get event categories
	$args = array(
		'type'		 =>'event',
		'taxonomy'   => 'event-category',
		'hide_empty' => '0'
	); 
	$event_taxonomies = get_categories($args); 
	
	//get feature categories
	$args = array(
		'type'		 =>'feature',
		'taxonomy'   => 'feature-category',
		'hide_empty' => '0'
	); 
	$feature_taxonomies = get_categories($args); 
?>					<div id="index-hidden-data">
					</div>
					<input type="hidden" id="current-editor" name="current-editor" value="<?php echo $index_page_option['current-editor'];?>">
					<div class="admin-box-shadow">
						<span class="wope-button" id="create-index-section">
							Add Content Section
						</span>
					
						<div id="index-page">
							<?php 
								$total_box = 1;
								$total_widget = 1;
								$total_field = 1;
								
								if(isset($index_page_option['total_section'])){
									for($i = 1 ; $i <= $index_page_option['total_section'] ; $i++ ){
								?>
									<div class="index-section-box">
										<div class="index-section-remove"></div>
										<div class="index-section-buttons">
											<span class="index-section-title">Content Section</span><select class="index-section-layout" name="layout">
												<option value="0" <?php selected($index_page_option['section'.$i.'_layout'],0);?>> -- Change Layout -- </option>
												<option value="1" <?php selected($index_page_option['section'.$i.'_layout'],1);?>> 1/1 </option>
												<option value="2" <?php selected($index_page_option['section'.$i.'_layout'],2);?>> 1/2 + 1/2 </option>
												<option value="3" <?php selected($index_page_option['section'.$i.'_layout'],3);?>> 1/3 + 1/3 + 1/3 </option>
												<option value="4" <?php selected($index_page_option['section'.$i.'_layout'],4);?>> 1/3 + 2/3 </option>
												<option value="5" <?php selected($index_page_option['section'.$i.'_layout'],5);?>> 2/3 + 1/3 </option>
												<option value="6" <?php selected($index_page_option['section'.$i.'_layout'],6);?>> 1/4 + 1/4 + 1/4 + 1/4 </option>
												<option value="7" <?php selected($index_page_option['section'.$i.'_layout'],7);?>> 2/4 + 1/4 + 1/4</option>
												<option value="8" <?php selected($index_page_option['section'.$i.'_layout'],8);?>> 1/4 + 2/4 + 1/4</option>
												<option value="9" <?php selected($index_page_option['section'.$i.'_layout'],9);?>> 1/4 + 1/4 + 2/4</option>
												<option value="10" <?php selected($index_page_option['section'.$i.'_layout'],10);?>> 1/4 + 3/4</option>
												<option value="11" <?php selected($index_page_option['section'.$i.'_layout'],11);?>> 3/4 + 1/4</option>
											</select>
										</div>
										<div class="index-page-box-container">
											<?php 
											for($j = 1 ; $j <= $index_page_option['section'.$i.'_total'] ; $j++ ){
												if($j == $index_page_option['section'.$i.'_total']){
													$last_class = " column-last";
													$clear_div = '<div class="cleared"></div>';
												}else{
													$last_class = "";
													$clear_div = '';
												}
											?>
												<div class="index-page-box column<?php echo $index_page_option['box'.$total_box];?> <?php echo $last_class;?>">
													<div class="index-box-column"><?php echo $index_page_option['box'.$total_box];?></div>
													<?php 
														for($k = 1; $k <= $index_page_option['box'.$total_box.'_total'] ; $k++){	
														
														switch($index_page_option['widget'.$total_widget]){
															case 'category-post':
																$field1 = $total_field;
																$field2 = $total_field+1;
																$field3 = $total_field+2;
																$field4 = $total_field+3;
															?>
															<div class="index-widget posts-category-widget">
																<div class="index-widget-type">category-post</div>
																<div class="index-widget-remove"></div>
																<div class="index-widget-title">Category Posts</div>
																<div class="index-widget-content">
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Title</div>
																		<input class="widget-field" type="text" name="widget_title" value="<?php echo $index_page_option['field'.$field1];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Category</div>
																		<select class="widget-field">
																			<?php if(count($post_categories )>0){
																					?>
																					<option value="0">All Categories</option>
																					<?php
																				foreach($post_categories as $category){
																					if($category->term_id == $index_page_option['field'.$field2]){?>
																						<option selected="selected" value="<?php echo $category->term_id;?>"><?php echo $category->name;?></option>
																				<?php }else{?>
																						<option value="<?php echo $category->term_id;?>"><?php echo $category->name;?></option>
																				<?php }?>
																					
																				<?php
																				}
																			}
																			?>
																		</select>
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Max Posts</div>
																		<input class="widget-field" type="text" name="number_post" value="<?php echo $index_page_option['field'.$field3];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Number Posts per Row</div>
																		<input class="widget-field" type="text" name="post_row" value="<?php echo $index_page_option['field'.$field4];?>">
																	</div>
																</div>
															</div>
															<?php 
																$total_field += 4;
																break;
															case 'post-list':
																$field1 = $total_field;
																$field2 = $total_field+1;
																$field3 = $total_field+2;
															?>
															<div class="index-widget posts-category-widget">
																<div class="index-widget-type">post-list</div>
																<div class="index-widget-remove"></div>
																<div class="index-widget-title">List of Posts</div>
																<div class="index-widget-content">
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Title</div>
																		<input class="widget-field" type="text" name="widget_title" value="<?php echo $index_page_option['field'.$field1];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Category</div>
																		<select class="widget-field">
																			<?php if(count($post_categories )>0){
																					?>
																					<option value="0">All Categories</option>
																					<?php
																				foreach($post_categories as $category){
																					if($category->term_id == $index_page_option['field'.$field2]){?>
																						<option selected="selected" value="<?php echo $category->term_id;?>"><?php echo $category->name;?></option>
																				<?php }else{?>
																						<option value="<?php echo $category->term_id;?>"><?php echo $category->name;?></option>
																				<?php }?>
																					
																				<?php
																				}
																			}
																			?>
																		</select>
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Max Posts</div>
																		<input class="widget-field" type="text" name="number_post" value="<?php echo $index_page_option['field'.$field3];?>">
																	</div>
																</div>
															</div>
															<?php 
																$total_field += 3;
																break;
															case 'lastest-portfolio':
																$field1 = $total_field;
																$field2 = $total_field+1;
																$field3 = $total_field+2;
																$field4 = $total_field+3;
																$field5 = $total_field+4;
																$field6 = $total_field+5;
															?>
															<div class="index-widget lastest-portfolio-widget">
																<div class="index-widget-type">lastest-portfolio</div>
																<div class="index-widget-remove"></div>
																<div class="index-widget-title">Latest Portfolio</div>
																<div class="index-widget-content">
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Title</div>
																		<input class="widget-field" type="text" name="widget_title" value="<?php echo $index_page_option['field'.$field1];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Type</div>
																		<select class="widget-field" >
																			<option value="2" <?php selected($index_page_option['field'.$field2],2);?>>Latest</option>
																			<option value="1" <?php selected($index_page_option['field'.$field2],1);?>>Featured</option>
																		</select>
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Project Category</div>
																		<select class="widget-field" >
																			<?php if(count($project_taxonomies )>0){
																				?>
																				<option value="0">All Categories</option>
																				<?php
																				foreach($project_taxonomies as $each_taxonomy){?>
																				<?php if($each_taxonomy->term_id == $index_page_option['field'.$field3]){?>
																					<option selected="selected" value="<?php echo $each_taxonomy->term_id;?>"><?php echo $each_taxonomy->name;?></option>
																				<?php }else{?>
																					<option value="<?php echo $each_taxonomy->term_id;?>"><?php echo $each_taxonomy->name;?></option>
																				<?php }?>
																				
																				<?php
																				}
																			}
																			?>
																		</select>
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Max Projects</div>
																		<input class="widget-field" type="text" name="max_project" value="<?php echo $index_page_option['field'.$field4];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Number Projects per Row</div>
																		<input class="widget-field" type="text" name="project_row" value="<?php echo $index_page_option['field'.$field5];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">View All Projects Label</div>
																		<input class="widget-field" type="text" name="view_all_project_label" value="<?php echo $index_page_option['field'.$field6];?>">
																	</div>
																</div>
															</div>
															<?php 
																$total_field += 6;
																break;
															case 'site-feature':
																$field1 = $total_field;
																$field2 = $total_field+1;
																$field3 = $total_field+2;
																$field4 = $total_field+3;
															?>
															<div class="index-widget features-widget">
																<div class="index-widget-type">site-feature</div>
																<div class="index-widget-remove"></div>
																<div class="index-widget-title">Feature Boxes</div>
																<div class="index-widget-content">
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Title</div>
																		<input class="widget-field" type="text" name="widget_title" value="<?php echo $index_page_option['field'.$field1];?>">
																	</div>
																	<div style="display:none" class="index-widget-option">
																		<div class="index-widget-option-name">Content</div>
																		<textarea class="widget-field" rows="4" name="feature_content"><?php echo $index_page_option['field'.$field2];?></textarea>
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Feature Category</div>
																		<select class="widget-field" >
																			<?php if(count($feature_taxonomies )>0){
																				foreach($feature_taxonomies as $each_taxonomy){?>
																				<?php if($each_taxonomy->term_id == $index_page_option['field'.$field3]){?>
																					<option selected="selected" value="<?php echo $each_taxonomy->term_id;?>"><?php echo $each_taxonomy->name;?></option>
																				<?php }else{?>
																					<option value="<?php echo $each_taxonomy->term_id;?>"><?php echo $each_taxonomy->name;?></option>
																				<?php }?>
																				
																				<?php
																				}
																			}
																			?>
																		</select>
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Number features per Row</div>
																		<input class="widget-field" type="text" name="feature_per_row" value="<?php echo $index_page_option['field'.$field4];?>">
																	</div>
																</div>
															</div>
															<?php 
																$total_field += 4;
																break;
																
															case 'partner-logo':
																$field1 = $total_field;
																$field2 = $total_field+1;
																$field3 = $total_field+2;
															?>
															<div class="index-widget partner-logo-widget">
																<div class="index-widget-type">partner-logo</div>
																<div class="index-widget-remove"></div>
																<div class="index-widget-title">Logo of Partners</div>
																<div class="index-widget-content">
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Title</div>
																		<input class="widget-field" type="text" name="widget_title" value="<?php echo $index_page_option['field'.$field1];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Feature Category</div>
																		<select class="widget-field" >
																			<?php if(count($feature_taxonomies )>0){
																				foreach($feature_taxonomies as $each_taxonomy){?>
																				<?php if($each_taxonomy->term_id == $index_page_option['field'.$field2]){?>
																					<option selected="selected" value="<?php echo $each_taxonomy->term_id;?>"><?php echo $each_taxonomy->name;?></option>
																				<?php }else{?>
																					<option value="<?php echo $each_taxonomy->term_id;?>"><?php echo $each_taxonomy->name;?></option>
																				<?php }?>
																				
																				<?php
																				}
																			}
																			?>
																		</select>
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Number Logos per Row</div>
																		<input class="widget-field" type="text" name="logo_per_row" value="<?php echo $index_page_option['field'.$field3];?>">
																	</div>
																</div>
															</div>
															<?php 
																$total_field += 3;
																break;
															case 'testimonial':
																$field1 = $total_field;
																$field2 = $total_field+1;
															?>
															<div class="index-widget testimonials-widget">
																<div class="index-widget-type">testimonial</div>
																<div class="index-widget-remove"></div>
																<div class="index-widget-title">Testimonials</div>
																<div class="index-widget-content">
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Title</div>
																		<input class="widget-field" type="text" name="widget_title" value="<?php echo $index_page_option['field'.$field1];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Feature Category</div>
																		<select class="widget-field" >
																			<?php if(count($feature_taxonomies )>0){
																				foreach($feature_taxonomies as $each_taxonomy){?>
																				<?php if($each_taxonomy->term_id == $index_page_option['field'.$field2]){?>
																					<option selected="selected" value="<?php echo $each_taxonomy->term_id;?>"><?php echo $each_taxonomy->name;?></option>
																				<?php }else{?>
																					<option value="<?php echo $each_taxonomy->term_id;?>"><?php echo $each_taxonomy->name;?></option>
																				<?php }?>
																				
																				<?php
																				}
																			}
																			?>
																		</select>
																	</div>
																</div>
															</div>
															<?php 
																$total_field += 2;
																break;
															case 'welcome-box':
																$field1 = $total_field;
																$field2 = $total_field+1;
																$field3 = $total_field+2;
																$field4 = $total_field+3;
															?>
															<div class="index-widget welcome-box-widget">
																<div class="index-widget-type">welcome-box</div>
																<div class="index-widget-remove"></div>
																<div class="index-widget-title">Welcome Box</div>
																<div class="index-widget-content">
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Title</div>
																		<input class="widget-field" type="text" name="widget_title" value="<?php echo $index_page_option['field'.$field1];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Content</div>
																		<textarea class="widget-field content_editor" rows="4" name="welcome_box_content"><?php echo $index_page_option['field'.$field2];?></textarea>
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Button Name</div>
																		<input class="widget-field" type="text" name="button_name" value="<?php echo $index_page_option['field'.$field3];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Button Url</div>
																		<input class="widget-field" type="text" name="button_url" value="<?php echo $index_page_option['field'.$field4];?>">
																	</div>
																</div>
															</div>
															<?php 
																$total_field += 4;
																break;
															case 'tab':
																$field1 = $total_field;
																$field2 = $total_field+1;
																$field3 = $total_field+2;
																$field4 = $total_field+3;
															?>
															<div class="index-widget media-box-widget">
																<div class="index-widget-type">tab</div>
																<div class="index-widget-remove"></div>
																<div class="index-widget-title">Tab&amp;Accordion</div>
																<div class="index-widget-content">
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Title</div>
																		<input class="widget-field" type="text" name="widget_title" value="<?php echo $index_page_option['field'.$field1];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Type</div>
																		<select class="widget-field" >
																			<option value="tab" <?php selected($index_page_option['field'.$field2],'tab');?>>Tab</option>
																			<option value="accordion" <?php selected($index_page_option['field'.$field2],'accordion');?>>Accordion</option>
																		</select>
																	</div>
																	<div style="display:none;" class="index-widget-option">
																		<div class="index-widget-option-name">Style</div>
																		<select class="widget-field" >
																			<option value="1" <?php selected($index_page_option['field'.$field3],1);?>>1</option>
																			<option value="2" <?php selected($index_page_option['field'.$field3],2);?>>2</option>
																			<option value="3" <?php selected($index_page_option['field'.$field3],3);?>>3</option>
																		</select>
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Feature Category</div>
																		<select class="widget-field" >
																			<?php if(count($feature_taxonomies )>0){
																				foreach($feature_taxonomies as $each_taxonomy){?>
																					<?php if($each_taxonomy->term_id == $index_page_option['field'.$field4]){?>
																						<option selected="selected" value="<?php echo $each_taxonomy->term_id;?>"><?php echo $each_taxonomy->name;?></option>
																					<?php }else{?>
																						<option value="<?php echo $each_taxonomy->term_id;?>"><?php echo $each_taxonomy->name;?></option>
																					<?php }?>
																				<?php }
																			}	?>
																		</select>
																	</div>
																</div>
															</div>
															<?php 
																$total_field += 4;
																break;
															case 'embed-box':
																$field1 = $total_field;
																$field2 = $total_field+1;
																$field3 = $total_field+2;
																$field4 = $total_field+3;
															?>
															<div class="index-widget embed-box-widget">
																<div class="index-widget-type">embed-box</div>
																<div class="index-widget-remove"></div>
																<div class="index-widget-title">Embed Box</div>
																<div class="index-widget-content">
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Title</div>
																		<input class="widget-field" type="text" name="widget_title" value="<?php echo $index_page_option['field'.$field1];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Embed Type</div>
																		<select class="widget-field">
																			<option value="youtube" <?php selected($index_page_option['field'.$field2],'youtube');?>>Youtube</option>
																			<option value="vimeo" <?php selected($index_page_option['field'.$field2],'vimeo');?>>Vimeo</option>
																			<option value="soundcloud" <?php selected($index_page_option['field'.$field2],'soundcloud');?>>SoundCloud</option>
																			<option value="google-map" <?php selected($index_page_option['field'.$field2],'google-map');?>>Google Map</option>
																		</select>
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Google Map Height</div>
																		<input class="widget-field" type="text" value="<?php echo $index_page_option['field'.$field3];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Embed Code</div>
																		<textarea class="widget-field" rows="4" ><?php echo $index_page_option['field'.$field4];?></textarea>
																	</div>
																</div>
															</div>
															<?php 
																$total_field += 4;
																break;
															case 'people':
																$field1 = $total_field;
																$field2 = $total_field+1;
																$field3 = $total_field+2;
																$field4 = $total_field+3;
																$field5 = $total_field+4;
															?>
															<div class="index-widget people-widget">
																<div class="index-widget-type">people</div>
																<div class="index-widget-remove"></div>
																<div class="index-widget-title">People Profile</div>
																<div class="index-widget-content">
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Title</div>
																		<input type="text" class="widget-field"  value="<?php echo $index_page_option['field'.$field1];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Image</div>
																		<input class="widget-field" type="text" value="<?php echo $index_page_option['field'.$field2];?>" />
																		<input class="upload_button" type="button" value="Upload Image" />
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Name</div>
																		<input type="text" class="widget-field"  value="<?php echo $index_page_option['field'.$field3];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Job</div>
																		<input type="text" class="widget-field"  value="<?php echo $index_page_option['field'.$field4];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Description</div>
																		<textarea rows="4" class="widget-field content_editor" ><?php echo $index_page_option['field'.$field5];?></textarea>
																	</div>
																</div>
															</div>
														<?php 
																$total_field += 5;
																break;
															case 'contact-info':
																$field1 = $total_field;
																$field2 = $total_field+1;
																$field3 = $total_field+2;
																$field4 = $total_field+3;
																$field5 = $total_field+4;
																$field6 = $total_field+5;
															?>
															<div class="index-widget contact-info-widget">
																<div class="index-widget-type">contact-info</div>
																<div class="index-widget-remove"></div>
																<div class="index-widget-title">Contact Info</div>
																<div class="index-widget-content">
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Title</div>
																		<input type="text" class="widget-field"  value="<?php echo $index_page_option['field'.$field1];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Description</div>
																		<textarea rows="4" class="widget-field content_editor" ><?php echo $index_page_option['field'.$field2];?></textarea>
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Phone Number</div>
																		<input class="widget-field" type="text"value="<?php echo $index_page_option['field'.$field3];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Fax Number</div>
																		<input type="text" class="widget-field"  value="<?php echo $index_page_option['field'.$field4];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Email</div>
																		<input type="text" class="widget-field"  value="<?php echo $index_page_option['field'.$field5];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Address</div>
																		<textarea class="widget-field" rows="4" ><?php echo $index_page_option['field'.$field6];?></textarea>
																	</div>
																	
																</div>
															</div>
														<?php 
																$total_field += 6;
																break;
															case 'contact-form':
																$field1 = $total_field;
																$field2 = $total_field+1;
																$field3 = $total_field+2;
																$field4 = $total_field+3;
																$field5 = $total_field+4;
																$field6 = $total_field+5;
																$field7 = $total_field+6;
																$field8 = $total_field+7;
															?>
															<div class="index-widget contact-form-widget">
																<div class="index-widget-type">contact-form</div>
																<div class="index-widget-remove"></div>
																<div class="index-widget-title">Contact Form</div>
																<div class="index-widget-content">
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Title</div>
																		<input type="text" class="widget-field"  value="<?php echo $index_page_option['field'.$field1];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Receive Email</div>
																		<input type="text" class="widget-field"  value="<?php echo $index_page_option['field'.$field2];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">From Description</div>
																		<textarea rows="4" class="widget-field content_editor" ><?php echo $index_page_option['field'.$field3];?></textarea>
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Name Label</div>
																		<input class="widget-field" type="text"value="<?php echo $index_page_option['field'.$field4];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Email Label</div>
																		<input type="text" class="widget-field"  value="<?php echo $index_page_option['field'.$field5];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Subject Label</div>
																		<input type="text" class="widget-field"  value="<?php echo $index_page_option['field'.$field6];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Button Label</div>
																		<input type="text" class="widget-field"  value="<?php echo $index_page_option['field'.$field7];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Successful Text</div>
																		<textarea rows="4" class="widget-field" ><?php echo $index_page_option['field'.$field8];?></textarea>
																	</div>
																</div>
															</div>
														<?php 
																$total_field += 8;
																break;
															case 'content-box':
																$field1 = $total_field;
																$field2 = $total_field+1;
															?>
															<div class="index-widget content-box-widget">
																<div class="index-widget-type">content-box</div>
																<div class="index-widget-remove"></div>
																<div class="index-widget-title">Content Box</div>
																<div class="index-widget-content">
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">Title</div>
																		<input type="text" class="widget-field"  value="<?php echo $index_page_option['field'.$field1];?>">
																	</div>
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">From Description</div>
																		<textarea rows="4" class="widget-field content_editor" ><?php echo $index_page_option['field'.$field2];?></textarea>
																	</div>
																</div>
															</div>
														<?php 
																$total_field += 2;
																break;
															case 'highlight-box':
																$field1 = $total_field;
															?>
															<div class="index-widget highlight-box-widget">
																<div class="index-widget-type">highlight-box</div>
																<div class="index-widget-remove"></div>
																<div class="index-widget-title">Highlight Box</div>
																<div class="index-widget-content">
																	<div class="index-widget-option">
																		<div class="index-widget-option-name">From Description</div>
																		<textarea rows="4" class="widget-field content_editor" ><?php echo $index_page_option['field'.$field1];?></textarea>
																	</div>
																</div>
															</div>
														<?php 
																$total_field += 1;
																break;
															case 'divider':
															?>
															<div class="index-widget divider-widget">
																<div class="index-widget-type">divider</div>
																<div class="index-widget-remove"></div>
																<div class="index-widget-title">Divider</div>
															</div>	
															<?php 
																break;
															}
														$total_widget++;	
													}?>
												</div>	
											<?php 
												echo $clear_div;
												$total_box++;
											}?>
										</div>
									</div>
								<?php }?>
							<?php }else{?>
								<div class="index-section-box">
									<div class="index-section-remove"></div>
									<div class="index-section-buttons">
										<span class="index-section-title">Index Section</span><select class="index-section-layout" name="layout">
											<option value="0" > -- Change Layout -- </option>
											<option value="1" > 1/1 </option>
											<option value="2" > 1/2 + 1/2 </option>
											<option value="3" > 1/3 + 1/3 + 1/3 </option>
											<option value="4" > 1/3 + 2/3 </option>
											<option value="5" > 2/3 + 1/3 </option>
											<option value="6" > 1/4 + 1/4 + 1/4 + 1/4 </option>
											<option value="7" >> 2/4 + 1/4 + 1/4</option>
											<option value="8" > 1/4 + 2/4 + 1/4</option>
											<option value="9" > 1/4 + 1/4 + 2/4</option>
										</select>
									</div>
									<div class="index-page-box-container">
										<div class="index-page-box">
											<div class="index-box-column">1</div>
										</div>	
										<div class="cleared"></div>
									</div>
								</div>
							<?php }?>
						</div>
					</div>
					
					<div class="admin-box-shadow">
						<div id="widget-container-title">
							Available Widgets 
							<span class="help">Drag & Drop Widgets to Content Sections</span>
						</div>
						<div id="widget-containers">
							<div class="index-widget content-box-widget">
								<div class="index-widget-type">content-box</div>
								<div class="index-widget-remove"></div>
								<div class="index-widget-title">Content Box</div>
								<div class="index-widget-note">Show Formatted Content</div>
								<div class="index-widget-content">
									<div class="index-widget-option">
										<div class="index-widget-option-name">Title</div>
										<input class="widget-field" type="text" value="">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Description</div>
										<textarea class="widget-field content_editor" rows="4" ></textarea>
									</div>
								</div>
							</div>		
							<div class="index-widget highlight-box-widget">
								<div class="index-widget-type">highlight-box</div>
								<div class="index-widget-remove"></div>
								<div class="index-widget-title">Highlight Box</div>
								<div class="index-widget-note">Show Formatted Content in Highlight Box</div>
								<div class="index-widget-content">
									<div class="index-widget-option">
										<div class="index-widget-option-name">Description</div>
										<textarea class="widget-field content_editor" rows="4" ></textarea>
									</div>
								</div>
							</div>		
							<div class="index-widget divider-widget column-last">
								<div class="index-widget-type">divider</div>
								<div class="index-widget-remove"></div>
								<div class="index-widget-title">Divider</div>
								<div class="index-widget-note">Show a divider line</div>
							</div>	
							
							<div class="cleared"></div>
							
							<div class="index-widget posts-category-widget">
								<div class="index-widget-type">category-post</div>
								<div class="index-widget-remove"></div>
								<div class="index-widget-title">Category Posts</div>
								<div class="index-widget-note">Show Latest Posts Filted by Category</div>
								<div class="index-widget-content">
									<div class="index-widget-option">
										<div class="index-widget-option-name">Title</div>
										<input class="widget-field" type="text" name="widget_title" value="Latest Posts">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Category</div>
										<select class="widget-field">
											<?php if(count($post_categories )>0){
												?>
												<option value="0">All Categories</option>
												<?php
												foreach($post_categories as $category){?>
												<option value="<?php echo $category->term_id;?>"><?php echo $category->name;?></option>
												<?php
												}
											}
											?>
										</select>
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Max Posts</div>
										<input class="widget-field" type="text" name="number_post" value="8">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Number Posts per Row</div>
										<input class="widget-field" type="text" name="post_row" value="4">
									</div>
								</div>
							</div>
							<div class="index-widget posts-category-widget">
								<div class="index-widget-type">post-list</div>
								<div class="index-widget-remove"></div>
								<div class="index-widget-title">List of Posts</div>
								<div class="index-widget-note">Show Latest Posts As a Lists</div>
								<div class="index-widget-content">
									<div class="index-widget-option">
										<div class="index-widget-option-name">Title</div>
										<input class="widget-field" type="text" name="widget_title" value="Latest Posts">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Category</div>
										<select class="widget-field">
											<?php if(count($post_categories )>0){
												?>
												<option value="0">All Categories</option>
												<?php
												foreach($post_categories as $category){?>
												<option value="<?php echo $category->term_id;?>"><?php echo $category->name;?></option>
												<?php
												}
											}
											?>
										</select>
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Max Posts</div>
										<input class="widget-field" type="text" name="number_post" value="8">
									</div>
								</div>
							</div>
							<div class="index-widget lastest-portfolio-widget column-last">
								<div class="index-widget-type">lastest-portfolio</div>
								<div class="index-widget-remove"></div>
								<div class="index-widget-title">Latest Portfolio</div>
								<div class="index-widget-note">Show Latest Portfolio</div>
								<div class="index-widget-content">
									<div class="index-widget-option">
										<div class="index-widget-option-name">Title</div>
										<input class="widget-field" type="text" name="widget_title" value="Latest Projects">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Type</div>
										<select class="widget-field" >
											<option value="2">Latest</option>
											<option value="1">Featured</option>
										</select>
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Project Category</div>
										<select class="widget-field" >
											<?php if(count($project_taxonomies )>0){
												?>
												<option value="0">All Categories</option>
												<?php
												foreach($project_taxonomies as $each_taxonomy){?>
													<option value="<?php echo $each_taxonomy->term_id;?>"><?php echo $each_taxonomy->name;?></option>
												<?php
												}
											}
											?>
										</select>
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Max Projects</div>
										<input class="widget-field" type="text" name="max_project" value="8">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Number Projects per Row</div>
										<input class="widget-field" type="text" name="project_row" value="4">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">View All Projects Label</div>
										<input class="widget-field" type="text" name="view_all_project_label" value="View All Projects">
									</div>
								</div>
							</div>
							
							<div class="cleared"></div>

							<div class="index-widget features-widget">
								<div class="index-widget-type">site-feature</div>
								<div class="index-widget-remove"></div>
								<div class="index-widget-title">Feature Boxes</div>
								<div class="index-widget-note">Show The Feature as Many columns</div>
								<div class="index-widget-content">
									<div class="index-widget-option">
										<div class="index-widget-option-name">Title</div>
										<input class="widget-field" type="text" name="widget_title" value="Why Choose Us?">
									</div>
									<div style="display:none" class="index-widget-option">
										<div class="index-widget-option-name">Content</div>
										<textarea class="widget-field" rows="4" name="feature_content"></textarea>
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Feature Category</div>
										<select class="widget-field" >
											<?php if(count($feature_taxonomies )>0){
												foreach($feature_taxonomies as $each_taxonomy){?>
												<option value="<?php echo $each_taxonomy->term_id;?>"><?php echo $each_taxonomy->name;?></option>
												<?php
												}
											}
											?>
										</select>
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Number features per Row</div>
										<input class="widget-field" type="text" name="feature_per_row" value="4">
									</div>
								</div>
							</div>
							
							<div class="index-widget partner-logo-widget">
								<div class="index-widget-type">partner-logo</div>
								<div class="index-widget-remove"></div>
								<div class="index-widget-title">Logo of Partners</div>
								<div class="index-widget-note">Show Partner Logos in Feature Category</div>
								<div class="index-widget-content">
									<div class="index-widget-option">
										<div class="index-widget-option-name">Title</div>
										<input class="widget-field" type="text" name="widget_title" value="Testimonials">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Feature Category</div>
										<select class="widget-field" >
											<?php if(count($feature_taxonomies )>0){
												foreach($feature_taxonomies as $each_taxonomy){?>
												<option value="<?php echo $each_taxonomy->term_id;?>"><?php echo $each_taxonomy->name;?></option>
												<?php
												}
											}
											?>
										</select>
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Number Logos per Row</div>
										<input class="widget-field" type="text" name="logo_per_row" value="5">
									</div>
								</div>
							</div>
							
							<div class="index-widget testimonials-widget column-last">
								<div class="index-widget-type">testimonial</div>
								<div class="index-widget-remove"></div>
								<div class="index-widget-title">Testimonials</div>
								<div class="index-widget-note">Show Testimonials in Feature Category</div>
								<div class="index-widget-content">
									<div class="index-widget-option">
										<div class="index-widget-option-name">Title</div>
										<input class="widget-field" type="text" name="widget_title" value="Testimonials">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Feature Category</div>
										<select class="widget-field" >
											<?php if(count($feature_taxonomies )>0){
												foreach($feature_taxonomies as $each_taxonomy){?>
												<option value="<?php echo $each_taxonomy->term_id;?>"><?php echo $each_taxonomy->name;?></option>
												<?php
												}
											}
											?>
										</select>
									</div>
								</div>
							</div>
											
							<div class="cleared"></div>
							
							<div class="index-widget welcome-box-widget">
								<div class="index-widget-type">welcome-box</div>
								<div class="index-widget-remove"></div>
								<div class="index-widget-title">Welcome Box</div>
								<div class="index-widget-note">Show Welcome Box</div>
								<div class="index-widget-content">
									<div class="index-widget-option">
										<div class="index-widget-option-name">Title</div>
										<input class="widget-field" type="text" name="widget_title" value="Welcome to our site!">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Content</div>
										<textarea class="widget-field content_editor" rows="4" name="welcome_box_content">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </textarea>
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Button Name</div>
										<input class="widget-field" type="text" name="button_name" value="Learn More">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Button Url</div>
										<input class="widget-field" type="text" name="button_url" value="#">
									</div>
								</div>
							</div>
							<div class="index-widget media-box-widget">
								<div class="index-widget-type">tab</div>
								<div class="index-widget-remove"></div>
								<div class="index-widget-title">Tab&amp;Accordion</div>
								<div class="index-widget-note">Show Tab or Accordion in Feature Category</div>
								<div class="index-widget-content">
									<div class="index-widget-option">
										<div class="index-widget-option-name">Title</div>
										<input class="widget-field" type="text" name="widget_title" value="Features">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Type</div>
										<select class="widget-field" >
											<option value="tab">Tab</option>
											<option value="accordion">Accordion</option>
										</select>
									</div>
									<div class="index-widget-option" style="display:none;">
										<div class="index-widget-option-name">Style</div>
										<select class="widget-field" >
											<option value="1">1</option>
											<option value="1">2</option>
											<option value="1">3</option>
										</select>
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Feature Category</div>
										<select class="widget-field" >
											<?php if(count($feature_taxonomies )>0){
												foreach($feature_taxonomies as $each_taxonomy){?>
												<option value="<?php echo $each_taxonomy->term_id;?>"><?php echo $each_taxonomy->name;?></option>
												<?php }
											}	?>
										</select>
									</div>
								</div>
							</div>
							
							<div class="index-widget embed-box-widget column-last">
								<div class="index-widget-type">embed-box</div>
								<div class="index-widget-remove"></div>
								<div class="index-widget-title">Embed Box</div>
								<div class="index-widget-note">Show Youtube,Vimeo,SoundCloud &amp; Google Map</div>
								<div class="index-widget-content">
									<div class="index-widget-option">
										<div class="index-widget-option-name">Title</div>
										<input class="widget-field" type="text" name="widget_title" value="">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Embed Type</div>
										<select class="widget-field" >
											<option value="youtube">Youtube</option>
											<option value="vimeo">Vimeo</option>
											<option value="soundcloud">SoundCloud</option>
											<option value="google-map">Google Map</option>
										</select>
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Google Map Height</div>
										<input class="widget-field" type="text" value="300">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Embed Code</div>
										<textarea class="widget-field" rows="4" ></textarea>
									</div>
								</div>
							</div>
							
							<div class="cleared"></div>
							
							<div class="index-widget people-widget">
								<div class="index-widget-type">people</div>
								<div class="index-widget-remove"></div>
								<div class="index-widget-title">People Profile</div>
								<div class="index-widget-note">Show People Profile</div>
								<div class="index-widget-content">
									<div class="index-widget-option">
										<div class="index-widget-option-name">Title</div>
										<input type="text" class="widget-field"  value="">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Image</div>
										<input class="widget-field" type="text" value="" />
										<input class="upload_button" type="button" value="Upload Image" />
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Name</div>
										<input type="text" class="widget-field"  value="John Doe">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Job</div>
										<input type="text" class="widget-field"  value="Wordpress Designer">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Description</div>
										<textarea rows="4" class="widget-field content_editor" ></textarea>
									</div>
								</div>
							</div>
							
							<div class="index-widget contact-info-widget">
								<div class="index-widget-type">contact-info</div>
								<div class="index-widget-remove"></div>
								<div class="index-widget-title">Contact Info</div>
								<div class="index-widget-note">Show Contact Info List</div>
								<div class="index-widget-content">
									<div class="index-widget-option">
										<div class="index-widget-option-name">Title</div>
										<input class="widget-field" type="text" value="Contact Informations">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Description</div>
										<textarea class="widget-field content_editor" rows="4" ></textarea>
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Phone Number</div>
										<input class="widget-field" type="text"value="000 000 000">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Fax Number</div>
										<input class="widget-field" type="text" value="000 000 000">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Email</div>
										<input class="widget-field" type="text" value="admin@site.com">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Address</div>
										<textarea class="widget-field" rows="4" ></textarea>
									</div>
								</div>
							</div>
							
							
							
							<div class="index-widget contact-form-widget column-last">
								<div class="index-widget-type">contact-form</div>
								<div class="index-widget-remove"></div>
								<div class="index-widget-title">Contact Form</div>
								<div class="index-widget-note">Show Contact Form</div>
								<div class="index-widget-content">
									<div class="index-widget-option">
										<div class="index-widget-option-name">Title</div>
										<input class="widget-field" type="text" value="">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Receive Email</div>
										<input class="widget-field" type="text" value="">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">From Description</div>
										<textarea class="widget-field content_editor" rows="4" ></textarea>
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Name Label</div>
										<input class="widget-field" type="text" value="Name">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Email Label</div>
										<input class="widget-field" type="text" value="Email">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Subject Label</div>
										<input class="widget-field" type="text" value="Subject">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Button Label</div>
										<input type="text" class="widget-field"  value="Send">
									</div>
									<div class="index-widget-option">
										<div class="index-widget-option-name">Successful Text</div>
										<textarea class="widget-field" rows="4" >
											Thanks for contact us! We will reply asap!
										</textarea>
									</div>
								</div>
							</div>		
													
							
							<div class="cleared"></div>
							
						</div>
						
						<div id="wope_editor_container"> 
							<?php wp_editor( '', 'wope_editor', $settings = array( 'textarea_rows' => 8, 'editor_class' => 'editor_class') ); ?>
							<div style="padding-top:24px;clear:both;">
								<span id="update_wope_editor" class="button">Update</span>
								<span id="close_wope_editor" class="button">Close</span>
							</div>
						</div>
						
						<div id="wope_overlay"></div>
						
					</div>