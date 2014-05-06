<?php
/**
 * The main template file.
 */
 $sidebar_options = get_option('wope-sidebar');
$index_page_option = get_option('wope-index-page');
if($index_page_option['total_section'] >0){
	foreach($index_page_option as $key => $value){
		$index_page_option[$key] = htmlspecialchars($value);
	}
}
get_header(); ?>
	<?php get_template_part('slider');?>
	
	<div id="body">
		<div class="wrap">
			<div class="content">
			<?php if($sidebar_options['use_index_sidebar'] == 1){?>
				<div class="big-column left">
			<?php }?>		
			<?php
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						get_template_part( 'content');
					}
				}
			?>
			
			<?php if($sidebar_options['use_index_sidebar'] == 1){?>		
				</div>
				<!-- End Big Column -->
			
				<div class="small-column right">
			
					<?php dynamic_sidebar( $sidebar_options['index_sidebar'] ); ?>
				
				</div><!-- End Small Column -->
				<div class="cleared"></div>
			
			<?php }?>
			</div>
		</div>
	</div><!-- End Body-->
<?php get_footer(); ?>