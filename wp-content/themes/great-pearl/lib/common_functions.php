<?php
//setup the theme
add_action( 'after_setup_theme', 'wopethemes_setup' );
function wopethemes_setup() {
	// add feature images
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	
	if ( is_user_logged_in() ) {
		// add admin bar
		show_admin_bar( true ); 
	}
}


// add last class for widget 
add_filter('dynamic_sidebar_params','wopethemes_add_last_widget');
function wopethemes_add_last_widget($params) {
	global $my_widget_num; // Global a counter array
	$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
	$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets	

	if(!$my_widget_num) {// If the counter array doesn't exist, create it
		$my_widget_num = array();
	}

	if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
		return $params; // No widgets in this sidebar... bail early.
	}

	if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
		$my_widget_num[$this_id] ++;
	} else { // If not, create it starting with 1
		$my_widget_num[$this_id] = 1;
	}

	$class = 'class="footer-widget-' . $my_widget_num[$this_id] . ' '; // Add a widget number class for additional styling options

	if($my_widget_num[$this_id] == 1) { // If this is the first widget
		$class .= 'footer-widget-first ';
	} elseif($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { // If this is the last widget
		$class .= 'footer-widget-last ';
	}

	$params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']); // Insert our new classes into "before widget"
	return $params;
}

//function to remove stripslashes
function my_stripslashes($text){
	if(get_magic_quotes_gpc()){
		return stripslashes($text);
	}else{
		return $text;
	}
}

//remove wordpress escape
function remove_wp_magic_quotes(){
	$_GET    = stripslashes_deep($_GET);
	$_POST   = stripslashes_deep($_POST);
	$_COOKIE = stripslashes_deep($_COOKIE);
	$_REQUEST = stripslashes_deep($_REQUEST);
}
remove_wp_magic_quotes();

//build menu list
function get_menu_list($select_name,$current_menu){
	$menus = get_terms( 'nav_menu', array(  'order' => 'name') );
	if(count($menus)> 0){
	?>
	<select name="<?php echo $select_name;?>">
		<?php foreach($menus as $menu){ ?>
			<?php if($current_menu == $menu->slug){?>
				<option value="<?php echo $menu->slug; ?>" selected="selected"><?php echo $menu->name; ?></option>
			<?php }else{?>
				<option value="<?php echo $menu->slug; ?>"><?php echo $menu->name; ?></option>
			<?php }?>
		<?php } ?>
	</select>
	<?php
	}
}

function show_paginate_links(){
	global $wp_query;		
	global $wp_rewrite;		
	if( $wp_rewrite->using_permalinks() ){
	
		$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

		$pagination = array(
			'base' => @add_query_arg('page','%#%'),
			'format' => '',
			'total' => $wp_query->max_num_pages,
			'current' => $current,
			'show_all' => false,
			'type' => 'plain',
			'prev_text'    => '<',
			'next_text'    => '>',
		);

		if( $wp_rewrite->using_permalinks() )
			$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',get_pagenum_link(1) ) ) . 'page/%#%/', 'paged');

		if( !empty($wp_query->query_vars['s']) )
			$pagination['add_args'] = array('s'=>get_query_var('s'));

		echo  paginate_links($pagination) ; 
	}else{
		$big = 999999999; // need an unlikely integer
		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'prev_text'    => '<',
			'next_text'    => '>',
		) );
	}	
}

//filter to remove width,height of images.
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}

//limit text by number of single text
function text_limit($str,$limit=10,$suffix)
{
	if(stripos($str," ")){
		$ex_str = explode(" ",$str);
		if(count($ex_str)>$limit){
			$str_s = '';
			for($i=0;$i<$limit;$i++){
				$str_s.=$ex_str[$i]." ";
			}
			return $str_s.$suffix;
		}else{
			return $str;
		}
	}else{
		return $str;
	}
}

function check_post($key){
	if(array_key_exists($key,$_POST)){
		return $_POST[$key];
	}
}

function convert_slug($string){
    $string = strtolower($string);
    $string = html_entity_decode($string);
    $string = str_replace(array('ä','ü','ö','ß'),array('ae','ue','oe','ss'),$string);
    $string = preg_replace('#[^\w\säüöß]#',null,$string);
    $string = preg_replace('#[\s]{2,}#',' ',$string);
    $string = str_replace(array(' '),array('-'),$string);
    return $string;
}

?>