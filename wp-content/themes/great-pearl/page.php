<?php
/**
 * The main template file.
 */

global $index_page_option;
$index_page_option 	= get_post_meta($post->ID, 'page-builder', true);
if(!empty($index_page_option['total_section'])){
	if($index_page_option['total_section'] > 0){
		foreach($index_page_option as $key => $value){
			$index_page_option[$key] = htmlspecialchars($value);
		}
	}
}
$heading_setting 	= get_post_meta( $post->ID, 'heading_setting', true );
$rev_slider 		= get_post_meta( $post->ID, 'rev_slider', true );
$sub_title 			= get_post_meta( $post->ID, 'sub_title', true );

get_header(); 

	?>
	<?php if ( have_posts() ) { the_post(); ?>
		
		<?php if($heading_setting == 0){?>
			<div id="page-title-bar">
				<div class="wrap">
					<h2 id="page-title"><?php the_title(); ?></h2>
					<?php if(trim($sub_title) != ''){?>
						<h3 id="page-title-sub"><?php echo $sub_title;?></h3>
					<?php }?>
				</div>
			</div><!-- End Page Title -->
		<?php }else{?>
			<div id="slider">
				
				<?php putRevSlider($rev_slider);?>
			</div>
		<?php }?>
		
		
		<div id="body">
			<div class="wrap">
				<div class="content">
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
			
					if(!is_front_page()){
						comments_template( '', true );
					}

					?>
				</div>
			</div>
		</div><!-- End Body-->
	<?php } ?>	
<?php get_footer(); ?>