<?php
class QAFP_Recent_Faqs extends WP_Widget {
	// Register widget with WordPress.
	function __construct() {
		parent::__construct(
			'qafp_recent_faqs', // Base ID
			__('Recent FAQs', 'qa-focus-plus'), // Name
			array( 'description' => __( 'Display the recents FAQs from Q and A Focus Plus.', 'qa-focus-plus' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
		if ( ! $instance['numberposts'] ) $instance['numberposts'] = 5;
		
		// get latest faqs
		$postargs = array(
		'numberposts' => $instance['numberposts'],
		'offset' => 0,
		'category' => 0,
		'orderby' => 'post_date',
		'order' => 'DESC',
		'post_type' => 'qa_faqs',
		'post_status' => 'publish',
		'suppress_filters' => true );
	
		$recent_posts = wp_get_recent_posts( $postargs, ARRAY_A );
		$the_faqs = '<ul>
		';
		foreach( $recent_posts as $recent ){
			$the_faqs .= '<li><a href="' . get_permalink($recent["ID"]) . '" title="'.esc_attr($recent["post_title"]).'" >' . $recent["post_title"].'</a></li>
			';
		}
		$the_faqs .= '</ul>
		';
				
		echo $the_faqs;

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ]; else $title = '';
		if ( isset( $instance[ 'numberposts' ] ) ) $numberposts = $instance[ 'numberposts' ]; else $numberposts = 5;
		if ( isset( $instance[ 'showfaqlink' ] ) ) $showfaqlink = $instance['showfaqlink']; else $showfaqlink = true;
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'qa-focus-plus' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        <p>
        <label for="<?php echo $this->get_field_id( 'numberposts' ); ?>"><?php _e( 'Number of FAQs to display:', 'qa-focus-plus' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'numberposts' ); ?>" name="<?php echo $this->get_field_name( 'numberposts' ); ?>" type="text" value="<?php echo esc_attr( $numberposts ); ?>" size="3" />
        </p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : 'Recent FAQs';
		$instance['numberposts'] = ( ! empty( $new_instance['numberposts'] ) ) ? strip_tags( $new_instance['numberposts'] ) : 5;

		return $instance;
	}

} // class QAFP_Recent_Faqs

// register QAFP_Recent_Faqs widget
function register_QAFP_Recent_Faqs() {
	register_widget( 'QAFP_Recent_Faqs' );
}
add_action( 'widgets_init', 'register_QAFP_Recent_Faqs' );
?>