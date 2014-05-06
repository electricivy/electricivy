<?php
/**
 * The main template file.
 */
$sidebar_options = get_option('wope-sidebar');
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
							$category = get_the_category(); 
							if($category[0]){
								echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
							}
						?>	
						&#8250; <?php the_title(); ?>
					</div>
					<div class="big-column left">
						<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">	
						
							<div class="post-entry"> 
								<div class="post-entry-thumb">
									<a href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail();?></a>
								</div>
								<div class="post-entry-meta">
									<?php wope_show_meta();?>
								</div>
								<div class="post-entry-main-content">
									<div class="post-entry-content">
										<?php the_content( '' ); ?>
									</div>
									<?php wp_link_pages(); ?>
								</div>
								<div class="cleared"></div>
							</div>
							<!-- End Post Entry -->
						</div>
						
						<?php comments_template( '', true ); ?>
					</div>
					<!-- End Big Column -->
					
					<div class="small-column right">
					
						<?php dynamic_sidebar( $sidebar_options['single_sidebar'] ); ?>
						
					</div><!-- End Small Column -->
					<div class="cleared"></div>
				</div>	
			</div>
		</div><!-- End Body-->
	<?php } ?>	
<?php get_footer(); ?>