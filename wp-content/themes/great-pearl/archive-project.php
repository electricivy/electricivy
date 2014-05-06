<?php
/**
 * The main template file.
 */
$sidebar_options = get_option('wope-sidebar');
$project_options = get_option('wope-project');
$portfolio_column = $project_options['portfolio_column'];
$project_per_page = $project_options['project_per_page'];
get_header(); ?>
	<div id="page-title-bar">
		<div class="wrap">
			<h2 id="page-title">
				<?php echo $project_options['project_page_title'];?>
			</h2>
			<?php if(trim($project_options['project_page_sub_title']) != ''){?>
				<h3 id="page-title-sub"><?php echo $project_options['project_page_sub_title'];?></h3>
			<?php }?>
		</div>
	</div><!-- End Page Title -->
	
	<div id="body">
		<div class="wrap">
			<div class="content">
				<div class="breadcrumb">
					<a href="index.html">Home</a> &#8250; project archives
				</div>
				<?php if($sidebar_options['use_portfolio_sidebar'] == 1){?>
				<div class="big-column left">
				<?php }?>
					<?php
						//get paginate
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						
						$category = get_term_by('name',single_cat_title( '', false ),'project-category');
						$args = array(
							'post_type' => 'project',
							'posts_per_page' => $project_per_page, 
							'paged' => $paged,
						);
						
						// The Query
						$the_query = new WP_Query( $args );
						
						if ( $the_query->have_posts() ) {
							$total_project = 1;
							while ( $the_query->have_posts() ) : $the_query->the_post();
								$project_thumb 		= get_post_meta( $post->ID, 'project_thumb', true );
								$project_day 		= get_post_meta( $post->ID, 'project_day', true );
								$project_month 		= get_post_meta( $post->ID, 'project_month', true );
								$project_year 		= get_post_meta( $post->ID, 'project_year', true );
								
								if($total_project == $portfolio_column){
									$column_last = 'column-last';
									$clear_div = '<div class="cleared"></div>';
									$total_project = 1;
								}else{
									$column_last = '';
									$clear_div = '';
									$total_project++;
								}
								?>
									<div class="column<?php echo $portfolio_column;?>_1 <?php echo $column_last;?>">
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

							// Reset Post Data
							wp_reset_postdata();
						}
					?>
					<div class="cleared"></div>
					<div class="paginate">
						<?php
							$pagination = array(
								'base' => @add_query_arg('page','%#%'),
								'format' => '',
								'show_all' => false,
								'type' => 'plain',
								'prev_text'    => __('&larr;'),
								'next_text'    => __('&rarr;'),
								'current' => $paged,
								'total' => $the_query->max_num_pages
							);	
							if( $wp_rewrite->using_permalinks() )
								$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',get_pagenum_link(1) ) ) . 'page/%#%/', 'paged');

							if( !empty($the_query->query_vars['s']) )
								$pagination['add_args'] = array('s'=>get_query_var('s'));
								
							echo  paginate_links($pagination) ; 		
						?>
					</div>
				
				<?php if($sidebar_options['use_portfolio_sidebar'] == 1){?>		
				</div>
				<!-- End Big Column -->
				
				<div class="small-column right">
				
					<?php dynamic_sidebar( $sidebar_options['portfolio_sidebar'] ); ?>
					
				</div><!-- End Small Column -->
				<div class="cleared"></div>
				
				<?php }?>
			</div>
		</div>
	</div><!-- End Body-->
<?php get_footer(); ?>