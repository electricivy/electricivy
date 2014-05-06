<?php
get_template_part('lib'.DS.'widget-flickr');
get_template_part('lib'.DS.'widget-twitter');

//post widget
class wope_Posts_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'wope_posts_widget', // Base ID
			'wope Posts', // Name
			array( 'description' => __( 'A lastest Posts Widget with Thumb', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		$current_category = $instance[ 'category' ];
		$post_number = $instance[ 'post_number' ];
		
		$args = array(
			'posts_per_page' => $post_number
		);
		
		if($current_category != 0 or $current_category != ''){
			$args['cat'] = $current_category;
		}
		
		// The Query
		$the_query = new WP_Query( $args );
		
		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		// The Loop
		while ( $the_query->have_posts() ) : $the_query->the_post();
			?>
			<div class="widget-post">
				<a class="widget-post-thumb" href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'post-thumb' );?>
				</a>
				<a class="widget-post-title" href="<?php the_permalink(); ?>"><?php the_title();?></a>
				<a class="widget-post-date" href="<?php the_permalink(); ?>"><?php the_date();?></a>
				<div class="cleared"></div>
			</div>
			
			<?php
		endwhile;
		// Reset Post Data
		wp_reset_postdata();
		echo $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['category'] = strip_tags( $new_instance['category'] );
		$instance['post_number'] = strip_tags( $new_instance['post_number'] );

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
	
		//get all categories
		$categories = get_categories( );
		
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Recent Posts', 'text_domain' );
		}
		
		if ( isset( $instance[ 'post_number' ] ) ) {
			$post_number = $instance[ 'post_number' ];
		}
		else {
			$post_number = __( 5, 'text_domain' );
		}
		
		if ( isset( $instance[ 'category' ] ) ) {
			$current_category = $instance[ 'category' ];
		}else{
			$current_category = 0;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category :' ); ?></label> 
			
			<?php if(is_array($categories)){?>
				<select name="<?php echo $this->get_field_name( 'category' ); ?>">
					<option value="0">All Categories</option>
					<?php foreach($categories as $each_category){?>
						<?php if($current_category == $each_category->term_id ){?>
							<option selected="selected" value="<?php echo $each_category->term_id ;?>"><?php echo $each_category->name ;?></option>
						<?php }else{?>
							<option value="<?php echo $each_category->term_id ;?>"><?php echo $each_category->name ;?></option>
						<?php }?>
						
					<?php }?>
				</select>
			<?php }?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'post_number' ); ?>"><?php _e( 'Number of posts to show :' ); ?></label> 
			<input size="3" id="<?php echo $this->get_field_id( 'post_number' ); ?>" name="<?php echo $this->get_field_name( 'post_number' ); ?>" type="text" value="<?php echo esc_attr( $post_number ); ?>" />
		</p>
		<?php 
	}

} // class wope_Posts_Widget

// register wope_Posts_Widget widget
add_action( 'widgets_init', create_function( '', 'register_widget( "wope_Posts_Widget" );' ) );


//comment widget
class wope_Comments_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'wope_comments_widget', // Base ID
			'wope Comments', // Name
			array( 'description' => __( 'A lastest Comments Widget with Avatar', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		$comment_number = $instance[ 'comment_number' ];

		
		$args = array(
			'status' => 'approve',
			'number' => $comment_number,
		);
		$comments = get_comments($args);
	
		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		// The Loop
		if(is_array($comments)){
			foreach($comments as $comment) :
				$post_url = get_permalink($comment->comment_post_ID).'#li-comment-'.$comment->comment_ID  ;
				?>
				<div class="widget-comment">
					<a class="widget-comment-avatar" href="<?php echo $post_url;?>"><?php echo get_avatar( $comment->comment_author_email, 44 ); ?></a>
					<a class="widget-comment-author" href="<?php echo $post_url;?>"><?php echo $comment->comment_author;?></a>
					<a class="widget-comment-content" href="<?php echo $post_url;?>"><?php echo text_limit($comment->comment_content,8,'...') ;?></a>
					<div class="cleared"></div>
				</div>
				<?php
			endforeach;
		}

		echo $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['comment_number'] = strip_tags( $new_instance['comment_number'] );

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Recent Comments', 'text_domain' );
		}
		
		if ( isset( $instance[ 'comment_number' ] ) ) {
			$comment_number = $instance[ 'comment_number' ];
		}
		else {
			$comment_number = __( 5, 'text_domain' );
		}
		
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'comment_number' ); ?>"><?php _e( 'Number of Comments to show :' ); ?></label> 
			<input size="3" id="<?php echo $this->get_field_id( 'comment_number' ); ?>" name="<?php echo $this->get_field_name( 'comment_number' ); ?>" type="text" value="<?php echo esc_attr( $comment_number ); ?>" />
		</p>
		<?php 
	}

} // class wope_Comments_Widget

// register wope_Comments_Widget widget
add_action( 'widgets_init', create_function( '', 'register_widget( "wope_Comments_Widget" );' ) );

//feature project widget
class wope_Projects_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'wope_projects_widget', // Base ID
			'wope Projects', // Name
			array( 'description' => __( 'A Widget to show your lastest or featured Projects', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		$project_number = $instance[ 'project_number' ];
		$category = $instance[ 'category' ];
		$list_type = $instance[ 'list_type' ];

		$args = array(
			'post_type' => 'project',
			'posts_per_page' => $project_number,
		);
		
		if($category != 0){
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'project-category',
					'field' => 'term_id',
					'terms' => $category,
				)
			);
		}
		
		if($list_type == 1){
			$args['meta_query'] = array(
				array(
					'key' => 'featured_project',
					'value' => 1,
				)
			);
		}
		
		// The Query
		$the_query = new WP_Query( $args );
	
		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
			
		
		if ( $the_query->have_posts() ) {
			$total_project = 1;
			while ( $the_query->have_posts() ) : $the_query->the_post();
				$project_label 		= get_post_meta( $the_query->post->ID, 'project_label', true );
				$project_sublabel 	= get_post_meta( $the_query->post->ID, 'project_sublabel', true );
				$project_thumb 		= get_post_meta( $the_query->post->ID, 'project_thumb', true );
				$project_day 		= get_post_meta( $the_query->post->ID, 'project_day', true );
				$project_month 		= get_post_meta( $the_query->post->ID, 'project_month', true );
				$project_year 		= get_post_meta( $the_query->post->ID, 'project_year', true );
				
				if($total_project == 2){
					$column_last = 'column-last';
					$clear_div = '<div class="cleared"></div>';
					$total_project = 1;
				}else{
					$column_last = '';
					$clear_div = '';
					$total_project++;
				}
				?>
					<div class="column2_1 <?php echo $column_last;?>">
						<div class="project-cell">
							<div class="project-cell-thumb">
								<div class="project-cell-thumb-window">
								
									<img src="<?php echo $project_thumb;?>">
									<span class="thumb-icon"></span>
									<div class="project-cell-info">
										<div class="project-cell-title">
											<a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a>
										</div>
									</div>
									
								</div>
							</div>
							
						</div>
					</div><?php echo $clear_div;?>
			<?php
			endwhile;
			echo '<div class="cleared"></div>';
		}
			
		echo $after_widget;
		
		// Reset Post Data
		wp_reset_postdata();
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] 			= strip_tags( $new_instance['title'] );
		$instance['project_number'] = strip_tags( $new_instance['project_number'] );
		$instance['category'] 		= strip_tags( $new_instance['category'] );
		$instance['list_type'] 		= strip_tags( $new_instance['list_type'] );

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
	
		//get project categories
		$args = array(
			'type'		 =>'project',
			'taxonomy'   => 'project-category',
			'hide_empty' => '0'
		); 
		$project_taxonomies = get_categories($args); 
		
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Recent Projects', 'text_domain' );
		}
		
		if ( isset( $instance[ 'project_number' ] ) ) {
			$project_number = $instance[ 'project_number' ];
		}
		else {
			$project_number = __( 4, 'text_domain' );
		}
		
		if ( isset( $instance[ 'category' ] ) ) {
			$current_category = $instance[ 'category' ];
		}
		
		if ( isset( $instance[ 'list_type' ] ) ) {
			$list_type = $instance[ 'list_type' ];
		}else{
			$list_type = 2;
		}
		
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<input <?php checked($list_type,1) ;?> type="radio" id="<?php echo $this->get_field_id( 'list_type_feature' ); ?>" name="<?php echo $this->get_field_name( 'list_type' ); ?>" value="1" />
			<label for="<?php echo $this->get_field_id( 'list_type_feature' ); ?>"><?php _e( 'Featured' ); ?></label> 
			<input <?php checked($list_type,2) ;?> type="radio" id="<?php echo $this->get_field_id( 'list_type_lastest' ); ?>" name="<?php echo $this->get_field_name( 'list_type' ); ?>" value="2" />
			<label for="<?php echo $this->get_field_id( 'list_type_lastest' ); ?>"><?php _e( 'Lastest' ); ?></label> 
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category :' ); ?></label> 
			
			<?php if(is_array($project_taxonomies)){?>
				<select name="<?php echo $this->get_field_name( 'category' ); ?>">
					<option value="0">All Categories</option>
					<?php foreach($project_taxonomies as $each_category){?>
						<?php if($current_category == $each_category->term_id ){?>
							<option selected="selected" value="<?php echo $each_category->term_id ;?>"><?php echo $each_category->name ;?></option>
						<?php }else{?>
							<option value="<?php echo $each_category->term_id ;?>"><?php echo $each_category->name ;?></option>
						<?php }?>
						
					<?php }?>
				</select>
			<?php }?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'project_number' ); ?>"><?php _e( 'Number of Projects to show :' ); ?></label> 
			<input size="3" id="<?php echo $this->get_field_id( 'project_number' ); ?>" name="<?php echo $this->get_field_name( 'project_number' ); ?>" type="text" value="<?php echo esc_attr( $project_number ); ?>" />
		</p>
		
		<?php 
	}

} // class wope_Projects_Widget

// register wope_Projects_Widget widget
add_action( 'widgets_init', create_function( '', 'register_widget( "wope_Projects_Widget" );' ) );