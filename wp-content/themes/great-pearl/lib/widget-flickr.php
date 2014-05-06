<?php
/**
 * Plugin Name: Flickr widget
 */

add_action( 'widgets_init', 'wope_flickr_load_widgets' );

function wope_flickr_load_widgets() {
	register_widget( 'wope_flickr_widget' );
}

class wope_flickr_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	public function __construct() {
		parent::__construct(
	 		'wope_flickr_widget', // Base ID
			'wope Flickr', // Name
			array( 'description' => __( 'Display your flickr photos', 'text_domain' ), ) // Args
		);
	}

	/**
	 * How to display the widget on the screen.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		
		$flickrID = $instance['flickrID'];
		$postcount = $instance['postcount'];
		$type = $instance['type'];
		$display = $instance['display'];
		
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		?>
		
			<div id="flickr_badge_wrapper">
				<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $postcount ?>&amp;display=<?php echo $display ?>&amp;size=s&amp;layout=x&amp;source=<?php echo $type ?>&amp;<?php echo $type ?>=<?php echo $flickrID ?>"></script>
			</div>
			
		<?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['flickrID'] = strip_tags( $new_instance['flickrID'] );
		$instance['postcount'] = $new_instance['postcount'];
		$instance['type'] = $new_instance['type'];
		$instance['display'] = $new_instance['display'];

		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'flickrID' => '','title' => 'My Photostream', 'postcount' => 6, 'type' => 'user', 'display' => 'random',);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  type="text" class="widefat" />
		</p>
		
		<!-- Flickr ID -->
		<p>
			<label for="<?php echo $this->get_field_id( 'flickrID' ); ?>">Flickr ID :</label>
			<input id="<?php echo $this->get_field_id( 'flickrID' ); ?>" name="<?php echo $this->get_field_name( 'flickrID' ); ?>" value="<?php echo $instance['flickrID']; ?>"  type="text" class="widefat" />
			<a href="http://idgettr.com/" target="_blank">Get Your ID</a>
		</p>
		
		<!-- Number of posts -->
		<p>
			<label for="<?php echo $this->get_field_id( 'postcount' ); ?>">Number of photos</label>
			<select id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>">
				<option <?php selected($instance['postcount'],3);?>>3</option>
				<option <?php selected($instance['postcount'],6);?>>6</option>
				<option <?php selected($instance['postcount'],9);?>>9</option>
			</select>
		</p>
		
		<!-- Type -->
		<p>
			<label for="<?php echo $this->get_field_id( 'type' ); ?>">Type:</label>
			<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>">
				<option <?php selected($instance['type'],'user');?>>user</option>
				<option <?php selected($instance['type'],'group');?>>group</option>
			</select>
		</p>
		
		<!-- Display -->
		<p>
			<label for="<?php echo $this->get_field_id( 'display' ); ?>">Photo Order:</label>
			<select id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>">
				<option <?php selected($instance['display'],'random');?>>random</option>
				<option <?php selected($instance['display'],'latest');?>>latest</option>
			</select>
		</p>


	<?php
	}
}

?>