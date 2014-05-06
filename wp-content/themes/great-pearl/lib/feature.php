<?php
//custom post type
add_action( 'init', 'wope_create_feature_type' );
function wope_create_feature_type() {
	register_post_type( 'feature',
		array(
			'labels' => array(
				'name' => __( 'Feature' ),
				'singular_name' => __( 'Feature' ),
				'add_new' => _x('Add New', 'Feature'),
				'all_items' => __( 'All Features' ),
				'add_new_item' =>  __( 'Add New Feature' ),
				'edit_item' => __( 'Edit Feature' ),
				'new_item' => __( 'New Feature' ),
				'view_item' => __( 'View Feature' ),
				'search_items' => __( 'Search Features' ),
				'not_found_in_trash' => __('No Feature found in Trash'),
				'view_item' => __( 'View Feature' ),
			),
			'public' => false,
			'show_ui' => true,
			'menu_icon' => get_stylesheet_directory_uri() .'/images/feature-icon.png',
			'has_archive' => true,
			'rewrite' => array('slug' => 'features'),
			'supports' => array(
				'title',
				'editor',
				'thumbnail',
			),
		)
	);
}

//register taxonomy
add_action( 'init', 'create_feature_taxonomies', 0 );
function create_feature_taxonomies()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'Feature Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Feature Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Feature Categories' ),
    'popular_items' => __( 'Popular Feature Categories' ),
    'all_items' => __( 'All Feature Categories' ),
    'parent_item' => __( 'Parent Feature Category' ),
    'parent_item_colon' => __( 'Parent Feature Category:' ),
    'edit_item' => __( 'Edit Feature Category' ),
    'update_item' => __( 'Update Feature Category' ),
    'add_new_item' => __( 'Add New Feature Category' ),
    'new_item_name' => __( 'New Feature Category Name' ),
  );
  register_taxonomy('feature-category','feature', array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'feature-category' ),
  ));
}
?>