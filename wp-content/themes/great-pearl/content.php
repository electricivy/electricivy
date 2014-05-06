			<?php $post_option = get_option('wope-post');?>
			<div class="post-entry">
				<div class="post-entry-thumb">
					<a href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail();?></a>
				</div>
				<div class="post-entry-meta">
					<?php wope_show_meta();?>
				</div>
				<div class="post-entry-main-content">
					<div class="post-entry-title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</div>
					
					<div class="post-entry-content">
						<?php the_content( '' ); ?>
					</div>
					<div class="post-entry-button">
						<a class="small-button" href="<?php the_permalink(); ?>"><?php echo $post_option['readmore_label'];?></a>
					</div>
				</div>
				<div class="cleared"></div>
			</div>
			<!-- End Post Entry -->