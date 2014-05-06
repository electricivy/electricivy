<?php
/**
 * The Header for our theme.
 */
$main_option = get_option('wope-main');
$social_option = get_option('wope-social');
$slider_options = get_option('wope-slider');
$font_options = get_option('wope-font');
$color_options = get_option('wope-color');
$background_options = get_option('wope-background');

$logo_size = '';
if($main_option['logo_hd'] == 1){
	$logo_size = ' width = "'.$main_option['logo_hd_width'].'" height = "'.$main_option['logo_hd_height'].'" ';
}

$background_class = '';
$background_style = '';

if($main_option['site-layout'] == 2){
	if($background_options['bg-type'] == 2){
		$background_class = 'class="boxed-layout '.$background_options['bg-pattern'].'"';
		$background_style = '';
	}elseif($background_options['bg-type'] == 1){
		$background_class = 'class="boxed-layout"';
		$background_style = 'style="background-color:#'.$background_options['bg-color'].';"';
	}else{
		$background_class = 'class="boxed-layout"';
		
		if($background_options['bg-upload-fixed']){
			$background_fixed = 'background-attachment:fixed';
		}
		
		$background_style_css = "background-image:url('".$background_options['bg-upload-url']."');background-repeat:".$background_options['bg-upload-repeat'].";background-position:".$background_options['bg-upload-position-x']." ".$background_options['bg-upload-position-y'].";".$background_fixed;
		
		$background_style = 'style = "'.$background_style_css.'"';
	}
}

?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<?php if($main_option['responsive'] == 1){?>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<?php }?>
	<title>
		<?php
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;

		wp_title( '|', true, 'right' );

		// Add the blog name.
		bloginfo( 'name' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";

		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'blogtyral' ), max( $paged, $page ) );

		?>
	</title>
	<?php if(!empty($main_option['favicon_url'])){?>
		<?php if(trim($main_option['favicon_url']) != ''){?>
		<link REL="icon" HREF="<?php echo $main_option['favicon_url'];?>">
		<?php }?>
	<?php }?>
	
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	
		
	<?php wp_head();?>
</head>
<body <?php body_class(); ?>> 
	<div id="background" <?php echo $background_class;?> <?php echo $background_style;?>>
	<div id="page">
	<div id="header">
		<div class="wrap">	
			<div id="logo-box">
				<div id="logo">
					<?php if(trim($main_option['logo_url']) != ''){?>
						<a href="<?php echo home_url(); ?>"><img <?php echo $logo_size;?> alt="site logo" src="<?php echo $main_option['logo_url'];?>"></a>
					<?php }else{?>
						<span id="logo-text">
							<a href="<?php echo home_url(); ?>"><?php bloginfo('name');?></a>
						</span>
					<?php }?>
				</div>
			</div>	

			<div id="main-menu">
				<?php 
					if ( has_nav_menu('main-menu')){
						wp_nav_menu( array( 'theme_location' => 'main-menu' ) );
					}else{
				?>
				<ul>
					<li><a href="<?php echo home_url(); ?>">Home</a></li>
				</ul>
				<?php
					}
				?> 
				<div class="cleared"></div>
			</div><!-- End Main Menu -->
			
			<div class="cleared"></div>
			
			<div id="main-menu-dropdown">
				<?php 
					$location_id = 'main-menu';
					if ( has_nav_menu($location_id)){
						$menu_locations = get_nav_menu_locations($location_id);
						if (isset($menu_locations[ $location_id ])) {
							

							// Get the items for this menu
							$menu_items = wp_get_nav_menu_items($menu_locations[ $location_id ]); 
							
						?>
							<select id="main-menu-select">
								<?php
									$prefix = "";
									$last_menu_id = 0;
									foreach ( (array) $menu_items as $key => $menu_item ) {
										//add prefix
										if($menu_item->menu_item_parent == 0){
											$prefix = "";
										}else{
											if($menu_item->menu_item_parent == $last_menu_id){
												$prefix .= "&nbsp;&nbsp;&nbsp;";
											}
										}
										//update last menu item
										$last_menu_id = $menu_item->ID;	
								?>
									<option value="<?php echo $menu_item->url;?>"><?php echo $prefix."- ".$menu_item->title;?></option>
								<?php
									}
								?>
							</select>
						<?php
						}
					}else{
					?>
					<select id="top-menu-dropdown-select">
						<option value="<?php echo home_url(); ?>">Home</option>
					</select>
					<?php
					}
				?> 
			</div>
			<script>
			//menu dropdown for small device
			jQuery('#main-menu-select').change(function(){
				window.location.replace(jQuery('#main-menu-select').val());
			});
			</script>
			
		</div>
	</div><!-- End Header -->