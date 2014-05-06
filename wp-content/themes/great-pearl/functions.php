<?php
if ( ! isset( $content_width ) ) $content_width = 900;

//config directory
define( 'DS', DIRECTORY_SEPARATOR );
define('THEME_PATH', dirname(__FILE__) . DS);
define('LIB_PATH', THEME_PATH . 'lib' . DS);

//include comment functions
include(LIB_PATH.'common_functions.php');

//setup the theme
add_action( 'after_setup_theme', 'wope_setup' );
function wope_setup() {
	set_post_thumbnail_size( 632, 9999);
	add_image_size( 'page-featured', 960, 9999 ); 
	add_image_size( 'project-featured', 576, 9999 ); 
	add_image_size( 'post-thumb-index', 420, 250,true ); 
	add_image_size( 'post-thumb', 66, 44 , true ); 
}

function register_my_menus() {
	register_nav_menus(
		array( 'main-menu' => __( 'Main Menu' ) )
	);
}
add_action( 'init', 'register_my_menus' );

//load widgets & sidebars
include(LIB_PATH.'widgets.php');
include(LIB_PATH.'sidebars.php');

//build great pearl admin menu & page
add_action( 'admin_menu', 'wope_admin_menu' );
function wope_admin_menu(){
	add_menu_page( 'Theme Great Pearl', 'Great Pearl' , 'manage_options', 'theme-great-pearl', 'wope_admin_page');
}
function wope_admin_page(){
	//load admin page
	include(LIB_PATH.'setting_page.php');
}

function slider_admin_page(){
	//load admin page
	include(LIB_PATH.'slider_admin.php');
}

function image_slider_admin_page(){
	//load admin page
	include(LIB_PATH.'slider_admin.php');
}

function flex_slider_admin_page(){
	//load admin page
	include(LIB_PATH.'slider_admin.php');
}

function static_content_admin_page(){
	//load admin page
	include(LIB_PATH.'slider_admin.php');
}

//load css & js files for admin page
add_action( 'admin_init', 'wope_register_script_style' );

//load jquery lib and functions to admin page
function wope_register_script_style(){
	//great pearl required file
	wp_register_script( 'wope-jquery', get_template_directory_uri() .'/js/jquery-1.7.2.min.js' );
	wp_register_script( 'wope-jquery-easing', get_template_directory_uri() .'/js/jquery.easing.1.3.js' );
	
	wp_register_script( 'wope-admin-script',get_template_directory_uri() .'/js/admin_script.js', __FILE__ );
	wp_register_script( 'wope-admin-page-builder',get_template_directory_uri() .'/js/page_builder.js', __FILE__ );
	
	wp_register_style( 'wope-admin-style', get_template_directory_uri() .'/admin.css' , __FILE__ );
	//jpicker required files
	wp_register_script( 'wope-admin-jpicker-script', get_template_directory_uri() .'/js/jpicker/jpicker-1.1.6.min.js' , __FILE__ );
	wp_register_style( 'wope-admin-jpicker-style', get_template_directory_uri() .'/js/jpicker/jPicker-1.1.6.min.css' , __FILE__ );
}

//load script in front end
function wope_load_script_frontend(){
	//front end script
	wp_register_script( 'wope-jquery-easing', get_template_directory_uri() .'/js/jquery.easing.1.3.js' );
	wp_register_script( 'wope-frontend-script',get_template_directory_uri() .'/js/script.js', __FILE__ );
	wp_register_script( 'wope-frontend-wopeslider',get_template_directory_uri() .'/js/wopeslider/wopeslider.jquery.js', __FILE__ );
	wp_register_script( 'wope-frontend-flex-slider',get_template_directory_uri() .'/js/flex-slider/jquery.flexslider-min.js', __FILE__ );
	
	
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-accordion' );
	wp_enqueue_script( 'wope-frontend-script' );
	wp_enqueue_script( 'wope-jquery-easing' );
	
	
}

add_action('wp_enqueue_scripts', 'wope_load_script_frontend');

//load style in front end
function wope_load_style_frontend(){
	$main_option = get_option('wope-main');
	$font_options = get_option('wope-font');
	$color_options = get_option('wope-color');

	//front end script
	wp_register_style( 'wope-responsive', get_template_directory_uri() .'/responsive.css' );
	wp_register_style( 'wope-color', get_template_directory_uri() .'/color-scheme/color.css' );
	wp_register_style( 'wope-font', get_template_directory_uri() .'/font-set/'.$font_options['font_set'].'.css' );
	wp_register_style( 'wope-flexslider', get_template_directory_uri() .'/js/flex-slider/flexslider.css' );
	
	global $font_set;
	get_template_part('font_list');
	if(is_array($font_set[$font_options['font_set']])){
		foreach($font_set[$font_options['font_set']] as $each_font){
			wp_register_style( 'wope-gfont-'.$each_font,'http://fonts.googleapis.com/css?family='.$each_font);
			wp_enqueue_style('wope-gfont-'.$each_font);
		}
	}

	if($main_option['responsive'] == 1){
		wp_enqueue_style('wope-responsive');
	}
	
	wp_enqueue_style('wope-color');
	wp_enqueue_style('wope-font');
	
}

add_action('wp_enqueue_scripts', 'wope_load_style_frontend');

//load file for index page only
function wope_load_file_index(){
	wp_enqueue_script( 'wope-frontend-flex-slider' );
	wp_enqueue_style('wope-flexslider');

}

add_action('wp_enqueue_scripts', 'wope_load_file_index');



//load style and script into admin setting page
add_action('admin_print_scripts', 'wope_enqueue_script');
add_action('admin_print_styles', 'wope_enqueue_style');
function wope_enqueue_script() {
	if(!empty($_GET['page'])){
		if($_GET['page'] == 'theme-great-pearl'){
			//admin scripts
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'jquery-ui-draggable' );
			wp_enqueue_script( 'wope-admin-script' );
			wp_enqueue_script( 'wope-jquery-easing' );
			
			//jpicker
			wp_enqueue_script( 'wope-admin-jpicker-script' );
			wp_enqueue_script( 'wope-admin-jquery-form' );
			//wp uploader
			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');
		}
	}
}

function wope_enqueue_style() {
	//admin style
	wp_enqueue_style( 'wope-admin-style' );
	//jpicker style
	wp_enqueue_style( 'wope-admin-jpicker-style' );
	//wp uploader style
	wp_enqueue_style('thickbox');
}



//load script & styles for only edit page in admin
add_action('admin_print_scripts', 'wope_enqueue_page_builder_script');

function wope_enqueue_page_builder_script() {
	if(get_post_type() == 'page'){
		//admin scripts
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'jquery-ui-draggable' );
		wp_enqueue_script( 'wope-admin-script' );
		wp_enqueue_script( 'wope-jquery-easing' );
		
		//jpicker
		wp_enqueue_script( 'wope-admin-jpicker-script' );
		wp_enqueue_script( 'wope-admin-jquery-form' );
		
		//wp uploader
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		
		//page builder
		wp_enqueue_script( 'wope-admin-page-builder' );
	}elseif(get_post_type() == 'project'){
		//admin scripts
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'jquery-ui-draggable' );
		wp_enqueue_script( 'wope-admin-script' );
		wp_enqueue_script( 'wope-jquery-easing' );
		
		//jpicker
		wp_enqueue_script( 'wope-admin-jpicker-script' );
		wp_enqueue_script( 'wope-admin-jquery-form' );
		
		//wp uploader
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
	}
}


//filder for wp uploader
add_filter('get_media_item_args', 'my_get_media_item_args');
function my_get_media_item_args($args) {    
	$args['send'] = true;
	return $args;
}

//config excerpt
function wope_excerpt_length( $length ) {
	$post_option = get_option('wope-post');
	return $post_option['excerpt_length'];
}
add_filter( 'excerpt_length', 'wope_excerpt_length', 999 );

function new_excerpt_more( $excerpt ) {
	$post_option = get_option('wope-post');
	return str_replace( '[...]', $post_option['excerpt_suffix'], $excerpt );
}
add_filter( 'wp_trim_excerpt', 'new_excerpt_more' );

//setup comment section
function wope_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div class="comment-entry" >
			<div class="comment-avatar">
				<?php echo get_avatar( $comment->comment_author_email, 48 ); ?>
			</div>
			<div class="comment-data">
				<div class="comment-info">
					<?php printf(__('<cite class="fn">%s</cite> '), get_comment_author_link()) ?>
					<div class="comment-date">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a> <?php edit_comment_link(__('(Edit)'),'  ','') ?>
					</div>
				</div>
			</div>
			<div class="cleared"></div>
			<div class="comment-content">
				<?php if ($comment->comment_approved == '0') : ?>
					<div class="comment-awaitting"> 
						<?php _e('Your comment is awaiting moderation.') ?>
					</div>
				<?php endif; ?>
				<?php comment_text() ?>
			</div>
			<div class="comment-reply">
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</div>
		</div><!-- End Comment entry-->
	</li>
<?php
}

//function to show post nave links
function wope_post_nav_link(){
	global $wp_query;  
	if ( $wp_query->max_num_pages > 1 ){
	?>
		<div class="posts-navigation"><p><?php posts_nav_link(); ?></p></div>
	<?php
	}
}

//function to show post meta
function wope_show_meta(){
	$post_option = get_option('wope-post');
	global $arc_year;
	global $arc_month;
	
	if(count($post_option['meta_option'])>0){
		?>
		<?php if(in_array('author' ,$post_option['meta_option'] )){?>
			<div class="post-meta-entry">
				By : <?php the_author_posts_link();?>
			</div>
		<?php }?>
		
		<?php if(in_array('date' ,$post_option['meta_option'] )){?>
			<div class="post-meta-entry">
				Date : <a class="meta-date" href="<?php echo get_month_link($arc_year, $arc_month); ?>"><?php the_time('M j , Y'); ?></a>
			</div>
		<?php }?>
		
		<?php if(in_array('categories' ,$post_option['meta_option'] )){?>
			<div class="post-meta-entry">
				Categories : <?php printf( __( '%2$s', 'wope' ), '', get_the_category_list( ', ' ) ); ?>
			</div>
		<?php }?>
		
		<?php
			$post_option = get_option('wope-post');
			if(count($post_option['tag_option'])>0){
				the_tags( '<div class="post-meta-entry">Tags : ' , ', ', '</div>');
			}
		?>
		
		<?php if(in_array('comment_number' ,$post_option['meta_option'] )){?>
			<div class="post-meta-entry">
				<a class="meta-comment-number" href="<?php the_permalink(); ?>/#name-form"><?php comments_number(  'No Comment' , '1 Comment', '% Comments'); ?></a>
			</div>
		<?php }?>
		
		<?php
	}
}


add_filter( 'widget_tag_cloud_args', 'wope_cloud_args' );
function wope_cloud_args($in){
	$array = array(
    'smallest'                  => 12, 
    'largest'                   => 12,
    'unit'                      => 'px', 
    'number'                    => 45,  
    'format'                    => 'flat',
    'separator'                 => '',
    'orderby'                   => 'name', 
    'order'                     => 'ASC',
    'exclude'                   => null, 
    'include'                   => null, 
    'taxonomy'                  => 'post_tag', 
    'echo'                      => true ); 
	return $array;
}

//load custom post type
include(LIB_PATH.'project.php');

//load custom post type
include(LIB_PATH.'feature.php');

//load page setting
include(LIB_PATH.'page.php');
include(LIB_PATH.'custom_editor.php');

$option_posts_per_page = get_option( 'posts_per_page' );
add_action( 'init', 'my_modify_posts_per_page', 0);
function my_modify_posts_per_page() {
    add_filter( 'option_posts_per_page', 'my_option_posts_per_page' );
}
function my_option_posts_per_page( $value ) {
    global $option_posts_per_page;
    if ( is_tax( 'project-category')  ) {
		$project_options = get_option('wope-project');
		return $project_options['project_per_page'];
	} else {
        return $option_posts_per_page;
    }
}

//init data for theme
if( !get_option( 'great-pearl-init-data') ){

	$theme_url = get_template_directory_uri();

	update_option( 'great-pearl-init-data', 1);
	
	//Main options
	$main_option_array = array(
		'responsive' 		=> 1,
		'logo_hd' 			=> '',
		'logo_hd_width' 	=> '',
		'logo_hd_height' 	=> '',
		'logo_url' 			=> $theme_url.'/images/logo.png',
		'favicon_url' 		=> '',
		'site-layout' 		=> 2,
		'copyright' 		=> '© 2013 Great Pearl - Designed by <a href="http://wopethemes.com">Wopethemes</a>',
		'tracking_code' 	=> ''
	);
	update_option( 'wope-main', $main_option_array);
	
	//Socials options
	$social_option_array = array(
		'rss'			=> 1,
		'behance' 		=> '#',
		'facebook' 		=> '#',
		'digg' 			=> '#',
		'flickr' 		=> '#',
		'google' 		=> '#',
		'pinterest' 	=> '#',
		'stumbleupon' 	=> '#',
		'tumblr' 		=> '#',
		'twitter' 		=> '#',
		'vimeo' 		=> '#',
		'soundcloud' 	=> '#',
	);
	update_option( 'wope-social', $social_option_array);
	
	//post options
	$post_option_array = array(
		'meta_option'			=> array('categories','author','date','comment_number'),
		'tag_option'			=> 'tags',
		'excerpt_length' 		=> 15,
		'excerpt_suffix' 		=> '...',
		'readmore_label' 		=> 'Continous Reading →',
		'comment_form_title' 	=> 'Leave a Reply',
		'comment_form_note' 	=> '',
		'submit_comment_name' 	=> 'Comment',
	);
	update_option( 'wope-post', $post_option_array);
	
	//project options
	$project_option_array = array(
		'project_page_title'	=> 'Portfolio',
		'project_page_sub_title'=> '',
		'project_per_page'		=> 16,
		'portfolio_column'		=> 4,
		'project_comment'		=> 1,
		'project_relative'		=> 1,
	);
	update_option( 'wope-project', $project_option_array);
	
	//sidebar options
	$sidebar_option_array = array(
		'use_index_sidebar'		=> 1,
		'index_sidebar'			=> 'index-sidebar',
		'page_sidebar' 			=> 'inner-sidebar',
		'category_sidebar' 		=> 'post-sidebar',
		'single_sidebar' 		=> 'post-sidebar',
		'use_portfolio_sidebar' => 1,
		'portfolio_sidebar' 	=> 'project-sidebar',
		'index_footer_sidebar' 	=> 'footer-sidebar',
		'inner_footer_sidebar' 	=> 'footer-sidebar2',
	);
	update_option( 'wope-sidebar', $sidebar_option_array);
	
	$font_option_array = array(
		'font_set' => 'standard',
	);
	update_option( 'wope-font', $font_option_array);
	
	$color_option_array = array(
		'current-color' => '0a85cc',
	);
	update_option( 'wope-color', $color_option_array);
	
	$background_option_array = array(
		'bg-type' 				=> 2,
		'bg-color' 				=> 'b2b2b2',
		'bg-pattern' 			=> 'bg18',
		'bg-upload-url'		 	=> '',
		'bg-upload-repeat' 		=> 'repeat',
		'bg-upload-position-x'	=> 'center',
		'bg-upload-position-y' 	=> 'top',
		'bg-upload-fixed'		=> ''
	);
	update_option( 'wope-background', $background_option_array);
	
}

//after update, update color
//retrive saved color schemes
add_action( 'after_switch_theme', 'wope_theme_switch' );
function wope_theme_switch(){
	if($_GET['activated'] == 'true'){
		$color_options = get_option('wope-color');
		global $current_color;
		$current_color = $color_options['current-color'];
		get_template_part('lib'.DS."color_pattern");
	}
}

 if ( is_singular() ) wp_enqueue_script( "comment-reply" ); 