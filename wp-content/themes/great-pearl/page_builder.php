		<?php 
			global $index_page_option;
			$total_box = 1;
			$total_widget = 1;
			$total_field = 1;
			
			if(!empty($index_page_option['total_section'])){
				for($i = 1 ; $i <= $index_page_option['total_section'] ; $i++ ){
			?>
			<div class="index-section">
			<?php 
			for($j = 1 ; $j <= $index_page_option['section'.$i.'_total'] ; $j++ ){
				if($j == $index_page_option['section'.$i.'_total']){
					$section_last_class = " column-last";
					$section_clear_div = '<div class="cleared"></div>';
				}else{
					$section_last_class = "";
					$section_clear_div = '';
				}
			?>
				<div class="column<?php echo $index_page_option['box'.$total_box];?> <?php echo $section_last_class;?>">
				<?php 
				for($k = 1; $k <= $index_page_option['box'.$total_box.'_total'] ; $k++){	
					
					switch($index_page_option['widget'.$total_widget]){
						case 'category-post':
							$post_option = get_option('wope-post');
							$field1 = $total_field;
							$field2 = $total_field+1;
							$field3 = $total_field+2;
							$field4 = $total_field+3;
							$title 			= $index_page_option['field'.$field1];
							$category 		= $index_page_option['field'.$field2];
							$post_number 	= $index_page_option['field'.$field3];
							$posts_per_row 	= $index_page_option['field'.$field4];
							
							//the title
							if(trim($title) != ''){
							?>
								<div class="container-title">
									<span><?php echo $title;?></span>
								</div>
							<?php
							}
							
							// The Query
							$args = array(
								'posts_per_page' => $post_number,
							);
							if($category != 0){
								$args['cat'] = $category;
							}
							
							$the_query = new WP_Query( $args );
								
							// The Loop
							$total_post = 1;
							while ( $the_query->have_posts() ) { 
								$the_query->the_post();
								if($total_post == $posts_per_row){
									$last_class = " column-last";
									$clear_div = '<div class="cleared"></div>';
									$total_post = 1;
								}else{
									$last_class = "";
									$clear_div = '';
									$total_post++ ;
								}
							?>
								<div class="column<?php echo $posts_per_row;?>_1 <?php echo $last_class;?>">
									<div class="post-box">
										<div class="post-thumb">
											<a href="<?php the_permalink(); ?>">
												<?php echo the_post_thumbnail( 'post-thumb-index' );?>
												<span class="gray-hover"></span>
												<span class="post-thumb-icon"></span>
											</a>
										</div>
										
										<div class="post-data">
											<div class="post-title">
												<a href="<?php the_permalink(); ?>"><?php the_title();?></a>
											</div>
											

											<div class="post-excerpt">
												<?php the_excerpt();?>
											</div>
										</div>
									</div>
								</div>
								<?php echo $clear_div;?>
							<?php
							}
							?>
							<div class="cleared"></div>
							<?php
							// Reset Post Data
							wp_reset_postdata();
							
							$total_field += 4;
							break;
						case 'post-list':
							$post_option = get_option('wope-post');
							$field1 = $total_field;
							$field2 = $total_field+1;
							$field3 = $total_field+2;
							$title 			= $index_page_option['field'.$field1];
							$category 		= $index_page_option['field'.$field2];
							$post_number 	= $index_page_option['field'.$field3];
							
							//the title
							if(trim($title) != ''){
							?>
								<div class="container-title">
									<span><?php echo $title;?></span>
								</div>
							<?php
							}
							
							// The Query
							$args = array(
								'posts_per_page' => $post_number,
							);
							if($category != 0){
								$args['cat'] = $category;
							}
							
							$the_query = new WP_Query( $args );
								
							// The Loop
							$total_post = 1;
							while ( $the_query->have_posts() ) { 
								$the_query->the_post();
							?>
								<div class="post-list">
									<div class="post-list-thumb">
										<a href="<?php the_permalink(); ?>">
											<?php echo the_post_thumbnail( 'post-thumb' );?>
										</a>
									</div>
									
									<div class="post-list-data">
										<div class="post-list-title">
											<a href="<?php the_permalink(); ?>"><?php the_title();?></a>
										</div>
										<div class="post-list-date">
											Date : <a class="meta-date" href="<?php echo get_month_link($arc_year, $arc_month); ?>"><?php the_time('M j , Y'); ?></a>
										</div>
										
									</div>
									
									<div class="cleared"></div>
									<div class="post-list-excerpt">
										<?php the_excerpt();?>
									</div>
								</div>
							<?php
							}
							?>
							<?php
							// Reset Post Data
							wp_reset_postdata();
							
							$total_field += 3;
							break;
						case 'lastest-portfolio':
							$field1 = $total_field;
							$field2 = $total_field+1;
							$field3 = $total_field+2;
							$field4 = $total_field+3;
							$field5 = $total_field+4;
							$field6 = $total_field+5;
							$title 			= $index_page_option['field'.$field1];
							$list_type 		= $index_page_option['field'.$field2];
							$category 		= $index_page_option['field'.$field3];
							$project_number 	= $index_page_option['field'.$field4];
							$projects_per_row 	= $index_page_option['field'.$field5];
							$view_all_projects_label 	= $index_page_option['field'.$field6];
							
							//the title
							if(trim($title) != ''){
							?>
								<div class="container-title">
									<span><?php echo $title;?></span>
								</div>
							<?php
							}
							
							//the query
							$args = array(
								'post_type' => 'project',
								'posts_per_page' => $project_number,
							);
							
							if($category != 0){
								$args['tax_query'] = array(
									array(
										'taxonomy' => 'project-category',
										'field' => 'term_id',
										'terms' => $category,
									)
								);
							}
							
							if($list_type == 1){
								$args['meta_query'] = array(
									array(
										'key' => 'featured_project',
										'value' => 1,
									)
								);
							}

							// The Query
							$the_query = new WP_Query( $args );
								
							if ( $the_query->have_posts() ) {
								$total_project = 1;
								while ( $the_query->have_posts() ) : $the_query->the_post();
									$project_label 		= get_post_meta( $the_query->post->ID, 'project_label', true );
									$project_sublabel 	= get_post_meta( $the_query->post->ID, 'project_sublabel', true );
									$project_thumb 		= get_post_meta( $the_query->post->ID, 'project_thumb', true );
									$project_day 		= get_post_meta( $the_query->post->ID, 'project_day', true );
									$project_month 		= get_post_meta( $the_query->post->ID, 'project_month', true );
									$project_year 		= get_post_meta( $the_query->post->ID, 'project_year', true );
									
									if($total_project == $projects_per_row){
										$column_last = 'column-last';
										$clear_div = '<div class="cleared"></div>';
										$total_project = 1;
									}else{
										$column_last = '';
										$clear_div = '';
										$total_project++;
									}
									?>
										<div class="column<?php echo $projects_per_row;?>_1 <?php echo $column_last;?>">
											<div class="project-cell">
												<div class="project-cell-thumb">
													<div class="project-cell-thumb-window">
														<a href="<?php the_permalink(); ?>">
															<img alt="<?php the_title();?>" src="<?php echo $project_thumb;?>">
															<span class="thumb-icon"></span>
															<div class="project-cell-info">
																<div class="project-cell-title">
																	<a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a>
																</div>
																<div class="project-cell-categories">
																	<a href="<?php the_permalink(); ?>"><?php echo get_the_term_list( $post->ID , 'project-category' ,'' ,', ' ); ?></a>
																</div>
															</div>
														</a>
													</div>
												</div>
												
											</div>
										</div><?php echo $clear_div;?>
								<?php
								endwhile;
								?>
								<div class="cleared"></div>
								<?php if(trim($view_all_projects_label) != ''){?>
								<a href="<?php  echo home_url();?>/projects"><?php echo $view_all_projects_label;?></a>
								<?php }?>
								<?php
							}
							
							// Reset Post Data
							wp_reset_postdata();
				?>
					
				<?php 
							$total_field += 6;
							break;
						case 'site-feature':
							$field1 = $total_field;
							$field2 = $total_field+1;
							$field3 = $total_field+2;
							$field4 = $total_field+3;
							$title 			= $index_page_option['field'.$field1];
							$description 	= $index_page_option['field'.$field2];
							$category 		= $index_page_option['field'.$field3];
							$features_per_row = $index_page_option['field'.$field4];
							
							//the title
							if(trim($title) != ''){
							?>
								<div class="container-title">
									<span><?php echo $title;?></span>
								</div>
							<?php
							}
								
								$args = array(
									'post_type' 		=> 'feature',
									'posts_per_page' 	=> -1,
									'tax_query' 		=> array(
										array(
											'taxonomy' => 'feature-category',
											'field' => 'term_id',
											'terms' => $category,
										)
									),
								);
								
								// The Query
								$the_query = new WP_Query( $args );
									
								if ( $the_query->have_posts() ) {
								
									$total_feature = 1;
									
									while ( $the_query->have_posts() ) : $the_query->the_post();
										if($total_feature == $features_per_row){
											$column_last = 'column-last';
											$clear_div = '<div class="cleared"></div>';
											$total_feature = 1;
										}else{
											$column_last = '';
											$clear_div = '';
											$total_feature++;
										}
									?>
									
										<div class="column<?php echo $features_per_row;?>_1 <?php echo $column_last;?>">
											<div class="feature-box">
												<div class="feature-icon">
													<?php echo the_post_thumbnail();?>
												</div>
												<div class="feature-data">
													<div class="feature-name">
															<?php the_title(); ?>
													</div>
													<div class="feature-description">
														<?php the_content(); ?>
													</div>
												</div>
												<div class="cleared"></div>
											</div>
										</div><?php echo $clear_div;?>
									<?php
									endwhile;
									?>
									<div class="cleared"></div>
									<?php
								}
							
							// Reset Post Data
							wp_reset_postdata();
							
							
							$total_field += 4;
							break;
						case 'testimonial':
							$field1 = $total_field;
							$field2 = $total_field+1;
							$title 		= $index_page_option['field'.$field1];
							$category 	= $index_page_option['field'.$field2];

							$args = array(
								'order'				=> 'ASC',
								'post_type' 		=> 'feature',
								'posts_per_page' 	=> -1,
								'tax_query' 		=> array(
									array(
										'taxonomy' => 'feature-category',
										'field' => 'term_id',
										'terms' => $category,
									)
								),
							);
							
							// The Query
							$the_query = new WP_Query( $args );
								
							if ( $the_query->have_posts() ) {
								
								if($the_query->post_count == 1){
									$add_class	= 'testimonials-title-full';
								}else{
									$add_class	= '';
								}
								
								?>
								<div class="testimonials">
									<div class="testimonials-current-id">1</div>
									<div class="testimonials-total"><?php echo $the_query->post_count;?></div>
									<div class="testimonials-top">
										<div class="testimonials-title <?php echo $add_class;?>"><span><?php echo $title;?></span></div>
										<?php if($the_query->post_count != 1){?>
										<div class="testimonials-buttons">
											<div class="testimonials-button-next">
											</div>
											<div class="testimonials-button-prev">
											</div>
										</div>
										<?php }?>
									</div>
									<div class="testimonials-container">
								<?php
							
								$total_feature = 1;
								
								$current_feature = 'testimonials-current';
								
								while ( $the_query->have_posts() ) : $the_query->the_post();
									
								?>
								
										<div class="testimonials-each <?php echo $current_feature;?>">
											<div class="testimonials-content">
												<?php the_content();?> 
											</div>
											<div class="testimonials-author">
												<?php the_title();?> 
											</div>
											<div class="testimonials-id"><?php echo $total_feature;?></div>
										</div>
									
								<?php
									$current_feature = '';
									$total_feature++;
								endwhile;
								?>
									</div>
								</div>
							<?php
							}
							
							// Reset Post Data
							wp_reset_postdata();
							$total_field += 2;
							break;
						case 'partner-logo':
							$field1 = $total_field;
							$field2 = $total_field+1;
							$field3 = $total_field+2;
							$title 			= $index_page_option['field'.$field1];
							$category 		= $index_page_option['field'.$field2];
							$number_logo 	= $index_page_option['field'.$field3];
							
							//the title
							if(trim($title) != ''){
							?>
								<div class="container-title">
									<span><?php echo $title;?></span>
								</div>
							<?php
							}

							$args = array(
								'order'				=> 'ASC',
								'post_type' 		=> 'feature',
								'posts_per_page' 	=> -1,
								'tax_query' 		=> array(
									array(
										'taxonomy' => 'feature-category',
										'field' => 'term_id',
										'terms' => $category,
									)
								),
							);
							
							// The Query
							$the_query = new WP_Query( $args );
								
							if ( $the_query->have_posts() ) {
								while ( $the_query->have_posts() ) : $the_query->the_post();
								?>
								<div class="partner_logo partner_logo_<?php echo $number_logo;?>"><?php echo the_post_thumbnail();?></div>
							<?php
								endwhile;
							}
							?>
								<div class="cleared"></div>
							<?php
							
							// Reset Post Data
							wp_reset_postdata();
							$total_field += 3;
							break;
						case 'welcome-box':
							$field1 = $total_field;
							$field2 = $total_field+1;
							$field3 = $total_field+2;
							$field4 = $total_field+3;
							$text1 			= $index_page_option['field'.$field1];
							$text2 			= $index_page_option['field'.$field2];
							$button_name 	= $index_page_option['field'.$field3];
							$button_url 	= $index_page_option['field'.$field4];
							
							?>
							<div class="welcome-box">
								<div class="welcome-content">
									<div class="welcome-text1">
										<?php echo $text1;?>
									</div>
									<div class="welcome-text2">
										<?php echo html_entity_decode($text2);?>
									</div>
									<?php if(trim($button_name) != ''){?>
									<div class="welcome-buttons">
										<a class="welcome-button" href="<?php echo $button_url;?>"><?php echo $button_name;?></a>
									</div>
									<?php }?>
								</div>
							</div>
							<?php 
							$total_field += 4;
							break;
						case 'highlight-box':
							$field1 = $total_field;
							$text 			= $index_page_option['field'.$field1];
							?>
							<div class="highlight-box">
								<?php echo html_entity_decode($text);?>
							</div>
							<?php 
							$total_field += 1;
							break;
						case 'divider':
							?>
							<div class="divider"></div>
							<?php 
							break;
						case 'tab':
							$field1 = $total_field;
							$field2 = $total_field+1;
							$field3 = $total_field+2;
							$field4 = $total_field+3;
							$title 			= $index_page_option['field'.$field1];
							$type 			= $index_page_option['field'.$field2];
							$style 			= $index_page_option['field'.$field3];
							$category 		= $index_page_option['field'.$field4];
							
							//the title
							if(trim($title) != ''){
							?>
								<div class="container-title">
									<span><?php echo $title;?></span>
								</div>
							<?php
							}
							
							$args = array(
								'order'				=> 'ASC',
								'post_type' 		=> 'feature',
								'posts_per_page' 	=> -1,
								'tax_query' 		=> array(
									array(
										'taxonomy' => 'feature-category',
										'field' => 'term_id',
										'terms' => $category,
									)
								),
							);
							
							// The Query
							$the_query = new WP_Query( $args );
							
							
							if ( $the_query->have_posts() ) {
								$total_tab = 1;
								$tab_array = array();
								while ( $the_query->have_posts() ) {
									$the_query->the_post();
									$tab_array[$total_tab]['title'] 	= get_the_title();
									$tab_array[$total_tab]['content'] 	= get_the_content();
									$total_tab++;
								}
							}
							
							if ( $the_query->have_posts() ) {
								if($type == 'tab'){
								?>
								<div class="tab tab<?php echo $style;?>">
									<div class="tab-top">
										<?php
											$current = 'tab-current';
											for($tab = 1 ; $tab <= count($tab_array) ; $tab ++ ){
										?>
											<div class="tab-title <?php echo $current;?>">
												<?php echo $tab_array[$tab]['title'];?>
												<span class="tab-id"><?php echo $tab;?></span>
											</div>
										<?php 
												$current = "";
											}
										?>
										<div class="cleared"></div>
									</div>
									<div class="tab-bottom">
										<?php
											$current = 'tab-content-current';
											for($tab = 1 ; $tab <= count($tab_array) ; $tab ++ ){
										?>
											<div class="tab-content tab-content<?php echo $tab;?> <?php echo $current;?>">
												<?php 
												$content = apply_filters('the_content',$tab_array[$tab]['content']);
												echo $content;
												?>
											</div>
										<?php 
												$current = "";
											}
										?>
									</div>
								</div>
								<?php
								}else{
								?>
									<div class="accordion accordion<?php echo $style;?>">
										<?php
											for($accor = 1 ; $accor <= count($tab_array) ; $accor ++ ){
										?>
											<div class="accor-title">
												<span class="accor-title-span"><?php echo $tab_array[$accor]['title'];?></span>
											</div>
											<div class="accor-content">
												<?php 
												$content = apply_filters('the_content',$tab_array[$accor]['content']);
												echo $content;
												?>
											</div>
										<?php 
											}
										?>
									</div>
								<?php
								}
							}
							$total_field += 4;
							break;
						case 'embed-box':
							$field1 = $total_field;
							$field2 = $total_field+1;
							$field3 = $total_field+2;
							$field4 = $total_field+3;
							$title = $index_page_option['field'.$field1];
							$embed_type = $index_page_option['field'.$field2];
							$map_height = $index_page_option['field'.$field3];
							$embed_code = $index_page_option['field'.$field4];
							
							//the title
							if(trim($title) != ''){
							?>
								<div class="container-title">
									<span><?php echo $title;?></span>
								</div>
							<?php
							}
							
							switch($embed_type){
								case 'youtube':?>
									<div class="youtube-container"><?php echo html_entity_decode($embed_code);?></div>
								<?php
									break;
								case 'vimeo':?>
									<div class="vimeo-container"><?php echo html_entity_decode($embed_code);?></div>
								<?php
									break;
								case 'soundcloud':?>
									<div class="soundcloud-container"><?php echo html_entity_decode($embed_code);?></div>
								<?php
									break;
								case 'google-map':?>
									<div class="google-map-container" style="height:<?php echo $map_height;?>px"><?php echo html_entity_decode($embed_code);?></div>
								<?php
									break;
							}
							$total_field += 4;
							break;
						case 'people':
							$field1 = $total_field;
							$field2 = $total_field+1;
							$field3 = $total_field+2;
							$field4 = $total_field+3;
							$field5 = $total_field+4;
							$title 			= $index_page_option['field'.$field1];
							$image 			= $index_page_option['field'.$field2];
							$name 			= $index_page_option['field'.$field3];
							$job 			= $index_page_option['field'.$field4];
							$description 	= $index_page_option['field'.$field5];
							
							//the title
							if(trim($title) != ''){
							?>
								<div class="container-title">
									<span><?php echo $title;?></span>
								</div>
							<?php
							}
							?>
							<div class="user_profile" >
								<div class="user_profile_image" >
									<img src="<?php echo $image;?>">
								</div>
								<div class="user_profile_data">
									<div class="user_profile_name"><?php echo $name;?></div>
									<div class="user_profile_title"><?php echo $job;?></div>
									<div class="user_profile_content">
										<?php echo html_entity_decode($description);?>
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
							$title 			= $index_page_option['field'.$field1];
							$description 	= $index_page_option['field'.$field2];
							$phone_number 	= $index_page_option['field'.$field3];
							$fax_number 	= $index_page_option['field'.$field4];
							$email 			= $index_page_option['field'.$field5];
							$address 		= $index_page_option['field'.$field6];
							
							//the title
							if(trim($title) != ''){
							?>
								<div class="container-title">
									<span><?php echo $title;?></span>
								</div>
							<?php
							}
							?>
							<?php echo html_entity_decode($description);?>
							<?php if(trim($phone_number)!= ''){?>
								<div class="contact-phone"><strong>Phone : </strong> <?php echo $phone_number;?></div>
							<?php }?>
							
							<?php if(trim($fax_number)!= ''){?>
								<div class="contact-fax"><strong>Fax : </strong> <?php echo $fax_number;?></div>
							<?php }?>
							
							<?php if(trim($email)!= ''){?>
								<div class="contact-email"><strong>Email : </strong> <a href="mailto:<?php echo $email;?>?Subject=Hello%20again"><?php echo $email;?></a></div>
							<?php }?>
							
							<?php if(trim($address)!= ''){?>
								<div class="contact-address"><strong>Address : </strong> <?php echo $address;?></div>
							<?php }?>

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
							$title 				= $index_page_option['field'.$field1];
							$receive_email 		= $index_page_option['field'.$field2];
							$description 		= $index_page_option['field'.$field3];
							$name_label 		= $index_page_option['field'.$field4];
							$email_label 		= $index_page_option['field'.$field5];
							$subject_label 		= $index_page_option['field'.$field6];
							$button_label 		= $index_page_option['field'.$field7];
							$successful_text 	= $index_page_option['field'.$field8];
							
							if(!empty($_POST['submit_contact'])){
								if(trim($_POST['the_author']) != '' and trim($_POST['the_email']) != '' and trim($_POST['the_subject']) != '' ){
									$header = "Content-type: text/html; charset=utf-8\r\nFrom: ".trim($_POST['the_email'])."\r\nReply-to: ".trim($_POST['the_email']);
									
									$content_header = "
										You received Email to  ".get_bloginfo('siteurl').": <br>
										Name : ".trim($_POST['the_author'])."<br>
										Email : ".trim($_POST['the_email'])."<br>
										Subject : ".trim($_POST['the_subject'])."<br>
										Content : <br>
									";
									mail( $receive_email, trim($_POST['the_subject']), $content_header.$_POST['the_content'],$header);
									$msg  = $successful_text;
								}else{
									$error = "The Name , Email and Subject are required!";
								}
							}
							
							if(isset($msg)){?>
								<div class="success_msg"><p><?php echo $msg;?></p></div>
							<?php
							}
							
							//the title
							if(trim($title) != ''){
							?>
								<div class="container-title">
									<span><?php echo $title;?></span>
								</div>
							<?php
							}
							?>
							<?php echo html_entity_decode($description);?>
							<div class="contact-form">
								<form action="" method="post">							
									<div class="comment-form-author">
										<input id="author" name="the_author" type="text" value="" size="30" />
										<label for="author"><?php echo $name_label;?> <span class="required">*</span></label> 
									</div>
									<div class="comment-form-email">
										<input id="email" name="the_email" type="text" value="" size="30"  />
										<label for="email"><?php echo $email_label;?> <span class="required">*</span></label> 
									</div>
									<div class="comment-form-subject">
										<input id="subject" name="the_subject" type="text" value="" size="30" />
										<label for="subject"><?php echo $subject_label;?> <span class="required">*</span></label>
									</div>
									<div class="comment-form-comment">
										<textarea name="the_content" rows="14"></textarea>
									</div>
																	
									<div class="form-submit">
										<input name="submit_contact" class="submit-button" type="submit" id="submit" value="<?php echo $button_label;?>" />
									</div>
								</form>
							</div>
							<?php 
							$total_field += 8;
							break;
						case 'content-box':
						
							$field1 = $total_field;
							$field2 = $total_field+1;
							$title 			= $index_page_option['field'.$field1];
							$content 		= html_entity_decode($index_page_option['field'.$field2]);
							$filter_content = apply_filters('the_content',$content);
							
							//the title
							if(trim($title) != ''){
							?>
								<div class="container-title">
									<span><?php echo $title;?></span>
								</div>
							<?php
							}
							
							echo $filter_content;
							
							$total_field += 2;
							break;
					}
					$total_widget++;	
				?>
				<?php 
				
				}
				?>
				</div>
				<?php echo $section_clear_div;?>
			<?php 
				$total_box++;
			}
			?>
			</div>
		<?php 
				}
			}
		?>