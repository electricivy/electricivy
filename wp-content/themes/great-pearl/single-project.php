<?php
/**
 * The main template file.
 */
$project_options = get_option('wope-project');
$sidebar_options = get_option('wope-sidebar');
$project_label 		= get_post_meta( $post->ID, 'project_label', true );
$project_sublabel 	= get_post_meta( $post->ID, 'project_sublabel', true );
$project_day 		= get_post_meta( $post->ID, 'project_day', true );
$project_month 		= get_post_meta( $post->ID, 'project_month', true );
$project_year 		= get_post_meta( $post->ID, 'project_year', true );
$project_media_type = get_post_meta( $post->ID, 'project_media_type', true );
$embed_code 		= get_post_meta( $post->ID, 'embed_code', true );
get_header(); ?>
	<?php if ( have_posts() ) { ?>
		<?php /* Start the Loop */ ?>
		<?php the_post(); ?>
		<div id="page-title-bar">
			<div class="wrap">
				<h2 id="page-title"><?php the_title(); ?></h2>
			</div>
		</div><!-- End Page Title -->
		
		<div id="body">
			<div class="wrap">
				<div class="content">
					<div class="breadcrumb">
						<a href="index.html">Home</a> &#8250; 
						<?php 
							$categories = get_the_terms( $post->ID , 'project-category' );
							if(is_array($categories)){
								foreach ( $categories as $each_category ) {
									$category = $each_category;
									break;
								}
								echo '<a href="'.get_term_link($category->slug , 'project-category' ).'">'.$category->name.'</a>';
							}
						?>	
						&#8250; <?php the_title(); ?>
					</div>
					
					<div class="project-entry">
						<div class="project-entry-right">
							<div class="post-entry-thumb">
								<?php if($project_media_type == 'youtube'){?>
									<div class="youtube-container">
										<?php echo $embed_code;?>
									</div>
								<?php }elseif($project_media_type == 'vimeo'){?>
									<div class="vimeo-container">
										<?php echo $embed_code;?>
									</div>
								<?php }else{?>
									<a href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail( 'project-featured');?></a>
								<?php }?>
							</div>
							
						</div>
						
						<div class="project-entry-left">
							<div class="project-entry-box">
								<div class="project-entry-content">
									<?php the_content();?>
								</div>
								<div class="project-entry-field">
									Categories : <span class="meta-categories"><?php echo get_the_term_list( $post->ID , 'project-category' ,'' ,', ' ); ?></span><br>
									Date : <span class="meta-date">
										<?php echo date("F", mktime(0, 0, 0, $project_month, 10));?> <?php echo $project_day;?> ,<?php echo $project_year;?>
									</span>
								</div>
							</div>
						</div>
						<div class="cleared"></div>		
						
					</div><!-- End Project Details-->
					<?php }
						// Reset Post Data
						wp_reset_postdata();
					?>	
					
					<?php if($project_options['project_relative'] == 1){?>
					<div class="project-relatives">
						<div class="container-title">
							<span>Related Projects</span>
						</div>
						<div class="project-relative-container">
							<?php 
							$tax_query['relation'] = 'OR';
							if(is_array($categories)){
								foreach ( $categories as $each_category ) {
									$tax_query[] = array(
										'taxonomy' => 'project-category',
										'field' => 'slug',
										'terms' => $each_category->slug,
									);
								}
							}
							$args = array(
								'tax_query' => $tax_query,
								'post_type' => 'project',
								'posts_per_page' => 4,
								'post__not_in' => array($post->ID),
								'orderby' => 'rand',
							);
							
							// The Query
							$the_query = new WP_Query( $args );
							if ( $the_query->have_posts() ) {
								$total_project = 1;
								while ( $the_query->have_posts() ) : $the_query->the_post();
									$project_thumb 		= get_post_meta( $post->ID, 'project_thumb', true );
									$project_day 			= get_post_meta( $post->ID, 'project_day', true );
									$project_month 		= get_post_meta( $post->ID, 'project_month', true );
									$project_year 		= get_post_meta( $post->ID, 'project_year', true );
									
									if($total_project == 4){
										$column_last = 'column-last';
										$clear_div = '<div class="cleared"></div>';
										$total_project = 1;
									}else{
										$column_last = '';
										$clear_div = '';
										$total_project++;
									}
									?>
										<div class="column4_1 <?php echo $column_last;?>">
											<div class="project-cell">
												<div class="project-cell-thumb">
													<div class="project-cell-thumb-window">
														<a href="<?php the_permalink(); ?>">
															<img src="<?php echo $project_thumb;?>">
															<span class="thumb-icon"></span>
															<div class="project-cell-info">
																<div class="project-cell-title">
																	<a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a>
																</div>
															</div>
														</a>
													</div>
												</div>
												
											</div>
										</div><?php echo $clear_div;?>
									<?php
								endwhile;

								// Reset Post Data
								wp_reset_postdata();
							}
							?>
							<div class="cleared"></div>
						</div>
					</div>
					<?php }?>
			
					<?php 
						if($project_options['project_comment'] == 1){
							comments_template( '', true );
						}
					?>
				</div>	
			</div>
		</div><!-- End Body-->
	
<?php get_footer(); ?>