<?php  
function wope_editor_mce_css( $mce_css ) {
	if ( ! empty( $mce_css ) )
		$mce_css .= ',';
		
		

	$mce_css .= get_template_directory_uri() .'/admin_editor.css';

	return $mce_css;
}

add_filter( 'mce_css', 'wope_editor_mce_css' ); 

// Add "Styles" drop-down 
function wope_editor_buttons($buttons) {  
    array_unshift($buttons, 'styleselect');  
    return $buttons;  
}  
add_filter('mce_buttons_2', 'wope_editor_buttons');  
 
// Add "Styles" drop-down content or classes 

function wope_editor_settings($settings) {  

	$style_formats = array(  
		 array(  
            'title' => 'Main Color',  
            'inline' => 'span',  
            'classes' => 'main-color'  
        ), 
        array(  
            'title' => 'Highlight',  
            'inline' => 'span',  
            'classes' => 'highlight'  
        ),  
		array(  
            'title' => 'Star list',  
            'selector' => 'ul',  
            'classes' => 'starlist',  
        ), 
		array(  
            'title' => 'Check list',  
            'selector' => 'ul',  
            'classes' => 'checklist',  
        ), 
		array(  
            'title' => 'Arrow list',  
            'selector' => 'ul',  
            'classes' => 'arrowlist',  
        ), 
		array(  
            'title' => 'Small button',  
            'inline' => 'span',  
            'classes' => 'small-button',
        ),
		array(  
            'title' => 'Big button',  
            'inline' => 'span',  
            'classes' => 'big-button',  
        ),
		array(  
            'title' => 'Curver button',  
            'inline' => 'span',  
            'classes' => 'curver-button',  
        ),
		array(  
            'title' => 'Gerenal Message',  
            'block' => 'div',  
            'classes' => 'general_msg',  
            'wrapper' => true  ,
        ), 
		array(  
            'title' => 'Error Message',  
            'block' => 'div',  
            'classes' => 'error_msg',  
            'wrapper' => true  ,
        ), 
		array(  
            'title' => 'Alert Message',  
            'block' => 'div',  
            'classes' => 'alert_msg',  
            'wrapper' => true  ,
        ), 
		array(  
            'title' => 'Success Message',  
            'block' => 'div',  
            'classes' => 'success_msg',  
            'wrapper' => true  ,
        ), 
    );  
    $settings['style_formats'] = json_encode( $style_formats );  
    return $settings;  
}  
add_filter('tiny_mce_before_init', 'wope_editor_settings');  
/* 
 * Add custom stylesheet to the website front-end with hook 'wp_enqueue_scripts' 
 * Enqueue the custom stylesheet in the front-end 
 */  
add_action('admin_print_styles', 'wope_editor_enqueue');  


function wope_editor_enqueue() {  
	$StyleUrl = get_stylesheet_directory_uri().'/admin_editor.css';  
	wp_enqueue_style( 'myCustomStyles', $StyleUrl );  
}