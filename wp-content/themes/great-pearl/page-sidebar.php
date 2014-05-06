<?php
/**
 * Template Name: Sidebar Template
 */
global $index_page_option;
$index_page_option 	= get_post_meta($post->ID, 'page-builder', true);
$sidebar_options = get_option('wope-sidebar');
$custom_sidebar_option = get_option('wope-custom-sidebar');
if(!empty($index_page_option['total_section'])){
	if($index_page_option['total_section'] >0){
		foreach($index_page_option as $key => $value){
			$index_page_option[$key] = htmlspecialchars($value);
		}
	}
}
$sub_title 	= get_post_meta( $post->ID, 'sub_title', true );
$current_post_id = $post->ID;
get_header(); ?>
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
		}
		?>
		
		<div id="body">
			<div class="wrap">
				<div class="content">
					<?php 	
					if(!is_front_page()){
					?>
					<div class="breadcrumb">
						<a href="index.html">Home</a>
						&#8250; <?php the_title(); ?>
					</div>
					<?php
					}
					?>
					
					<div class="big-column left">
					
						<?php if(has_post_thumbnail()){?>
						<div class="post-entry-thumb">
							<?php echo the_post_thumbnail('page-featured');?>
						</div>
						<?php }?>
						
						<?php 
						if(!empty($index_page_option['current-editor'])){
							if($index_page_option['current-editor'] == 0){
								the_content(); 
							}else{
								get_template_part('page_builder');
							}
						}else{
							the_content(); 
						}
						
						wp_link_pages();
						
						comments_template( '', true ); ?>
					
					</div>
					<!-- End Big Column -->
					
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