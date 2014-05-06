<?php
/**
 * The template for displaying the footer.
 */
$main_option = get_option('wope-main');
$social_option = get_option('wope-social');
$sidebar_options = get_option('wope-sidebar');
?>			
	<div id="footer-top">
	</div><!-- End Footer Top -->
	
	<div id="footer">
		<div class="wrap">	
			
			<?php 	
			if(is_front_page()){
				if(is_active_sidebar($sidebar_options['index_footer_sidebar'])){
				?>
					<div id="footer-widget-container">
				<?php				
					dynamic_sidebar( $sidebar_options['index_footer_sidebar'] );
				?>
					<div class="cleared"></div>
					</div><!-- End Footer Widget Container-->
				<?php
				}

			}else{
				if(is_active_sidebar($sidebar_options['inner_footer_sidebar'])){
				?>
					<div id="footer-widget-container">
				<?php	
				dynamic_sidebar( $sidebar_options['inner_footer_sidebar'] );
				?>
					<div class="cleared"></div>
					</div><!-- End Footer Widget Container-->
				<?php
				}
			}				
			?>

		</div> 
	</div> <!-- End Footer -->
	<div id="footer-bottom">
		<div class="wrap">	
			<div id="footer-copyright">
				<?php echo $main_option['copyright'];?>
			</div>
			<div id="footer-socials">
				<?php if(count($social_option)>0){?>
					<?php foreach($social_option as $key=>$each_option){?>
						<?php if($key != 'rss' & trim($each_option) != ''){?>
							<a target="_blank" class="social-icon social-<?php echo $key;?>" href="<?php echo $each_option;?>"></a>
						<?php }?>
					<?php }?>
				<?php }?>
				<?php if($social_option['rss'] == 1){?>
					<a target="_blank" class="social-icon social-rss" href=" <?php bloginfo( 'rss2_url' ); ?> "></a>
				<?php }?>
			</div>
			<div class="cleared"></div>
		</div>
	</div><!-- End Footer Bottom -->
	</div><!-- End Page -->
</div><!-- End Site Background -->

<?php echo $main_option['tracking_code'];?>
<?php wp_footer(); ?>
</body>
</html>