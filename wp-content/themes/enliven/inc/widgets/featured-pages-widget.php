<?php

/**
 * Adds Enliven_Featured_Pages_Widget widget.
 */
class Enliven_Featured_Pages_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'enl_featured_pages_widget', // Base ID
			__( 'Enliven: Featured Pages', 'enliven' ), // Name
			array( 'description' => __( 'A widget that adds pages with featured images to the front page. Please use this widget only for "Business Template" widget area.', 'enliven' ), ) // Args
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

		$page_array = array();
		for( $i=1; $i<7; $i++ ) {
			$page_id = isset( $instance[ 'featured_page'.$i ] ) ? $instance[ 'featured_page'.$i ] : '';
			if( !empty( $page_id ) ) {
				array_push( $page_array, $page_id );
			}
		}
		$show_page_titles = isset( $instance['show_page_titles'] ) ? $instance['show_page_titles'] : false;
		$show_page_excerpts = isset( $instance['show_page_excerpts'] ) ? $instance['show_page_excerpts'] : false;

		$featured_pages = new WP_Query(
			array (
				'posts_per_page'	=> -1,
				'post_type'			=> array( 'page' ),
				'post__in'			=> $page_array,
				'orderby'			=> 'post__in'
			)
		);

		?>

		<div class="enl-featured-pages">
			<div class="container">
			<?php
				if ( ! empty( $instance['title'] ) ) {
					echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
				}

				if( ! empty( $instance['description'] ) ){
					echo '<p class="enl-fp-widget-desc">' . esc_html( $instance['description'] ) . '</p>';
				}

				if ( ! empty( $instance['view_all_text'] ) ) {
				$view_all_url = ( ! empty( $instance['view_all_url'] ) ? $instance['view_all_url'] : '#' );
				echo '<p class="frnt-wgt-view-all"><a href="'. esc_url( $view_all_url ) .'">' . esc_html( $instance['view_all_text'] ) . '</a></p>';
			}
			?>
				<div class="row">
					<?php 
						$j = 1;

						if ( $featured_pages->have_posts() ) :
						
							while( $featured_pages->have_posts() ) : $featured_pages->the_post(); ?>
						
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<div class="enl-fpage-block">
									
									<?php if( has_post_thumbnail() ) : ?>
										<div class="enl-fps-thumb">
											<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('enliven-featured'); ?></a>
										</div>
									<?php endif; ?>

									<?php if( $show_page_titles == true ) : ?>
										<h2 class="enl-fp-title">	
											<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h2>
									<?php endif; ?>

									<?php if( $show_page_excerpts == true ) : ?>	
										<div class="enl-fp-desc">
											<?php
												if ( ! empty( $post->post_excerpt ) ) {
													echo the_excerpt(); 
												} else {
													echo '<p>' . enliven_excerpt(40) . '</p>';
												}
											?>
										</div>
									<?php endif; ?>

								</div><!-- .enl-fpage-block -->
							</div><!--.bootstrap cols -->
							
							<?php	
								if( $j == 3 ) {
									echo '</div><div class="row">';
								}
							?>

						<?php 
							$j++;
							endwhile; 
							wp_reset_postdata();

						endif;
					?>
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .enl-featured-pages -->

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

		$defaults = array();
		$defaults['show_page_titles'] = 1;
		$defaults['show_page_excerpts'] = 1;
		$instance = wp_parse_args( (array) $instance, $defaults );

		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
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
			<label for="<?php echo $this->get_field_id( 'view_all_url' ); ?>"><?php _e( 'View all link:', 'enliven' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'view_all_url' ); ?>" name="<?php echo $this->get_field_name( 'view_all_url' ); ?>" type="text" value="<?php echo esc_url( $view_all_url ); ?>">
		</p>		
		<?php
			$show_page_titles = $instance['show_page_titles'] ? 'checked="checked"' : '';
		?>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $show_page_titles; ?> id="<?php echo $this->get_field_id( 'show_page_titles' ); ?>" name="<?php echo $this->get_field_name( 'show_page_titles' ); ?>" />		
			<label for="<?php echo $this->get_field_id( 'show_page_titles' ); ?>"><?php _e( 'Display page titles.', 'enliven' ); ?></label> 
		</p>
		<?php
			$show_page_excerpts = $instance['show_page_excerpts'] ? 'checked="checked"' : '';
		?>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $show_page_excerpts; ?> id="<?php echo $this->get_field_id( 'show_page_excerpts' ); ?>" name="<?php echo $this->get_field_name( 'show_page_excerpts' ); ?>" />		
			<label for="<?php echo $this->get_field_id( 'show_page_excerpts' ); ?>"><?php _e( 'Display page excerpts.', 'enliven' ); ?></label> 
		</p>
		<?php
		for( $i = 1; $i < 7; $i++ ) { 
			$featured_page = ! empty( $instance['featured_page'.$i] ) ? $instance['featured_page'.$i] : ''; ?>
			<p>
				<label for="<?php echo $this->get_field_id( 'featured_page'.$i ); ?>"><?php printf( __( 'Featured page %d.', 'enliven' ), $i ) ?></label>
				<?php wp_dropdown_pages( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'featured_page'.$i ), 'class' => 'widefat', 'selected' => $featured_page ) ); ?>
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
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
		$instance['view_all_text'] = ( ! empty( $new_instance['view_all_text'] ) ) ? strip_tags( $new_instance['view_all_text'] ) : '';
		$instance['view_all_url'] = ( ! empty( $new_instance['view_all_url'] ) ) ? esc_url_raw( $new_instance['view_all_url'] ) : '';
		$instance['show_page_titles'] = isset( $new_instance['show_page_titles'] ) ? 1 : 0;
		$instance['show_page_excerpts'] = isset( $new_instance['show_page_excerpts'] ) ? 1 : 0;
		for( $i = 1; $i < 7; $i++ ) { 
			$instance['featured_page'.$i] = ( ! empty( $new_instance['featured_page'.$i] ) ) ? strip_tags( $new_instance['featured_page'.$i] ) : '';
		}
		return $instance;
	}

} // class Featured_Pages_Widget

// register Featured_Pages_Widget widget
function register_enliven_featured_pages_widget() {
    register_widget( 'Enliven_Featured_Pages_Widget' );
}
add_action( 'widgets_init', 'register_enliven_featured_pages_widget' );