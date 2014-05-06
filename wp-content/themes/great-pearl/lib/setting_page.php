<?php
//load color functions
	if($_POST){
		global $wpdb;
		//Main options
		$main_option_array = array(
			'responsive' 		=> check_post('responsive'),
			'logo_hd' 			=> check_post('logo_hd'),
			'logo_hd_width' 	=> check_post('logo_hd_width'),
			'logo_hd_height' 	=> check_post('logo_hd_height'),
			'logo_url' 			=> check_post('logo_url'),
			'favicon_url' 		=> check_post('favicon_url'),
			'site-layout' 		=> check_post('site-layout'),
			'copyright' 		=> check_post('copyright'),
			'tracking_code' 	=> check_post('tracking_code'),
		);
		update_option( 'wope-main', $main_option_array);
		
		//Socials options
		$social_option_array = array(
			'rss'			=> check_post('rss'),
			'behance' 		=> check_post('behance'),
			'facebook' 		=> check_post('facebook'),
			'digg' 			=> check_post('digg'),
			'flickr' 		=> check_post('flickr'),
			'google' 		=> check_post('google'),
			'pinterest' 	=> check_post('pinterest'),
			'stumbleupon' 	=> check_post('stumbleupon'),
			'tumblr' 		=> check_post('tumblr'),
			'twitter' 		=> check_post('twitter'),
			'vimeo' 		=> check_post('vimeo'),
			'soundcloud' 	=> check_post('soundcloud'),
		);
		update_option( 'wope-social', $social_option_array);
		
		//post options
		$post_option_array = array(
			'meta_option'			=> check_post('meta_option'),
			'tag_option'			=> check_post('tag_option'),
			'excerpt_length' 		=> check_post('excerpt_length'),
			'excerpt_suffix' 		=> check_post('excerpt_suffix'),
			'readmore_label' 		=> check_post('readmore_label'),
			'comment_form_title' 	=> check_post('comment_form_title'),
			'comment_form_note' 	=> check_post('comment_form_note'),
			'submit_comment_name' 	=> check_post('submit_comment_name'),
		);
		update_option( 'wope-post', $post_option_array);
		
		//project options
		$project_option_array = array(
			'project_page_title'	=> check_post('project_page_title'),
			'project_page_sub_title'=> check_post('project_page_sub_title'),
			'project_per_page'		=> check_post('project_per_page'),
			'portfolio_column'		=> check_post('portfolio_column'),
			'project_comment'		=> check_post('project_comment'),
			'project_relative'		=> check_post('project_relative'),
		);
		update_option( 'wope-project', $project_option_array);
		
		//sidebar options
		$sidebar_option_array = array(
			'use_index_sidebar'		=> check_post('use_index_sidebar'),
			'index_sidebar'			=> check_post('index_sidebar'),
			'page_sidebar' 			=> check_post('page_sidebar'),
			'category_sidebar' 		=> check_post('category_sidebar'),
			'single_sidebar' 		=> check_post('single_sidebar'),
			'use_portfolio_sidebar' => check_post('use_portfolio_sidebar'),
			'portfolio_sidebar' 	=> check_post('portfolio_sidebar'),
			'index_footer_sidebar' 	=> check_post('index_footer_sidebar'),
			'inner_footer_sidebar' 	=> check_post('inner_footer_sidebar'),
		);
		update_option( 'wope-sidebar', $sidebar_option_array);
		
		//add new sidebar
		if($_POST['new_page'] != 0){
			if(trim($_POST['new_sidebar']) != ''){
				$custom_sidebar_option = get_option('wope-custom-sidebar');
				$custom_sidebar_option[$_POST['new_page']]['name'] = trim($_POST['new_sidebar']);
				$custom_sidebar_option[$_POST['new_page']]['slug'] = convert_slug(trim($_POST['new_sidebar']));
				update_option( 'wope-custom-sidebar', $custom_sidebar_option);
			}
		}
		
		//update sidebar
		if($_POST['update_page'] != 0){
			if(trim($_POST['update_sidebar']) != '0'){
				$custom_sidebar_option = get_option('wope-custom-sidebar');
				$custom_sidebar_option[$_POST['update_page']]['name'] = trim($_POST['update_sidebar']);
				$custom_sidebar_option[$_POST['update_page']]['slug'] = convert_slug(trim($_POST['update_sidebar']));
				update_option( 'wope-custom-sidebar', $custom_sidebar_option);
			}else{
				$custom_sidebar_option = get_option('wope-custom-sidebar');
				unset($custom_sidebar_option[$_POST['update_page']]);
				update_option( 'wope-custom-sidebar', $custom_sidebar_option);
			}
		}
		
		
		$font_option_array = array(
			'font_set' => check_post('font_set'),
		);
		update_option( 'wope-font', $font_option_array);
		
		$color_option_array = array(
			'current-color' => check_post('current-color'),
		);
		update_option( 'wope-color', $color_option_array);
		
		//add new color css file
		$color_options = get_option('wope-color');
		global $current_color;
		$current_color = $color_options['current-color'];
		get_template_part('lib'.DS."color_pattern");
		
		$background_option_array = array(
			'bg-type' 				=> check_post('bg-type'),
			'bg-color' 				=> check_post('bg-color'),
			'bg-pattern' 			=> check_post('bg-pattern'),
			'bg-upload-url'		 	=> check_post('bg-upload-url'),
			'bg-upload-repeat' 		=> check_post('bg-upload-repeat'),
			'bg-upload-position-x'	=> check_post('bg-upload-position-x'),
			'bg-upload-position-y' 	=> check_post('bg-upload-position-y'),
			'bg-upload-fixed'		=> check_post('bg-upload-fixed'),
		);
		update_option( 'wope-background', $background_option_array);
		
		$msg = "Settings saved.";
		
	}
	
	$main_option = get_option('wope-main');
	$social_option = get_option('wope-social');
	$post_option = get_option('wope-post');
	$meta_option['categories'] = '';
	$meta_option['author'] = '';
	$meta_option['date'] = '';
	$meta_option['comment_number'] = '';
	if(count($post_option['meta_option'])>0){
		foreach($post_option['meta_option'] as $each_meta){
			$meta_option[$each_meta] = 'checked="checked"';
		}
	}
	
	//index option
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
	
	//get feature categories
	$args = array(
		'type'		 =>'feature',
		'taxonomy'   => 'feature-category',
		'hide_empty' => '0'
	); 
	$feature_taxonomies = get_categories($args); 

	
	
	$project_options = get_option('wope-project');
	$sidebar_options = get_option('wope-sidebar');
	$custom_sidebar_option = get_option('wope-custom-sidebar');
	$font_options = get_option('wope-font');
	$color_options = get_option('wope-color');
	if($color_options['current-color']){
		$color_scheme_style = 'style="background-color:#'.$color_options['current-color'].'" ';
	}
	$background_options = get_option('wope-background');
	
	
	//sidebar
	$sidebar = array(
		'index-sidebar' => 'Index Sidebar',
		'inner-sidebar' => 'Inner Sidebar',
		'post-sidebar' => 'Post Sidebar',
		'project-sidebar' => 'Project Sidebar',
		'footer-sidebar' => 'Footer',
		'footer-sidebar2' => 'Footer Inner',
	);
	
	function sidebar_selector($sidebar,$current,$select_name){
		?>
			<select name="<?php echo $select_name;?>">
		<?php
			foreach($sidebar as $key => $each_sidebar){
				if($current == $key){
		?>
					<option selected="selected" value="<?php echo $key;?>"><?php echo $each_sidebar;?></option>
		<?php	
				}else{
		?>
					<option value="<?php echo $key;?>"><?php echo $each_sidebar;?></option>
		<?php
				}
			}
		?>
			</select>
		<?php
	}
	
	$all_pages = get_pages( $args );
	
	function page_selector($pages,$current,$select_name){
		?>
			<select name="<?php echo $select_name;?>">
				<option value="0"> -- Choose Page -- </option>
		<?php
			foreach($pages as $each_page){
				if($current == $each_page->ID){
		?>
					<option selected="selected" value="<?php echo $each_page->ID;?>"><?php echo $each_page->post_title;?></option>
		<?php	
				}else{
		?>
					<option value="<?php echo $each_page->ID;?>"><?php echo $each_page->post_title;?></option>
		<?php
				}
			}
		?>
			</select>
		<?php
	}
?>
<form action="" id="wope_option_form" method="post">
	<div class="wrap">
		
		<div class="admin-logo">
			<img src="<?php echo get_template_directory_uri();?>/images/admin-logo.png">
		</div>
		
		<div id="option-area">
			<div id="option-tab-buttons">
				<div class="tab-current" id="option-tab-main">
					<a href="#main">Main</a> 
				</div>
				<div id="option-tab-sidebar">
					<a href="#sidebar">Sidebar </a> 
				</div>
				<div id="option-tab-custom-sidebar">
					<a href="#custom-sidebar">Custom Sidebar </a> 
				</div>
				<div id="option-tab-color">
					<a href="#color">Color Scheme</a> 
				</div>
				<div id="option-tab-font">
					<a href="#font">Typography</a> 
				</div>
				<div id="option-tab-background">
					<a href="#background">Background</a> 
				</div>
				<div id="option-tab-blog">
					<a href="#blog">Blog </a> 
				</div>
				<div id="option-tab-portfolio">
					<a href="#portfolio">Portfolio </a> 
				</div>
				<div id="option-tab-social">
					<a href="#social">Social Links</a> 
				</div>
			</div>
			<div id="option-tab-container">
				<div class="option-section">
					<?php if(isset($msg)){?>
						<div class="input-section">
							<div class="msg">
								<?php echo $msg;?>
							</div>
						</div>
					<?php }?>
					<button class="form-submit-button" > Save Changes </button>
				</div>
					
				<div class="option-tab tab-current" id="option-tab-main-content">
					<div class="option-section">
						<h3><span>Site Logo</span></h3>
						<div class="column2">
							<input class="upload_field" type="text" size="36" name="logo_url" value="<?php if(isset($main_option['logo_url'])) echo $main_option['logo_url'];?>" />
							<input class="upload_button" type="button" value="Upload Image" />
							<div class="help">Enter an URL or upload an image for the logo.</div>
						</div>
						<div class="column2 column_last">
							<?php if(isset($main_option['logo_url'])){?>
							<img class="uploaded_image" src="<?php echo $main_option['logo_url'];?>">
							<?php }?>
						</div>
						<div class="cleared"></div>
						
						<div class="input-section">
							<input type="checkbox" name="logo_hd" id="logo_hd" value="1" <?php echo checked($main_option['logo_hd'],1);?>><label for="logo_hd">Enable Logo HD</label>
							<div class="help">It mean your logo will display better in High-definition devices such as Retina on Iphone4, Iphone5 , Ipad3,ipad4 ...ect<br>
							You need to upload a logo bigger than original 200% width and height. and enter your logo's original size so it will display normally in desktop , laptop.<br>
							For example if your logo is 200px*80px , you need to create new logo have size 400px * 160px or larger . then enter logo hd width 200px , logo hd height 80px in below inputs.
							</div>
						</div>
						
						<div class="input-section">
							Logo HD width <br>
							<input type="text" name="logo_hd_width" class="normal_input" value="<?php echo $main_option['logo_hd_width'];?>">
						</div>
						<div class="input-section">
							Logo HD height <br>
							<input type="text" name="logo_hd_height" class="normal_input" value="<?php echo $main_option['logo_hd_height'];?>">
						</div>
					</div>
					<div class="option-section">
						<h3><span>Favicon</span></h3>
						<div class="column2">
							<input class="upload_field" type="text" size="36" name="favicon_url" value="<?php echo $main_option['favicon_url'];?>" />
							<input class="upload_button" type="button" value="Upload Image" />
							<div class="help">Enter an URL or upload an image for the Favicon Icon.</div>
						</div>
						<div class="column2 column_last">
						<?php if(isset($main_option['favicon_url'])){?>
							<img class="uploaded_image" src="<?php echo $main_option['favicon_url'];?>">
						<?php }?>
						</div>
						<div class="cleared"></div>
					</div>
					
					<div class="option-section">
						<h3><span>Site Layout</span></h3>
						<div class="column2">
							<input type="radio" name="site-layout" id="layout-fullscreen" value="1" <?php checked($main_option['site-layout'],1);?>><label for="layout-fullscreen">Full Screen</label>
							<input type="radio" name="site-layout" id="layout-boxed" value="2" <?php checked($main_option['site-layout'],2);?> ><label for="layout-boxed">Boxed</label>
						</div>
						<div class="column2 column_last">
							<div class="help">The fullscreen layout will have white space and no background.</div>
						</div>
						<div class="cleared"></div>
					</div>
					
					<div class="option-section">
						<h3><span>Responsive</span></h3>
						<input type="checkbox" name="responsive" id="responsive" value="1" <?php echo checked($main_option['responsive'],1);?>><label for="responsive">Turn on Responsive</label>
					</div>

					<div class="option-section">
						<h3><span>Copyright Info</span></h3>
						<div class="help">The Copyright text to display in the Footer.</div>
						<?php wp_editor( $main_option['copyright'], 'copyright_editor', $settings = array( 'textarea_rows' => 8, 'textarea_name' => 'copyright') ); ?>
					</div>
					
					<div class="option-section">
						<h3><span>Tracking Code</span></h3>
						<div class="column2">
							<textarea rows="5" name="tracking_code" class="normal_textarea"><?php echo $main_option['tracking_code'];?></textarea>
						</div>
						<div class="column2 column_last">
							<div class="help">The Tracking Code to include before &lt;/BODY&gt; such as Google Analytics... ect</div>
						</div>
						<div class="cleared"></div>
					</div>
				</div>
				<div class="option-tab" id="option-tab-sidebar-content">
					<div class="option-section">
						<div class="column2">
							<h3><span>Index Sidebar</span></h3>
							<div class="input-section">
								<input type="checkbox" name="use_index_sidebar" id="use_index_sidebar" value="1" <?php checked($sidebar_options['use_index_sidebar'],1);?>><label for="use_index_sidebar">Use Index Sidebar</label><br>
							</div>
							<?php sidebar_selector($sidebar,$sidebar_options['index_sidebar'],'index_sidebar');?>
							<div class="help">The default Index Page have one column and no sidebar. Use Index Sidebar mean the Index page will have 2 columns with one sidebar in right column</div>
						</div>
						<div class="column2 column_last">
							<h3><span>Right Sidebar Page</span></h3>
							<?php sidebar_selector($sidebar,$sidebar_options['page_sidebar'],'page_sidebar');?>
							<div class="help">Choose sidebar for Page Template name "Right Sidebar". The full column Page (no sidebar) is Default Page Template.</div>
						</div>
						<div class="cleared"></div>
					</div>
					<div class="option-section">
						<div class="column2">
							<h3><span>Category Sidebar</span></h3>
							<?php sidebar_selector($sidebar,$sidebar_options['category_sidebar'],'category_sidebar');?>
							<div class="help">Choose sidebar for Category,Archive,Tag,Author Page.</div>
						</div>
						<div class="column2 column_last">
							<h3><span>Single Blog Sidebar</span></h3>
							<?php sidebar_selector($sidebar,$sidebar_options['single_sidebar'],'single_sidebar');?>
							<div class="help">Choose sidebar for Single Blog Page.</div>
						</div>
						<div class="cleared"></div>
					</div>
					<div class="option-section">
						<div class="column2">
							<h3><span>Portfolio Sidebar</span></h3>
							<div class="input-section">
								<input type="checkbox" name="use_portfolio_sidebar" id="use_portfolio_sidebar" value="1" <?php checked($sidebar_options['use_portfolio_sidebar'],1);?>><label for="use_portfolio_sidebar">Use Portfolio Sidebar</label>
							</div>
							<div class="input-section">
								<?php sidebar_selector($sidebar,$sidebar_options['portfolio_sidebar'],'portfolio_sidebar');?>
								<div class="help">choose Sidebar for Portfolio Page.</div>
							</div>
						</div>
						<div class="column2 column_last">
							<h3><span>Index Footer</span></h3>
							<?php sidebar_selector($sidebar,$sidebar_options['index_footer_sidebar'],'index_footer_sidebar');?>
							<div class="help">Choose Footer for Index Page.</div>
						</div>
						<div class="cleared"></div>
					</div>
					<div class="option-section">
						<div class="column2">
							<h3><span>Inner Footer</span></h3>
							<?php sidebar_selector($sidebar,$sidebar_options['inner_footer_sidebar'],'inner_footer_sidebar');?>
							<div class="help">Choose Footer for all other Pages.</div>
						</div>
						<div class="column2 column_last">
							
						</div>
						<div class="cleared"></div>
					</div>
				</div>
				<div class="option-tab" id="option-tab-custom-sidebar-content">
					<div class="option-section">
						<h3><span>Add New Sidebar</span></h3>
						<div class="column2">
							<strong>Choose Page</strong><br>
							<?php page_selector($all_pages,0,'new_page');?>
						</div>
						<div class="column2 column_last">
							<strong>Sidebar Name</strong><br>
							<input type="text" name="new_sidebar" class="normal_input" value="">
						</div>
						<div class="cleared"></div>
					</div>
					<div class="option-section">
						<h3><span>Update Sidebar</span></h3>
						<div class="column2">
							<strong>Choose Page</strong><br>
							<?php page_selector($all_pages,0,'update_page');?>
						</div>
						<div class="column2 column_last">
							<strong>Choose Sidebar</strong><br>
							<?php if(is_array($custom_sidebar_option)){
								$unique_array = array();
							?>
							<select name="update_sidebar">
								<option value="0">No Sidebar</option>
								<?php foreach($custom_sidebar_option as $key=>$each_sidebar){
									if(!in_array($each_sidebar['name'],$unique_array)){
								?>
									<option value="<?php echo $each_sidebar['name'];?>"><?php echo $each_sidebar['name'];?></option>
								<?php 
										$unique_array[] = $each_sidebar['name'];
									}
								}?>
							</select>
							<?php }?>
						</div>
						<div class="cleared"></div>
					</div>
					<div class="option-section">
						<h3><span>All Created Sidebars</span></h3>
						<?php if(is_array($custom_sidebar_option)){?>
						<table class="list-table">
							<thead>
								<tr>
									<td>Page</td>
									<td>Sidebar Name</td>
								</tr>
							</thead>
							<tbody>
							<?php foreach($custom_sidebar_option as $key=>$each_sidebar){
								$page = get_page( $key);
								if(!empty($page->ID)){
							?>
								<tr>
									<td>
										<a href="<?php echo get_permalink($page->ID);?>"><?php echo $page->post_title;?></a>
									</td>
									<td>
										<?php echo $each_sidebar['name'];?>
									</td>
								</tr>
							<?php 
									}
								}?>
							</tbody>
						</table>
						<?php }?>
						
					</div>
				</div>
				<div class="option-tab" id="option-tab-color-content">
					<div class="option-section">
						<h3><span>Current Color</span></h3>
						<div class="column2">
							<span class="color-scheme" <?php echo $color_scheme_style;?> id="current-color-scheme">
								<span>Main Color</span>
							</span>
							<input id="current-color" class="color-picker" name="current-color" style="width:60px"  type="text" value="<?php echo $color_options['current-color'];?>" />
						</div>
						<div class="column2 column_last">
							<div class="help">Choose a predefined color scheme or choose a color to match your brand.</div>
						</div>
						<div class="cleared"></div>
					</div>
					
					<div class="option-section">
						<h3><span>Predefined Color Schemes</span></h3>
						<span class="color-scheme color-yellow">
							<span>Yellow</span>
							<span class="color-code">fac30c</span>
						</span>
						<span class="color-scheme color-brown">
							<span>Brown</span>
							<span class="color-code">a34912</span>
						</span>
						<span class="color-scheme color-dark-pink">
							<span>Dark Pink</span>
							<span class="color-code">ec2771</span>
						</span>
						<span class="color-scheme color-purple">
							<span>Purple</span>
							<span class="color-code">5a31c2</span>
						</span>
						<span class="color-scheme color-blue">
							<span>Blue</span>
							<span class="color-code">0a85cc</span>
						</span>
						<span class="color-scheme color-aqua-green">
							<span>Aqua Green</span>
							<span class="color-code">23d777</span>
						</span>	
						<span class="color-scheme color-light-lime">
							<span>Light Lime</span>
							<span class="color-code">80d04f</span>
						</span>
						<span class="color-scheme color-orange">
							<span>Orange</span>
							<span class="color-code">ff5e0d</span>
						</span>
						<span class="color-scheme color-red">
							<span>Red</span>
							<span class="color-code">e50b0b</span>
						</span>
						<span class="color-scheme color-pink">
							<span>Pink</span>
							<span class="color-code">e139a4</span>
						</span>
						<span class="color-scheme color-light-blue">
							<span>Light Blue</span>
							<span class="color-code">4666de</span>
						</span>
						<span class="color-scheme color-dark-aqua">
							<span>Dark Aqua</span>
							<span class="color-code">08a3a6</span>
						</span>
						<span class="color-scheme color-green">
							<span>Green</span>
							<span class="color-code">0eb51a</span>
						</span>	
						<span class="color-scheme color-yellow-green">
							<span>Yellow Green</span>
							<span class="color-code">bbd81b</span>
						</span>
						
						<span class="color-scheme color-red-orange">
							<span>Red Orange</span>
							<span class="color-code">e74a13</span>
						</span>
						
						
							
						<span class="color-scheme color-light-red">
							<span>Light Red</span>
							<span class="color-code">ec4747</span>
						</span>
						
						<span class="color-scheme color-violet">
							<span>Violet</span>
							<span class="color-code">d219d9</span>
						</span>
						
						<span class="color-scheme color-dark-blue">
							<span>Dark Blue</span>
							<span class="color-code">0e3eb5</span>
						</span>

						
						<span class="color-scheme color-aqua">
							<span>Aqua</span>
							<span class="color-code">21c0d9</span>
						</span>
						
						<span class="color-scheme color-lime">
							<span>Lime</span>
							<span class="color-code">78b312</span>
						</span>
						
						<span class="color-scheme color-gray">
							<span>Gray</span>
							<span class="color-code">404040</span>
						</span>
					</div>
				</div>
				<div class="option-tab" id="option-tab-font-content">
					<div class="option-section">
						<h3><span>Font Set</span></h3>

						<div class="column2">
							<select name="font_set">
								<option value="standard" <?php selected($font_options['font_set'],'standard');?>>Standard</option>
								<option value="adamina" <?php selected($font_options['font_set'],'adamina');?>>Adamina</option>
								<option value="bree" <?php selected($font_options['font_set'],'bree');?>>Bree Serif</option>
								<option value="merriweather" <?php selected($font_options['font_set'],'merriweather');?>>Merriweather</option>
								<option value="molengo" <?php selected($font_options['font_set'],'molengo');?>>Molengo</option>
								<option value="old-standard" <?php selected($font_options['font_set'],'old-standard');?>>Old Standard</option>
								<option value="playfair" <?php selected($font_options['font_set'],'playfair');?>>Playfair Display</option>
								<option value="rambla" <?php selected($font_options['font_set'],'rambla');?>>Rambla</option>
								<option value="titillium" <?php echo selected($font_options['font_set'],'titillium');?>>Titillium Web</option>
								<option value="crimson" <?php echo selected($font_options['font_set'],'crimson');?>>Crimson Text</option>
								<option value="patua-one" <?php echo selected($font_options['font_set'],'patua-one');?>>Patua One</option>
								<option value="trocchi" <?php echo selected($font_options['font_set'],'trocchi');?>>Trocchi</option>
								<option value="oswald" <?php echo selected($font_options['font_set'],'oswald');?>>Oswald</option>
								<option value="nixie-one" <?php echo selected($font_options['font_set'],'nixie-one');?>>Nixie One</option>
								<option value="lora" <?php echo selected($font_options['font_set'],'lora');?>>Lora</option>
								<option value="lobster" <?php echo selected($font_options['font_set'],'lobster');?>>Lobster</option>
								<option value="kotta-one" <?php echo selected($font_options['font_set'],'kotta-one');?>>Kotta One</option>
								<option value="text-me-one" <?php echo selected($font_options['font_set'],'text-me-one');?>>Text Me One</option>
								<option value="domine" <?php echo selected($font_options['font_set'],'domine');?>>Domine</option>
							</select>
							
						</div>
						<div class="column2 column_last">
							<div class="help">Choose a Set of Fonts. Each Set of font will have primary font and secondary font.</div>
						</div>
						<div class="cleared"></div>

					</div>
		
				</div>
				
				<div class="option-tab" id="option-tab-background-content">
					
					<div class="option-section">
						<h3><span>Background Type</span></h3>
						<div class="column2">
							<input type="radio" name="bg-type" id="bg-type-color" value="1" <?php checked($background_options['bg-type'],1);?>><label for="bg-type-color">Color</label>
							<input type="radio" name="bg-type" id="bg-type-pattern" value="2" <?php checked($background_options['bg-type'],2);?> ><label for="bg-type-pattern">Pattern</label>
							<input type="radio" name="bg-type" id="bg-type-upload" value="3" <?php checked($background_options['bg-type'],3);?> ><label for="bg-type-upload">Uploaded Background</label>
						</div>
						<div class="column2 column_last">
							<div class="help">Choose the background type for your site. The Background only be used in Boxed Site Layout</div>
						</div>
						<div class="cleared"></div>
					</div>
					
					<div class="option-section">
						<h3><span>Background Color</span></h3>
						<div class="column2">
							<input class="color-picker" name="bg-color" style="width:60px"  type="text" value="<?php echo $background_options['bg-color'];?>" />
						</div>
						<div class="column2 column_last">
							
						</div>
						<div class="cleared"></div>
					</div>
					
					<div class="option-section">
						<h3><span>Background Pattern</span></h3>
						<?php for($b = 1;$b <= 20 ; $b++){
							if('bg'.$b == $background_options['bg-pattern']){
								$pattern_class = "bg-pattern-selected";
							}else{
								$pattern_class = "";
							}
						?>
						<img class="bg-pattern-select <?php echo $pattern_class;?>" id="bg<?php echo $b;?>" src="<?php echo get_template_directory_uri();?>/images/backgrounds/demo/bg<?php echo $b;?>.png">
						<?php }?>
						<input type="hidden" name="bg-pattern" id="bg-pattern" value="<?php echo $background_options['bg-pattern'];?>">
					</div>
					
					<div class="option-section">
						<h3><span>Upload Your Background</span></h3>
						<div class="column2">
							<input class="upload_field" type="text" size="36" name="bg-upload-url" value="<?php echo $background_options['bg-upload-url'];?>" />
							<input class="upload_button" type="button" value="Upload Image" />
							<div class="help">Enter an URL or upload an image for the background.</div>
							
							<div class="option-section" style="padding-top:12px;">
								<strong>Repeat</strong><br>
								<input type="radio" name="bg-upload-repeat" id="bg-repeat-all" value="repeat" <?php checked($background_options['bg-upload-repeat'],'repeat');?>><label for="bg-repeat-all">Repeat</label> 
								<input type="radio" name="bg-upload-repeat" id="bg-repeat-x" value="repeat-x" <?php checked($background_options['bg-upload-repeat'],'repeat-x');?> ><label for="bg-repeat-x">Repeat horizontal</label> 
								<input type="radio" name="bg-upload-repeat" id="bg-repeat-y" value="repeat-y" <?php checked($background_options['bg-upload-repeat'],'repeat-y');?> ><label for="bg-repeat-y">Repeat vertical</label> 
								<input type="radio" name="bg-upload-repeat" id="bg-repeat-no" value="no-repeat" <?php checked($background_options['bg-upload-repeat'],'no-repeat');?> ><label for="bg-repeat-no">No repeat</label>
							</div>

							<div class="option-section">
								<strong>Background Attachment</strong><br>
								<input type="checkbox" name="bg-upload-fixed" id="bg-upload-fixed" value="1" <?php checked($background_options['bg-upload-fixed'],1);?>><label for="bg-upload-fixed">Fixed</label>
							</div>
							
							<div class="option-section">		
								<strong>Position Horizontal</strong><br>
								<input type="radio" name="bg-upload-position-x" id="bg-position-x-left" value="left" <?php checked($background_options['bg-upload-position-x'],'left');?>><label for="bg-position-x-left">Left</label> 
								<input type="radio" name="bg-upload-position-x" id="bg-position-x-right" value="right" <?php checked($background_options['bg-upload-position-x'],'right');?> ><label for="bg-position-x-right">Right</label> 
								<input type="radio" name="bg-upload-position-x" id="bg-position-x-center" value="center" <?php checked($background_options['bg-upload-position-x'],'center');?> ><label for="bg-position-x-center">Center</label> 
							</div>
								
							<div class="option-section">	
								<strong>Position Vertical</strong><br>
								<input type="radio" name="bg-upload-position-y" id="bg-position-y-top" value="top" <?php checked($background_options['bg-upload-position-y'],'left');?>><label for="bg-position-y-top">Top</label> 
								<input type="radio" name="bg-upload-position-y" id="bg-position-y-bottom" value="bottom" <?php checked($background_options['bg-upload-position-y'],'right');?> ><label for="bg-position-y-bottom">Bottom</label> 
								<input type="radio" name="bg-upload-position-y" id="bg-position-y-center" value="center" <?php checked($background_options['bg-upload-position-y'],'center');?> ><label for="bg-position-y-center">Center</label>
							</div>
								
						</div>
						<div class="column2 column_last">
							<div class="bg-uploaded">
								<img class="uploaded_image" src="<?php echo $background_options['bg-upload-url'];?>">
							</div>
						</div>
						<div class="cleared"></div>
					</div>
					
					
				</div>
				
				<div class="option-tab" id="option-tab-blog-content">
					<div class="option-section">
						<h3><span>Meta Options </span></h3>
						<div class="column2">
							<input type="checkbox" name="meta_option[]" id="meta_categories" value="categories" <?php echo $meta_option['categories'];?>><label for="meta_categories">Show Categories</label><br>
							<input type="checkbox" name="meta_option[]" id="meta_author" value="author" <?php echo $meta_option['author'];?>><label for="meta_author">Show Author</label><br>
							<input type="checkbox" name="meta_option[]" id="meta_date" value="date" <?php echo $meta_option['date'];?>><label for="meta_date">Show Date</label><br>
							<input type="checkbox" name="meta_option[]" id="meta_comment_number" value="comment_number" <?php echo $meta_option['comment_number'];?>><label for="meta_comment_number">Show Comment Numbers</label><br>
							<input type="checkbox" name="tag_option" id="tag_option" value="1" <?php checked($post_option['tag_option'],1);?>><label for="tag_option">Show Tags</label>
						</div>
						<div class="column2 column_last">
							<div class="help">Choose which Post's metas of each post to show in the Category , Archive , Author , Tag and Single Page</div>
						</div>
						<div class="cleared"></div>
					</div>

					<div class="option-section">
						<h3><span>Excerpt Length in Index</span></h3>
						<div class="column2">
							<input type="text" name="excerpt_length" class="normal_input" value="<?php echo $post_option['excerpt_length'];?>">
						</div>
						<div class="column2 column_last">
							<div class="help">The Excerpt length of Post when show in Index Page</div>
						</div>
						<div class="cleared"></div>
					</div>
					
					<div class="option-section">
						<h3><span>Excerpt Suffix in Index</span></h3>
						<div class="column2">
							<input type="text" name="excerpt_suffix" class="normal_input" value="<?php echo $post_option['excerpt_suffix'];?>">
						</div>
						<div class="column2 column_last">
							<div class="help">The text,string,dot...ect in the end of Exceprt of Post in the Index Page</div>
						</div>
						<div class="cleared"></div>
					</div>
					
					<div class="option-section">
						<h3><span>Read More Label</span></h3>
						<div class="column2">
							<input type="text" name="readmore_label" class="normal_input" value="<?php echo $post_option['readmore_label'];?>">
						</div>
						<div class="column2 column_last">
							<div class="help">The Label for Read More link. Default is "Continous Reading →"</div>
						</div>
						<div class="cleared"></div>
					</div>
					
					<div class="option-section">
						<h3><span>Comment Form Title</span></h3>
						<div class="column2">
							<input type="text" name="comment_form_title" class="normal_input" value="<?php echo $post_option['comment_form_title'];?>">
						</div>
						<div class="column2 column_last">
							<div class="help">The Title for Comment form. Default is "Leave a Reply"</div>
						</div>
						<div class="cleared"></div>
					</div>
					
					<div class="option-section">
						<h3><span>Comment Form Note Text</span></h3>
						<div class="column2">
							<textarea rows="5" name="comment_form_note" class="normal_textarea"><?php echo $post_option['comment_form_note'];?></textarea>
						</div>
						<div class="column2 column_last">
							<div class="help">The Text above the Comment Form to note visitor something before make comment.</div>
						</div>
						<div class="cleared"></div>
					</div>
					
					<div class="option-section">
						<h3><span>Submit Button's name of Comment Form</span></h3>
						<div class="column2">
							<input type="text" name="submit_comment_name" class="normal_input" value="<?php echo $post_option['submit_comment_name'];?>">
						</div>
						<div class="column2 column_last">
							<div class="help">The text for Submit Button of Comment form.</div>
						</div>
						<div class="cleared"></div>
					</div>
					
				</div>
				<div class="option-tab" id="option-tab-portfolio-content">
					<div class="option-section">
						<h3><span>Projects Page Title</span></h3>
						<div class="column2">
							<input type="text" name="project_page_title" class="normal_input" value="<?php echo $project_options['project_page_title'];?>" >
						</div>
						<div class="column2 column_last">
							<div class="help">The title of <a href="<?php echo home_url(); ?>/projects">Projects</a> page. </div>
						</div>
						<div class="cleared"></div>
					</div>
					<div class="option-section">
						<h3><span>Projects Page Sub Title</span></h3>
						<div class="column2">
							<input type="text" name="project_page_sub_title" class="normal_input" value="<?php echo $project_options['project_page_sub_title'];?>" >
						</div>
						<div class="column2 column_last">
							<div class="help">The sub title of <a href="<?php echo home_url(); ?>/projects">Projects</a> page. </div>
						</div>
						<div class="cleared"></div>
					</div>
					<div class="option-section">
						<h3><span>Project Per Page </span></h3>
						<div class="column2">
							<input type="text" name="project_per_page" class="normal_input" value="<?php echo $project_options['project_per_page'];?>" >
						</div>
						<div class="column2 column_last">
							<div class="help">The total of projects will be show in the portfolio page. In page builder , the projects widget will have different options for total projects.</div>
						</div>
						<div class="cleared"></div>
					</div>
					<div class="option-section">
						<h3><span>Portfolio Number Columns </span></h3>
						<div class="column2">
							<input type="radio" name="portfolio_column" id="portfolio_column2" value="2" <?php checked($project_options['portfolio_column'],2);?>><label for="portfolio_column2">2 Columns</label>
							<input type="radio" name="portfolio_column" id="portfolio_column3" value="3" <?php checked($project_options['portfolio_column'],3);?>><label for="portfolio_column3">3 Columns</label>
							<input type="radio" name="portfolio_column" id="portfolio_column4" value="4" <?php checked($project_options['portfolio_column'],4);?>><label for="portfolio_column4">4 Columns</label>
						</div>
						<div class="column2 column_last">
							<div class="help">The columns of projects in portfolio page.</div>
						</div>
						<div class="cleared"></div>
					</div>
					<div class="option-section">
						<h3><span>Comment in Single Project </span></h3>
						<div class="column2">
							<input type="checkbox" name="project_comment" value="1" id="project_comment" <?php checked($project_options['project_comment'],1);?>><label for="project_comment">Allow Comment</label>
						</div>
						<div class="column2 column_last">
							<div class="help">It will turn on/off comment in the single project page. If you want to turn off for specified project, you can turn off it in edit project page.</div>
						</div>
						<div class="cleared"></div>
					</div>
					<div class="option-section">
						<h3><span>Show Relative Projects</span></h3>
						<div class="column2">
							<input type="checkbox" name="project_relative" value="1" id="project_relative" <?php checked($project_options['project_relative'],1);?>><label for="project_relative">Show Relative Projects</label>
						</div>
						<div class="column2 column_last">
							<div class="help">It will show relative projects to this project. The result will be random and have same categories.</div>
						</div>
						<div class="cleared"></div>
					</div>
					
				</div>
				<div class="option-tab" id="option-tab-social-content">
					<div class="option-section">
						<div class="column2">
							<h3><span>RSS </span></h3>
							<input type="checkbox" name="rss" id="check_rss" value="1" <?php checked($social_option['rss'],1);?>><label for="check_rss">Show rss link in social bar</label>	
						</div>
						<div class="column2 column_last">
							<h3><span>Behance </span></h3>
							<input type="text" name="behance" class="normal_input" value="<?php echo $social_option['behance'];?>">
						</div>
						<div class="cleared"></div>
					</div>
					
					<div class="option-section">
						<div class="column2">
							<h3><span>Facebook </span></h3>
							<input type="text" name="facebook" class="normal_input" value="<?php echo $social_option['facebook'];?>">
						</div>
						<div class="column2 column_last">
							<h3><span>Digg </span></h3>
							<input type="text" name="digg" class="normal_input" value="<?php echo $social_option['digg'];?>">
						</div>
						<div class="cleared"></div>
					</div>
								
					<div class="option-section">
						<div class="column2">
							<h3><span>Flickr </span></h3>
							<input type="text" name="flickr" class="normal_input" value="<?php echo $social_option['flickr'];?>">
						</div>
						<div class="column2 column_last">
							<h3><span>Google Plus </span></h3>
							<input type="text" name="google" class="normal_input" value="<?php echo $social_option['google'];?>">
						</div>
						<div class="cleared"></div>
					</div>
					
					<div class="option-section">
						<div class="column2">
							<h3><span>Pinterest </span></h3>
							<input type="text" name="pinterest" class="normal_input" value="<?php echo $social_option['pinterest'];?>">
						</div>
						<div class="column2 column_last">
							<h3><span>Stumbleupon </span></h3>
							<input type="text" name="stumbleupon" class="normal_input" value="<?php echo $social_option['stumbleupon'];?>">
						</div>
						<div class="cleared"></div>
					</div>
					
					<div class="option-section">
						<div class="column2">
							<h3><span>Tumblr </span></h3>
							<input type="text" name="tumblr" class="normal_input" value="<?php echo $social_option['tumblr'];?>">
						</div>
						<div class="column2 column_last">
							<h3><span>Twitter </span></h3>
							<input type="text" name="twitter" class="normal_input" value="<?php echo $social_option['twitter'];?>">
						</div>
						<div class="cleared"></div>
					</div>
					
					<div class="option-section">
						<div class="column2">
							<h3><span>Vimeo </span></h3>
							<input type="text" name="vimeo" class="normal_input" value="<?php echo $social_option['vimeo'];?>">
						</div>
						<div class="column2 column_last">
							<h3><span>SoundCloud </span></h3>
							<input type="text" name="soundcloud" class="normal_input" value="<?php echo $social_option['soundcloud'];?>">
						</div>
						<div class="cleared"></div>
					</div>

				</div>
				
				<div class="option-section">
					<button class="form-submit-button" > Save Changes </button>
				</div>
				
			</div>
			<div class="cleared"></div>
		</div>
		<div class="footer-task-bar">
			Wope FrameWork 1.0
		</div>

	</div>
	</form>