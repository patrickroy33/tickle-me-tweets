<?php
/**
 * Adds Twitter_Widget widget.
 */
class Twitter_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'twitter_widget', // Base ID
			__('Latest Tweets Widget', 'twitter_widget'), // Name
			array( 'description' => __( 'Shows the latest tweets for a twitter handle specified', 'twitter_widget' ), ) // Args
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
		$title = $instance['title'];
		$count = $instance['count'];
		$handle = $instance['handle'];

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		do_shortcode ('[show_tweets screen_name="'.$handle.'" count="'.$count.'"]');

		echo $args['after_widget'];
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
			$title = __( 'Latest Tweets', 'twitter_widget' );
		}
		if (isset ($instance['handle'])) {
			$handle = $instance['handle'];
		}
		if (isset ($instance['count'])) {
			$count = $instance['count'];
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'handle' ); ?>"><?php _e( 'Twitter Handle:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'handle' ); ?>" name="<?php echo $this->get_field_name( 'handle' ); ?>" type="text" value="<?php echo esc_attr( $handle ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Number of Tweets:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>">
		</p>
		<?php 
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
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? $new_instance['title'] : '';
		$instance['handle'] = ( ! empty( $new_instance['handle'] ) ) ? strip_tags( $new_instance['handle'] ) : '';
		$instance['count'] = ( ! empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '';

		return $instance;
	}

} // class Twitter_Widget