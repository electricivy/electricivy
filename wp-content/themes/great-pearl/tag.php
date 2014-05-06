<?php
/**
 * The main template file.
 */
$sidebar_options = get_option('wope-sidebar');
get_header(); ?>
	<div id="page-title-bar">
		<div class="wrap">
			<h2 id="page-title">
				<?php
					printf( __( 'Tag Archives: %s', 'wope' ), '<span>' . single_tag_title( '', false ) . '</span>' );
				?>
			</h2>
		</div>
	</div><!-- End Page Title -->
	
	<div id="body">
		<div class="wrap">
			<div class="content">
				<div class="breadcrumb">
					<a href="index.html">Home</a> &#8250; <?php
							printf( __( 'Tag Archives: %s', 'wope' ), '<span>' . single_tag_title( '', false ) . '</span>' );
						?>
				</div>
				<div class="big-column left">
					<?php
						if ( have_posts() ) {
							while ( have_posts() ) {
								the_post();
								get_template_part( 'content');
							}
						}
					?>
					<div class="paginate">
						<?php
						show_paginate_links();
						?>
						
					</div>
					
				</div>
				<!-- End Big Column -->
				
				<div class="small-column right">
				
					<?php dynamic_sidebar( $sidebar_options['category_sidebar'] ); ?>
					
				</div><!-- End Small Column -->
				<div class="cleared"></div>
			</div>
		</div>
	</div><!-- End Body-->
<?php get_footer(); ?>