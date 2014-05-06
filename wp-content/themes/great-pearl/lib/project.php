<?php //custom post type
add_action( 'init', 'wope_create_project_type' );
function wope_create_project_type() {
	register_post_type( 'project',
		array(
			'labels' => array(
				'name' => __( 'Project' ),
				'singular_name' => __( 'Project' ),
				'add_new' => _x('Add New', 'project'),
				'all_items' => __( 'All Projects' ),
				'add_new_item' =>  __( 'Add New Project' ),
				'edit_item' => __( 'Edit Project' ),
				'new_item' => __( 'New Project' ),
				'view_item' => __( 'View Project' ),
				'search_items' => __( 'Search Projects' ),
				'not_found_in_trash' => __('No Project found in Trash'),
				'view_item' => __( 'View Project' ),
			),
			'public' => true,
			'show_ui' => true,
			'show_in_nav_menus' => true,
			'show_in_menu' => true,
			'menu_icon' => get_stylesheet_directory_uri() .'/images/project-icon.png',
			'show_in_admin_bar' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'projects'),
			'supports' => array(
					'title',
					'editor',
					'comments',
					'revisions',
					'thumbnail',
				),
		)
	);
	
	 /* IMPORTIONT: Remember this line! */
    flush_rewrite_rules( false );/* Please read "Update 2" before adding this line */
}

//register taxonomy
add_action( 'init', 'create_project_taxonomies', 0 );
function create_project_taxonomies(){
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'Project Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Project Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Project Categories' ),
    'popular_items' => __( 'Popular Project Categories' ),
    'all_items' => __( 'All Project Categories' ),
    'parent_item' => __( 'Parent Project Category' ),
    'parent_item_colon' => __( 'Parent Project Category:' ),
    'edit_item' => __( 'Edit Project Category' ),
    'update_item' => __( 'Update Project Category' ),
    'add_new_item' => __( 'Add New Project Category' ),
    'new_item_name' => __( 'New Project Category Name' ),
  );
  register_taxonomy('project-category','project', array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'project-category'  ),
  ));
}

// add project metabox
add_action( 'admin_init', 'wope_build_project_metabox' );
add_action( 'save_post', 'wope_project_metabox_save' );
add_action( 'save_post', 'wope_project_thumb_save' );

function wope_build_project_metabox() {
    add_meta_box( 'project-data', __( 'Project Informations' ), 'wope_project_metabox', 'project', 'normal', 'high' );
	add_meta_box( 'project-thumb', __( 'Thumbnail Image' ), 'wope_project_thumbnail', 'project', 'side', 'low' );
}

//show metabox
function wope_project_metabox(){
	global $post;
	$featured_project 	= get_post_meta( $post->ID, 'featured_project', true );
	$project_media_type = get_post_meta( $post->ID, 'project_media_type', true );
    $embed_code 		= get_post_meta( $post->ID, 'embed_code', true );
	$project_day 		= get_post_meta( $post->ID, 'project_day', true );
	$project_month 		= get_post_meta( $post->ID, 'project_month', true );
    $project_year 		= get_post_meta( $post->ID, 'project_year', true );
	
	if(!$featured_project){
		$featured_project = '1';
	}

	if(!$project_media_type){
		$project_media_type = 'image';
	}
	
	if($project_day == ''){
		$curent_day = date('j');
		$curent_month = date('n');
		$curent_year = date('Y');
	}else{
		$curent_day = $project_day;
		$curent_month = $project_month;
		$curent_year = $project_year;
	}
?>
	<div class="column1_2">
		<h4>Featured Project</h4>
		<input type="checkbox" name="featured_project" value="1" id="featured_project" <?php checked($featured_project,1);?> /><label for="featured_project">Featured Project</label>
		<div class="help">The Featured Projects will be show in Project widget of WP Widgets and our Page Builder.</div>
	</div>
	<div class="column1_2 column-last">	
		<h4>Project Date</h4>
		Month <select name="project_month">
			<?php for($i = 1 ; $i <= 12 ; $i++){?>
				<?php if($curent_month == $i){?>
					<option selected="selected" value="<?php echo $i;?>"><?php echo $i;?></option>
				<?php }else{?>
					<option value="<?php echo $i;?>"><?php echo $i;?></option>
				<?php }?>
			<?php }?>
		</select>
		Day <select name="project_day">
			<?php for($i = 1 ; $i <= 31 ; $i++){?>
				<?php if($curent_day == $i){?>
					<option selected="selected" value="<?php echo $i;?>"><?php echo $i;?></option>
				<?php }else{?>
					<option value="<?php echo $i;?>"><?php echo $i;?></option>
				<?php }?>
			<?php }?>
		</select>
		Year <select name="project_year">
			<?php for($i = 2012 ; $i <= 2020 ; $i++){?>
				<?php if($curent_year == $i){?>
					<option selected="selected" value="<?php echo $i;?>"><?php echo $i;?></option>
				<?php }else{?>
					<option value="<?php echo $i;?>"><?php echo $i;?></option>
				<?php }?>
			<?php }?>
		</select>
		<div class="help">The date when the project was finished.</div>
	</div>
	<div class="cleared"></div>
	<div class="column1_2">
		<h4>Media Type</h4>
		<input type="radio" name="project_media_type" value="image" id="project_media_image" <?php checked($project_media_type,'image');?> /><label for="project_media_image"> Image</label><br>
		<input type="radio" name="project_media_type" value="youtube" id="project_media_youtube"<?php checked($project_media_type,'youtube');?> /><label for="project_media_youtube"> Youtube Video</label><br>
		<input type="radio" name="project_media_type" value="vimeo" id="project_media_vimeo" <?php checked($project_media_type,'vimeo');?> /><label for="project_media_vimeo"> Vimeo Video</label><br>
		<div class="help">The type of project you want to show. The image is featured Image which can set in the right column.</div>
	</div>
	<div class="column1_2 column-last">	
		<h4>Media Embed Code</h4>
		<textarea rows="5" name="embed_code" class="normal_textarea"><?php echo $embed_code;?></textarea>
		<div class="help">Enter Embed code if you're using Youtube or Vimeo video.</div>
	</div>
	<div class="cleared"></div>	
<?php
}

//show thumb box
function wope_project_thumbnail(){
	global $post;
    $project_thumb 		= get_post_meta( $post->ID, 'project_thumb', true );
?>
	<div class="upload_wp">
		<img class="uploaded_image" src="<?php echo $project_thumb;?>">
		<input class="upload_field" type="text" size="36" name="project_thumb" value="<?php echo $project_thumb;?>" />
		<input class="upload_button" type="button" value="Upload Image" />
		<div class="help">The Thumbnail Image will be use as project thumbs in widgets, recent work slider and portfolio page. The Featured Image will be use as project thumbs in Single project page </div>
		<div class="help">The Size for Thumbnail Image should have min width 468px.</div>
	</div>
<?php
}

function wope_project_metabox_save(){
	global $post;  
    if( $_POST and !empty($post->ID)) {
		update_post_meta( $post->ID, 'featured_project',check_post('featured_project') );
		update_post_meta( $post->ID, 'project_media_type',check_post('project_media_type') );
		update_post_meta( $post->ID, 'embed_code', check_post('embed_code') );
		update_post_meta( $post->ID, 'project_day',	check_post('project_day') );
		update_post_meta( $post->ID, 'project_month',check_post('project_month') );
		update_post_meta( $post->ID, 'project_year', check_post('project_year') );
	}
}

function wope_project_thumb_save(){
	global $post;  
    if( $_POST and !empty($post->ID) and !empty($_POST['project_thumb'])) {
        update_post_meta( $post->ID, 'project_thumb',$_POST['project_thumb'] );
	}
}