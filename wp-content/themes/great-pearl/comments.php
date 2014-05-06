<?php
/**
 * The template for displaying Comments.
 *
 */
?>
	
	<?php if ( post_password_required() ) { ?>
	<div id="comment-section">
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'wope' ); ?></p>
	</div>
	<?php } ?>
	<?php if( comments_open() ) {?>
		<div id="comment-section">
			
			<?php 
			if(wp_count_comments($post->ID)->approved > 0 ){?>
				<div class="container-title">
					<a href="#comment-form"><?php comments_number(  'No Comment' , '1 Comment', '% Comments'); ?></a>
				</div>
				
				<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // Are there comments to navigate through? ?>
					<div class="comment-navigation">
						<div class="comment-previous"><?php previous_comments_link( __( 'Older Comments <span class="meta-nav"> &rarr;</span>', 'wope' ) ); ?></div>
						<div class="comment-next"><?php next_comments_link( __( '<span class="meta-nav">&larr;</span> Newer Comments', 'wope' ) ); ?></div>
						<div class="cleared"></div>
					</div> <!-- .navigation -->
				<?php } // check for comment navigation ?>
				
				<div id="comment-container">
					<ul>
					<?php 
					 $args = array(
						'type=' => 'comment',
						'callback' => 'wope_comment',
						'reverse_top_level' => true,
						'reverse_children'  =>  false 
					); 
					wp_list_comments( $args ); ?> 
					</ul>		
				</div>
			<?php }?>
			<div id="comment-form">
				<?php wope_comment_form(); ?> 
			</div>
		</div>
	<?php }?>
<?php

//wope comment forum
function wope_comment_form(){
	$post_option = get_option('wope-post');
	
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$fields =  array(
		'author' => 	'<p class="comment-form-author">' .
							'<input id="comment-author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />'.
							'<label for="comment-author">' . __( 'Name', 'domainreference' ) . 
							( $req ?  '  <span class="required"> *</span>' : '' ) .'</label> ' .
						'</p>',
		'email'  => 	'<p class="comment-form-email"> '.
							'<input id="comment-email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />'.
							'<label for="comment-email">' . __( 'Email', 'domainreference' ) .
							( $req ?  '<span class="required"> *</span>' : '' ) . '</label> ' .
						'</p>',
		'url'    => 	'<p class="comment-form-url">'.
							'<input id="comment-url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />'.
							'<label for="comment-url">' . __( 'Website', 'domainreference' ) . '</label>'.
						'</p>',
	);
	
	$args = array(
		'fields' => $fields,
		'title_reply' => __( '<span>'.$post_option['comment_form_title'].'</span>' ),
		'label_submit' => __( $post_option['submit_comment_name'] ),
		'comment_field' => '<p class="comment-form-comment">
							<textarea name="comment" rows="14"></textarea>
						</p>',
		'comment_notes_before'	=> '<p class="comment-notes">' .$post_option['comment_form_note']. '</p>',	
	);
	comment_form($args);
}

?>