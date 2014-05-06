<?php
//PAGE BUILDER
// add page builder metabox
add_action( 'admin_init', 'wope_build_page_builder' );
add_action( 'save_post', 'wope_page_builder_save' );

function wope_build_page_builder() {
    add_meta_box( 'wope-page-builder', __( 'Page Builder' ), 'wope_page_builder', 'page', 'normal', 'high' );
}

//show metabox
function wope_page_builder(){
	global $post;
	global $index_page_option;
	$index_page_option 	= get_post_meta($post->ID, 'page-builder', true);
	if(isset($index_page_option['total_section'])){
		foreach($index_page_option as $key => $value){
			$index_page_option[$key] = htmlspecialchars($value);
		}
	}

	//check for which editor
	if(!isset($index_page_option['current-editor'])){
		$index_page_option['current-editor'] = 0; //default editor
	}
	
	//load page builder
	get_template_part('lib'.DS."page_builder");
}

function wope_page_builder_save(){
	global $post;  
    if( $_POST ) {
		if(!empty($_POST['total_section'])){
			//index options
			$total_section = trim($_POST['total_section']); //total section
			$total_box = 0;
			$total_widget = 0;
			$total_field = 0;
			
			//each section 
			for($i = 1 ; $i <= $total_section ; $i ++ ){ 
				$current_section_total = trim($_POST['section'.$i.'_total']);
				$total_box+= $current_section_total;
				
				//update total box in each section
				$index_option_array['section'.$i.'_total'] = $current_section_total;
				$index_option_array['section'.$i.'_layout'] = trim($_POST['section'.$i.'_layout']);
			}	
			
			// each box 
			for($j = 1 ; $j <= $total_box ; $j ++ ){ 
				$current_box_total = trim($_POST['box'.$j.'_total']);
				$total_widget+= $current_box_total;
				
				//update total widget in each box
				$index_option_array['box'.$j.'_total'] = $current_box_total;
				$index_option_array['box'.$j] = trim($_POST['box'.$j]); //box column
			}
			
			// each widget 
			for($k = 1 ; $k <= $total_widget ; $k ++ ){ 
				$current_widget_total = trim($_POST['widget'.$k.'_total']);
				$total_field+= $current_widget_total;
				
				//update total field in each widget
				$index_option_array['widget'.$k.'_total'] = $current_widget_total;
				$index_option_array['widget'.$k] = trim($_POST['widget'.$k]); //widget type
			}
			
			//	each field
			for($l = 1 ; $l <= $total_field ; $l ++ ){ 
				//update total widget in each section
				$index_option_array['field'.$l] = trim($_POST['field'.$l]); //field value
				
			}
			
			//update total section and box in index page
			$index_option_array['total_section'] 	= $total_section;
			
			if(!empty($_POST['current-editor'])){
				$index_option_array['current-editor'] 	=  trim($_POST['current-editor']);
			}
			
			update_post_meta( $post->ID, 'page-builder', $index_option_array);
		}
		
	}
}

// add sub title metabox
add_action( 'admin_init', 'wope_build_page_metabox' );
add_action( 'save_post', 'wope_page_metabox_save' );

function wope_build_page_metabox() {
    add_meta_box( 'page-data', __( 'Page Sub Title' ), 'wope_page_metabox', 'page', 'normal', 'high' );
}

//show metabox
function wope_page_metabox(){
	global $post;
	$heading_setting 	= get_post_meta( $post->ID, 'heading_setting', true );
	$rev_slider 		= get_post_meta( $post->ID, 'rev_slider', true );
	$sub_title 			= get_post_meta( $post->ID, 'sub_title', true );
	
	if( class_exists( 'RevSlider' ) ) {
		function mdf_get_revSlider(){

			if(class_exists('RevSlider')){
				$returnSlider = array();
				$slider = new RevSlider();
				$arrSliders = $slider->getArrSliders();
				
				foreach($arrSliders as $slider) { 
					$returnSlider[$slider->getAlias()] = $slider->getTitle();
				}
				return $returnSlider;
			}
		}	
		
		$all_slider = mdf_get_revSlider();
		
	}else{
		$all_slider = array();
	}
	
?>
	<h4>Heading Setting</h4>
	<div>
		<input type="radio" name="heading_setting" value="0" id="use_page_title" <?php checked($heading_setting,0);?> /><label for="use_page_title">Use Page Title </label>
		<input type="radio" name="heading_setting" value="1" id="hide_heading" <?php checked($heading_setting,1);?> /><label for="hide_heading">Use Revolution Slider </label>
	</div>
	<div class="column2_1">
		<h4>Page Sub Title</h4>
		<input type="text" class="normal_input" name="sub_title" value="<?php echo $sub_title;?>" />
	</div>
	<div class="column2_1 column_last">	
		<h4>choose Revolution Slider</h4>
		<select name="rev_slider">
			<?php if(count($all_slider) >0 ){?>
			
				<?php foreach($all_slider as $key => $each_slider){?>
					<?php if($rev_slider == $key){?>
						<option value="<?php echo $key;?>" selected="selected"><?php echo $each_slider;?></option>
					<?php }else{?>
						<option value="<?php echo $key;?>"><?php echo $each_slider;?></option>
					<?php }?>
					
				<?php }?>
			<?php }?>
		</select>
		
	</div>
	<div class="cleared"></div>
<?php
}

function wope_page_metabox_save(){
	global $post;  
    if( $_POST ) {
	
		
			update_post_meta( $post->ID, 'heading_setting',	$_POST['heading_setting'] );
		
		
		if(!empty($_POST['rev_slider'])){
			update_post_meta( $post->ID, 'rev_slider',	$_POST['rev_slider'] );
		}
		
		if(!empty($_POST['sub_title'])){
			update_post_meta( $post->ID, 'sub_title',	$_POST['sub_title'] );
		}
	}
}


