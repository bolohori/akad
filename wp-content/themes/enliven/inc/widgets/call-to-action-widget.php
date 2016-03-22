<?php

/**
 * Adds call to action widget.
 */
class Enliven_Call_To_Action_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'enliven_call_to_action', // Base ID
			__( 'Enliven: Call to Action', 'enliven' ), // Name
			array( 'description' => __( 'Adds a call to action to the business homepage. Please use this widget only for "Business Template" widget area.', 'enliven' ), ) // Args
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
		echo $args['before_widget']; 

			global $post;

	 		$page_id = isset( $instance[ 'page_id' ] ) ? $instance[ 'page_id' ] : '';

	 		$page_args = array(
                'posts_per_page' => 1,
                'post_type' => 'page',
                'page_id' => $page_id,
            );

            $query = new WP_Query( $page_args );
            if ( $query->have_posts() ) :

                while ( $query->have_posts() ) : $query->the_post();  
				    
				    $image_id = get_post_thumbnail_id();
				    $imagesize = "full";
				    $image_url = wp_get_attachment_image_src($image_id, $imagesize);

            		?>

					<div class="enl-ct-action" style="background-image: url(<?php echo esc_url( $image_url[0] ); ?>);">
						<div class="container">
							
							<div class="enl-cta-title">
								<h1><?php the_title(); ?></h1>
							</div>
						
							<div class="enl-cta-desc">
								<?php if ( ! empty( $post->post_excerpt ) ) {
                                    echo the_excerpt(); 
                                } else {
                                    echo '<p>' . enliven_excerpt(30) . '</p>';
                                } ?>
							</div>
							
							<?php if( ! empty( $instance['button_text'] ) ) : 
								$button_url = ( ! empty( $instance['button_url'] ) ) ? $instance['button_url'] : '#'; ?>
								<a class="enl-cta-btn" href="<?php echo esc_url( $button_url ); ?>"><?php echo esc_html( $instance['button_text'] ); ?></a>
							<?php endif; ?>
								
						</div><!-- .container -->
					</div><!-- .enl-ct-action -->
		<?php 
			endwhile; 
			wp_reset_postdata();
		endif;
			

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
		$cta_page = ! empty( $instance['page_id'] ) ? $instance['page_id'] : ''; ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'page_id' ); ?>"><?php _e( 'Select Page', 'enliven' ); ?>:</label>
			<?php wp_dropdown_pages( array( 'show_option_none' =>' ', 'name' => $this->get_field_name( 'page_id' ), 'selected' => $cta_page, 'class' => 'widefat' ) ); ?>
		</p>
		<?php
			$button_text = ! empty( $instance['button_text'] ) ? $instance['button_text'] : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Button Text:', 'enliven' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo esc_attr( $button_text ); ?>">
		</p>		
		<?php
			$button_url = ! empty( $instance['button_url'] ) ? $instance['button_url'] : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'button_url' ); ?>"><?php _e( 'Button Url:', 'enliven' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'button_url' ); ?>" name="<?php echo $this->get_field_name( 'button_url' ); ?>" type="text" value="<?php echo esc_url( $button_url ); ?>">
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
		$instance[ 'page_id' ] = absint( $new_instance[ 'page_id' ] );
		$instance['button_text'] = ( ! empty( $new_instance['button_text'] ) ) ? strip_tags( $new_instance['button_text'] ) : '';
		$instance['button_url'] = ( ! empty( $new_instance['button_url'] ) ) ? esc_url_raw( $new_instance['button_url'] ) : '';
		return $instance;
	}

} // class Enliven_Call_To_Action_Widget

// register Foo_Widget widget
function register_enliven_call_to_action_widget() {
    register_widget( 'Enliven_Call_To_Action_Widget' );
}
add_action( 'widgets_init', 'register_enliven_call_to_action_widget' );