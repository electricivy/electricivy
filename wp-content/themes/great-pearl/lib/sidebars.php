<?php
//setup the sidebar
add_action( 'widgets_init', 'wope_widgets_init' );
function wope_widgets_init() {
	//home page sidebar
	register_sidebar( array(
		'name' => __( 'Index Sidebar', 'wope' ),
		'id' => 'index-sidebar',
		'description'   => 'The sidebar for Index page',
		'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
		'after_widget' => "</div> ",
		'before_title' => '<div class="sidebar-widget-title"><span>',
		'after_title' => '</span></div> ',
	) );
	
	//inner page sidebar : page , archive , search ...ect
	register_sidebar( array(
		'name' => __( 'Inner Sidebar', 'wope' ),
		'id' => 'inner-sidebar',
		'description'   => 'The sidebar for Inner Pages',
		'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
		'after_widget' => "</div> ",
		'before_title' => '<div class="sidebar-widget-title"><span>',
		'after_title' => '</span></div> ',
	) );
	
	//sinlge post sidebar
	register_sidebar( array(
		'name' => __( 'Post Sidebar', 'wope' ),
		'id' => 'post-sidebar',
		'description'   => 'The sidebar for Single Post',
		'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
		'after_widget' => "</div> ",
		'before_title' => '<div class="sidebar-widget-title"><span>',
		'after_title' => '</span></div> ',
	) );
	
	//project , portfolio sidebar
	register_sidebar( array(
		'name' => __( 'Project Sidebar', 'wope' ),
		'id' => 'project-sidebar',
		'description'   => 'The sidebar for Project/Portfolio',
		'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
		'after_widget' => "</div> ",
		'before_title' => '<div class="sidebar-widget-title"><span>',
		'after_title' => '</span></div> ',
	) );
	
	//footer sidebar
	register_sidebar( array(
		'name' => __( 'Footer Sidebar', 'wope' ),
		'id' => 'footer-sidebar',
		'description'   => 'The sidebar for Footer in Index page',
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget' => "</div> ",
		'before_title' => '<div class="sidebar-widget-title"><span>',
		'after_title' => '</span></div> ',
	) );
	
	//footer inner sidebar
	register_sidebar( array(
		'name' => __( 'Footer Inner Sidebar', 'wope' ),
		'id' => 'footer-sidebar2',
			'description'   => 'The sidebar for Footer in Inner page',
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget' => "</div> ",
		'before_title' => '<div class="sidebar-widget-title"><span>',
		'after_title' => '</span></div> ',
	) );
	
	$custom_sidebar_option = get_option('wope-custom-sidebar');
	
	$unique_array = array();
	if(is_array($custom_sidebar_option)){
		foreach($custom_sidebar_option as $key=>$each_sidebar){
			if(!in_array($each_sidebar['name'],$unique_array)){
				register_sidebar( array(
					'name' => __( $each_sidebar['name'], 'wope' ),
					'id' => $each_sidebar['slug'],
						'description'   => 'The Custom sidebar',
					'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
					'after_widget' => "</div> ",
					'before_title' => '<div class="sidebar-widget-title"><span>',
					'after_title' => '</span></div> ',
				) );
				$unique_array[] = $each_sidebar['name'];
			}
		}
	}
	
}