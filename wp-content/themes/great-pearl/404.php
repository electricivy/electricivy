<?php
/**
 * The main template file.
 */
get_header(); ?>
	<div id="page-title-bar">
		<div class="wrap">
			<h2 id="page-title">Page Not Found</h2>
		</div>
	</div><!-- End Page Title -->
	<div id="body">
		<div class="wrap">
			<div class="content">
				<h3 class="center no-border">Ooops page not found...</h3>
				<div class="center">
					The page you are looking for might have been removed, had its name changed, or is temporarily unavailable. Please try another search ... 
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	</div><!-- End Body-->
<?php get_footer(); ?>