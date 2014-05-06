<?php
/**
 * The main template file.
 */
$sidebar_options = get_option('wope-sidebar');
get_header(); 
?>
	<?php if ( is_search() ) { ?>
		<?php if ( have_posts() ) { ?>
			<div id="page-title-bar">
				<div class="wrap">
					<h2 id="page-title"><?php printf( __( 'Search Results for: %s', 'wope' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
				</div>
			</div><!-- End Page Title -->
			
			<div id="body">
				<div class="wrap">
					<div class="content">
						<div class="breadcrumb">
							<a href="index.html">Home</a> &#8250; 
							<?php printf( __( 'Search Results for: %s', 'wope' ), '<span>' . get_search_query() . '</span>' ); ?>
						</div>
						<div class="big-column left">
							<?php get_search_form(); ?>
							<?php
								if ( have_posts() ) {
									while ( have_posts() ) {
										the_post();
										get_template_part( 'content');
									}
								}
							?>
							<div class="paginate">
								<?php show_paginate_links();?>
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
			<?php }else{?>
				<div id="page-title-bar">
					<div class="wrap">
						<h2 id="page-title"><?php printf( __( 'Search Results for: %s', 'wope' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
					</div>
				</div><!-- End Page Title -->
				<div id="body">
					<div class="wrap">
						<div class="content">
							<div class="breadcrumb">
								<a href="index.html">Home</a> &#8250; 
								<?php printf( __( 'Search Results for: %s', 'wope' ), '<span>' . get_search_query() . '</span>' ); ?>
							</div>
							<div class="big-column left">
								<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'wope' ); ?></p>
								<?php get_search_form(); ?>	
							</div>
							<!-- End Big Column -->
							
							<div class="small-column right">
								<?php dynamic_sidebar( $sidebar_options['category_sidebar'] ); ?>
							</div><!-- End Small Column -->
							
							<div class="cleared"></div>
						</div>
					</div>
				</div><!-- End Body-->
			<?php }?>
		<?php }else{?>
			<div id="page-title-bar">
				<div class="wrap">
					<h2 id="page-title"><?php _e( 'Search', 'wope' ) ; ?></h2>
				</div>
			</div><!-- End Page Title -->
			<div id="body">
				<div class="wrap">
					<div class="content">
						<div class="breadcrumb">
							<a href="index.html">Home</a> &#8250; 
							<?php _e( 'Search', 'wope' ) ; ?>
						</div>
						<div class="big-column left">
							<?php get_search_form(); ?>	
						</div>
						<!-- End Big Column -->
						
						<div class="small-column right">
							<?php dynamic_sidebar( $sidebar_options['category_sidebar'] ); ?>
						</div><!-- End Small Column -->
						
						<div class="cleared"></div>
					</div>
				</div>
			</div><!-- End Body-->
	<?php }?>
<?php get_footer(); ?>