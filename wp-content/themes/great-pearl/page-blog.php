<?php
/**
 * Template Name: Blog template
 */
//load site option 
$sidebar_options = get_option('wope-sidebar');
$post_option = get_option('wope-post');

get_header(); 

	?>
	<?php if ( have_posts() ) { ?>
		<?php /* Start the Loop */ ?>
		<?php the_post(); ?>
		<?php 	
		if(is_front_page()){
			
		?>
			<?php get_template_part('slider');?>
		<?php
		}else{
		?>
			<div id="page-title-bar">
				<div class="wrap">
					<h2 id="page-title"><?php the_title(); ?></h2>
					<?php if(trim($sub_title) != ''){?>
						<h3 id="page-title-sub"><?php echo $sub_title;?></h3>
					<?php }?>
				</div>
			</div><!-- End Page Title -->
		<?php
		}?>
		
		
		<div id="body">
			<div class="wrap">
				<div class="content">
					<div class="big-column left">
						<?php 	
						if(!is_front_page()){
						?>
						
							<?php if(has_post_thumbnail()){?>
							<div class="post-entry-thumb">
								<?php echo the_post_thumbnail('page-featured');?>
							</div>
							<?php }?>
						
						<?php
						}
						?>
						
						<?php 
						
						if( $wp_rewrite->using_permalinks() ){
							$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						}else{
							$paged = empty($_GET['page']) ? 1 : $_GET['page'];
						}
								
						// The Query
						$args = array(
							'post_type' => 'post',
							'paged' => $paged,
						);
						$the_query = new WP_Query( $args );
						
						if ( $the_query->have_posts() ) {
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
						?>
							<div class="post-entry">
								<div class="post-entry-thumb">
									<a href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail();?></a>
								</div>
								<div class="post-entry-meta">
									<?php wope_show_meta();?>
								</div>
								<div class="post-entry-main-content">
									<div class="post-entry-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</div>
									
									<div class="post-entry-content">
										<?php the_content( '' ); ?>
									</div>
									<div class="post-entry-button">
										<a class="small-button" href="<?php the_permalink(); ?>"><?php echo $post_option['readmore_label'];?></a>
									</div>
								</div>
								<div class="cleared"></div>
							</div>
							<!-- End Post Entry -->
						<?php
							}
						}else{
							_e('There are no post to display.','wope');
						}
						?>
						
						<?php 
						wp_link_pages();
						//comments_template( '', true );
						?>
						
						<div class="paginate">
							<?php
								$pagination = array(
									'base' => @add_query_arg('page','%#%'),
									'format' => '',
									'show_all' => false,
									'type' => 'plain',
									'prev_next' => true,
									'prev_text'    => '<',
									'next_text'    => '>',
									'current' => $paged,
									'total' => $the_query->max_num_pages
								);	
								if( $wp_rewrite->using_permalinks() )
									$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',get_pagenum_link(1) ) ) . 'page/%#%/', 'paged');

								if( !empty($the_query->query_vars['s']) )
									$pagination['add_args'] = array('s'=>get_query_var('s'));
									
								echo  paginate_links($pagination) ; 	

								wp_reset_postdata();
							?>
						</div>
					
					<!-- End Big Column -->
				</div>
				<div class="small-column right">
				
					<?php 
					if(is_array($custom_sidebar_option)){
						if(array_key_exists($current_post_id,$custom_sidebar_option)){
							dynamic_sidebar( $custom_sidebar_option[$current_post_id]['slug'] );
						}else{
							if(!is_front_page()){
								dynamic_sidebar( $sidebar_options['page_sidebar'] );
							}else{
								dynamic_sidebar( $sidebar_options['index_sidebar'] );
							}
						}
					}else{
						if(!is_front_page()){
							dynamic_sidebar( $sidebar_options['page_sidebar'] );
						}else{
							dynamic_sidebar( $sidebar_options['index_sidebar'] );
						}
					}
					?>
					
				</div><!-- End Small Column -->
				<div class="cleared"></div>
			</div>
		</div>
	</div><!-- End Body-->
	<?php } ?>	
<?php get_footer(); ?>