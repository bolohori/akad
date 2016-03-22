<?php

/**
 * Adds Enliven_Clients_Widget widget.
 */
class Enliven_Clients_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'enliven_clients_widget', // Base ID
			__( 'Enliven: Clients', 'enliven' ), // Name
			array( 'description' => __( 'A widget to display client logos or any kind of images. Please use this widget only for "Business Template" widget area.', 'enliven' ), ) // Args
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

		?>

			<div class="enliven-clients">
				<div class="container">
					<?php
						if ( ! empty( $instance['title'] ) ) {
							echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
						}
						echo '<div class="enl-client-logos clearfix">';
						for ( $i=1; $i<6; $i++ ) {
							if ( ! empty( $instance['logo_image'.$i] ) ) { ?>
								<div class="enl-cw-block">
									<div class="enl-logo-img">
										<?php 
											$image_link = ( ! empty( $instance['logo_image_link'.$i] ) ? $instance['logo_image_link'.$i] : '' );
											if ( ! empty($image_link) ) {
												echo '<a href="' . esc_url( $image_link ) . '">';
											}
												$grayscale = ( ( $instance['image_grayscale'] ) ) ? "enl-logo-grayscale" : "enl-no-grayscale";
												echo '<img class="'. $grayscale . '" src="'. esc_url( $instance['logo_image'.$i] ) .'" />';
										
											if ( ! empty($image_link) ) { 
												echo '</a>';
											}
										?>
									</div>
								</div>
								
								<?php
							}
						}
						echo '</div><!--.enl-client-logos-->';
					?>
				</div><!--.container-->
			</div><!--.enliven-clients-->

		<?php

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
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';

		$defaults = array(
			'image_grayscale' => 1
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'enliven' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
    	<?php
			$image_grayscale = $instance['image_grayscale'] ? 'checked="checked"' : '';
		?>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $image_grayscale; ?> id="<?php echo $this->get_field_id( 'image_grayscale' ); ?>" name="<?php echo $this->get_field_name( 'image_grayscale' ); ?>" />		
			<label for="<?php echo $this->get_field_id( 'image_grayscale' ); ?>"><?php _e( 'Convert images to black and white.', 'enliven' ); ?></label> 
		</p>
		
		<?php for( $i = 1; $i < 6; $i++ ) { 

			$logo_image = ! empty( $instance['logo_image' . $i] ) ? $instance['logo_image' . $i] : ''; ?>
			<p>
			<label for="<?php echo $this->get_field_id( 'logo_image'.$i ); ?>"><?php printf( __( 'Image %d.', 'enliven' ), $i ); ?></label>
			</p>
			<div class="media-picker-wrap">
	        <?php if( ! empty( $logo_image ) ) { ?>
				<img style="max-width:100%; height:auto;" class="media-picker-preview" src="<?php echo esc_url($logo_image); ?>" />
	            <span class="media-picker-remove">X</span>
	        <?php } ?>
	        <input class="widefat media-picker" id="<?php echo $this->get_field_id( 'logo_image'.$i ); ?>" name="<?php echo $this->get_field_name( 'logo_image'.$i ); ?>" value="<?php echo esc_url($logo_image); ?>" type="hidden" />
	        <a class="media-picker-button button" onclick="mediaPicker(this.id)" id="<?php echo $this->get_field_id( 'logo_image'.$i ).'mpick'; ?>"><?php _e('Select Image', 'enliven') ?></a>
	        </div>

	        <?php $logo_image_link = ! empty( $instance['logo_image_link' . $i] ) ? $instance['logo_image_link' . $i] : ''; ?>
	        <p>
	        <label for="<?php echo $this->get_field_id( 'logo_image_link'.$i ) ?>"><?php printf( __( 'Image link %d.', 'enliven' ), $i ); ?></label>
	        <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'logo_image_link'.$i ) ?>" name="<?php echo $this->get_field_name( 'logo_image_link'.$i ); ?>" value="<?php echo esc_url($logo_image_link); ?>" />
	        </p>
		
		<?php }

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
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['image_grayscale'] = isset( $new_instance['image_grayscale'] ) ? 1 : 0;
		for( $i=1; $i<6; $i++ ) {
			$instance['logo_image'.$i] = esc_url_raw($new_instance['logo_image'.$i]);
			$instance['logo_image_link'.$i] = esc_url_raw($new_instance['logo_image_link'.$i]);
		}
		return $instance;
	}

} // class Enliven_Clients_Widget

// register Enliven_Clients_Widget widget
function register_enliven_clients_widget() {
    register_widget( 'Enliven_Clients_Widget' );
}
add_action( 'widgets_init', 'register_enliven_clients_widget' );