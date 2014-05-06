<?php
/**
 * The template for displaying search forms 
 */
?>
	<div class="search-form">
		<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<input type="text" class="search-input" name="s" id="s" value="<?php echo get_search_query();?>" placeholder="<?php esc_attr_e( 'Search', 'wope' ); ?>" />
			<input type="submit" class="search-button" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'wope' ); ?>" />
		</form>
	</div>