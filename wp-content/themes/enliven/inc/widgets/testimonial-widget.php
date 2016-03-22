<?php
if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'custom-content-types' ) ) :

/**
 * Adds Enliven_Testimonial_Widget widget.
 */
class Enliven_Testimonial_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'enl_testimonial_widget', // Base ID
			__( 'Enliven: Testimonial', 'enliven' ), // Name
			array( 'description' => __( 'Adds a testimonial section to the front page. Please use this widget only for "Business Template" widget area.', 'enliven' ), ) // Args
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

		$query = new WP_Query( array(
			'posts_per_page' => 100,
			'fields'         => 'ids',
			'post_type'      => 'jetpack-testimonial'
		) );

		$number_of_posts = ( ! empty( $instance['number_of_posts'] ) ) ? $instance['number_of_posts'] : 4;

		$post_ids = $query->posts;
		shuffle( $post_ids );
		$post_ids = array_splice( $post_ids, 0, $number_of_posts );

		$testimonials = get_posts( array(
			'post__in'    => $post_ids,
			'numberposts' => count( $post_ids ),
			'post_type'   => 'jetpack-testimonial'
		) );

		echo $args['before_widget']; ?>

		<div class="enl-frnt-testimonials">
			<div class="container">

				<?php

				if ( ! empty( $instance['title'] ) ) {
					echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
				}

				if ( ! empty( $instance['description'] ) ) {
					echo '<p class="enl-tstw-desc">' . esc_html( $instance['description'] ) . '</p>';
				}

				if ( ! empty( $instance['view_all_text'] ) ) {
					$view_all_url = ( ! empty( $instance['view_all_url'] ) ? $instance['view_all_url'] : '#' );
					echo '<p class="frnt-wgt-view-all"><a href="'. esc_url( $view_all_url ) .'">' . esc_html( $instance['view_all_text'] ) . '</a></p>';
				}

				if ( ! empty( $testimonials ) ) : ?>
					<div class="enl-tstmnl-outer">
						<div class="flexslider loading" id="enl-tstmnl-slider">
						    <ul class="slides">

								<?php foreach ( $testimonials as $testimonial ) : setup_postdata( $GLOBALS['post'] =& $testimonial ); ?>

						            <li>
										<div class="enl-testimonial-block">
											<?php if ( has_post_thumbnail() ) : ?>
												<div class="enl-testimonial-image">
													<?php the_post_thumbnail('enliven-small-thumb'); ?>
												</div><!-- .enl-testimonial-image -->
											<?php else : ?>
												<div class="enl-tst-plcehldr">
													<i class="fa fa-quote-left"></i> 
												</div>
											<?php endif; ?>
												
											<div class="enl-testimonial-content">
												<div class="enl-testimonial-text"><?php the_content(); ?></div>
												<div class="enl-testimonial-author">- <?php the_title(); ?></div>
											</div><!-- .enl-testimonial-content -->
										</div><!-- .enl-testimonial-block -->
									</li>

								<?php endforeach; ?>
											
							</ul>
						</div>
					</div>
				
				<?php else : ?>

					<div class="enl-port-no-results">
						<header>
							<h3 class="page-title"><?php _e( 'No Testimonials Found', 'enliven' ); ?></h3>
						</header>

						<div class="container">

							<?php 
								if ( ! post_type_exists( 'jetpack-testimonial' ) ) :
									
									echo "You have not yet activated the jetpack testimonial feature. Please activate it.";
								
								else :
							?>
									<?php if ( current_user_can( 'publish_posts' ) ) { ?>

										<p><?php printf( __( 'Ready to publish your first project? <a href="%1$s">Get started here</a>.', 'enliven' ), esc_url( admin_url( 'post-new.php?post_type=jetpack-testimonial' ) ) ); ?></p>

									<?php } ?>
									
							<?php endif; ?>

						</div><!-- .container -->
					</div><!-- .enl-port-no-results -->
				
				<?php endif; ?>

			</div><!-- .container -->
		</div><!-- .enl-frnt-testimonials -->

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

		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'enliven' );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'enliven' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
		$description = ! empty( $instance['description'] ) ? $instance['description'] : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description:', 'enliven' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" type="text" value="<?php echo esc_attr( $description ); ?>">
		</p>		
		<?php
			$number_of_posts = ! empty( $instance['number_of_posts'] ) ? $instance['number_of_posts'] : 4;
		?>		
		<p>
			<label for="<?php echo $this->get_field_id( 'number_of_posts' ); ?>"><?php _e( 'Number of testimonials to display:', 'enliven' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'number_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'number_of_posts' ); ?>" type="number" value="<?php echo esc_attr( $number_of_posts ); ?>">
		</p>
		
		<?php 
			$view_all_text = ! empty( $instance['view_all_text'] ) ? $instance['view_all_text'] : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'view_all_text' ); ?>"><?php _e( 'View all text:', 'enliven' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'view_all_text' ); ?>" name="<?php echo $this->get_field_name( 'view_all_text' ); ?>" type="text" value="<?php echo esc_attr( $view_all_text ); ?>">
		</p>

		<?php
			$view_all_url = ! empty( $instance['view_all_url'] ) ? $instance['view_all_url'] : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'view_all_url' ); ?>"><?php _e( 'View all link ( Normally this should be http://www.yoursite.com/testimonial/ ):', 'enliven' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'view_all_url' ); ?>" name="<?php echo $this->get_field_name( 'view_all_url' ); ?>" type="text" value="<?php echo esc_url( $view_all_url ); ?>">
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
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';		
		$instance['number_of_posts'] = ( ! empty( $new_instance['number_of_posts'] ) && intval( $new_instance['number_of_posts'] ) ) ? strip_tags( $new_instance['number_of_posts'] ) : 4;
		$instance['view_all_text'] = ( ! empty( $new_instance['view_all_text'] ) ) ? strip_tags( $new_instance['view_all_text'] ) : '';
		$instance['view_all_url'] = ( ! empty( $new_instance['view_all_url'] ) ) ? esc_url_raw( $new_instance['view_all_url'] ) : '';
		return $instance;
	}

} // class Enliven_Testimonial_Widget


// register Enliven_Testimonial_Widget widget
function register_enliven_testimonial_widget() {
    register_widget( 'Enliven_Testimonial_Widget' );
}
add_action( 'widgets_init', 'register_enliven_testimonial_widget' );

endif;