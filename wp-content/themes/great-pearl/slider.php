<?php
	$slider_options = get_option('wope-slider');
	$flex_options = get_option('wope-flexslider');
	global $wpdb;
	$table_name = $wpdb->prefix . "slider_options";
	if($slider_options['slider_type'] == 1){
		$slide_data = $wpdb->get_results("SELECT * FROM ".$table_name." WHERE type = 1 order by `order` DESC ");
	?>
		<div id="slider" >
			<div class="wope-slider" id="main-slider" >
				<div class="wopeslider-container">
				<?php 
					if(is_array($slide_data)){
						$slide_number = 1;
						foreach($slide_data as $each_slide){	
				?>
						<div class="wopeslider-slide slide<?php echo $slide_number;?>" style="time:<?php echo $each_slide->time;?>;">
							<?php
								$subslides = $wpdb->get_results("SELECT * FROM ".$table_name." WHERE parent = ".$each_slide->slide_id . " and type = 2 order by `order` ASC ");
								if(is_array($subslides)){
									$subslide_number = 1;
									foreach($subslides as $each_subslide){
										$subslide_data = unserialize($each_subslide->data);
									?>
										<img alt="wope slider" class="ws<?php echo $subslide_number;?>" src="<?php echo $subslide_data['image'];?>" style="easing:<?php echo $subslide_data['easing'];?>;delay:<?php echo $subslide_data['delay'];?>;time:<?php echo $subslide_data['time'];?>;action:<?php echo $subslide_data['action'];?>">	
									<?php
										$subslide_number++;
									}
								}
								
							if($each_slide->data != ''){
							?>
								<a href="<?php echo $each_slide->data;?>"></a>
							<?php	
							}
							?>
						</div>
				<?php
							$slide_number++;
						}
					}
				?>
		
				</div>
			</div>
			
			<script>
			//call slider
			jQuery('#main-slider').wopeslider({
				'height': 960,
				'width' : <?php echo empty($slider_options['slider_height']) ? 400 : $slider_options['slider_height'] ;?>
			});
			</script>
			
			<?php if(trim($slider_options['static_image']) != ''){?>
			<div id="static-image">
				<img alt="static image" src="<?php echo $slider_options['static_image'];?>">
			</div>
			<?php }?>
		</div><!-- End Wope Slider-->
	<?php
	}elseif($slider_options['slider_type'] == 2){
		$static_content = $wpdb->get_row("select * from ".$table_name." where type = 3 limit 0 , 1");
		if($static_content){
			$static_content_data =unserialize($static_content->data);
			
			$filtered_static_content = apply_filters('the_content', $static_content_data['static_content']);
		
	?>
		<div id="slider" class="static-content-container">
			<div class="wrap" id="static-content">
				<?php if($static_content_data['media_pos'] == 1){?>
					<div class="column2_1">
						<?php if($static_content_data['media_type'] == 1){?>
							<img src="<?php echo $static_content_data['static_image'];?>">
						<?php }elseif($static_content_data['media_type'] == 2){?>
							<div class="youtube-container">
								<?php echo $static_content_data['embed_code'];?>
							</div>
						<?php }else{?>
							<div class="vimeo-container">
								<?php echo $static_content_data['embed_code'];?>
							</div>
						<?php }?>
					</div>
					<div class="column2_1 column-last static-content"><?php echo $filtered_static_content;?></div>
					<div class="cleared"></div>
				<?php }else{?>
					<div class="column2_1 static-content"><?php echo $filtered_static_content;?></div>
					<div class="column2_1 column-last ">
						<?php if($static_content_data['media_type'] == 1){?>
							<img src="<?php echo $static_content_data['static_image'];?>">
						<?php }elseif($static_content_data['media_type'] == 2){?>
							<div class="youtube-container">
								<?php echo $static_content_data['embed_code'];?>
							</div>
						<?php }else{?>
							<div class="vimeo-container">
								<?php echo $static_content_data['embed_code'];?>
							</div>
						<?php }?>
					</div>
					<div class="cleared"></div>
				<?php }?>
			</div>
			<?php if(trim($slider_options['static_image']) != ''){?>
			<div id="static-image">
				<img alt="static image" src="<?php echo $slider_options['static_image'];?>">
			</div>
			<?php }?>
		</div>
	<?php
		}
	}else{
		$slide_data = $wpdb->get_results("SELECT * FROM ".$table_name." WHERE type = 4 order by `order` DESC ");
	?>
		<div id="slider" >
			<div id="flex-slider">
				<?php if(is_array($slide_data)){?>
					<div class="flex-container">
						<div class="flexslider">
							<ul class="slides">
							<?php foreach($slide_data as $each_slide){
								$slide_data = unserialize($each_slide->data);
								$filtered_content = apply_filters('the_content', $slide_data['slide_content']);
							?>
							  <li>
								<img alt="image slider" src="<?php echo $each_slide->time;?>" />
								<div class="flex-caption <?php echo $slide_data['content_pos'];?>">
									<div class="flex-caption-content"><?php echo $filtered_content;?></div>
								</div>
							  </li>
							<?php }?>
							</ul>
						</div>
					</div>
				<?php }?>
			</div>
			<?php if(trim($slider_options['static_image']) != ''){?>
			<div id="static-image">
				<img alt="static image" src="<?php echo $slider_options['static_image'];?>">
			</div>
			<?php }?>
		</div>
		<script>
				jQuery(document).ready(function(){
					jQuery('.flexslider').flexslider({
						directionNav: false,
						animation : '<?php echo $flex_options['flex-animation'];?>',
						direction : '<?php echo $flex_options['flex-direction'];?>',
						<?php if(trim($flex_options['flex-speed']) != ''){?>
						slideshowSpeed : <?php echo $flex_options['flex-speed'];?>,	
						<?php }?>
					});
				});
		</script>
		
	<?php
	}
?>		