<?php

if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'custom-content-types' ) ) :

/**
 * Adds a portfolio widget.
 */
class Enliven_Portfolio_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'enl_portfolio_widget', // Base ID
			__( 'Enliven: Portfolio', 'enliven' ), // Name
			array( 'description' => __( 'Adds a filterble portfolio section to the homepage. Please use this widget only for "Business Template" widget area.', 'enliven' ), ) // Args
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

		<div class="enl-portfolio-container clearfix">

		<div class="container enl-port-block-title">
			<?php

			if ( ! empty( $instance['title'] ) ) {
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
			}

			if ( ! empty( $instance['description'] ) ) {
				echo '<p class="enl-port-widget-desc">' . esc_html( $instance['description'] ) . '</p>';
			}

			if ( ! empty( $instance['view_all_text'] ) ) {
				$view_all_url = ( ! empty( $instance['view_all_url'] ) ? $instance['view_all_url'] : '#' );
				echo '<p class="frnt-wgt-view-all"><a href="'. esc_url( $view_all_url ) .'">' . esc_html( $instance['view_all_text'] ) . '</a></p>';
			}

			?>
		</div><!--.enl-port-block-title -->

		<div class="enl-portfolio">
			<?php

				global $post;

				if ( get_query_var( 'paged' ) ) :
					$paged = get_query_var( 'paged' );
				elseif ( get_query_var( 'page' ) ) :
					$paged = get_query_var( 'page' );
				else :
					$paged = -1;
				endif;

				$posts_per_page = ( !empty( $instance['number_of_posts'] ) ? $instance['number_of_posts'] : 8 );
				$portfolio_term_id = isset( $instance['portfolio_category'] ) ? $instance['portfolio_category'] : 0;
					
				if ( $portfolio_term_id != 0 ) {
					$tax_query = array(
						array(
							'taxonomy' 	=> 'jetpack-portfolio-type',
							'field'    	=> 'term_id',
							'terms'    	=> $portfolio_term_id,
						)
					);
				} else {
					$tax_query = '';
				}

				$project_query = new WP_Query ( 
					array(
						'post_type'		 => 'jetpack-portfolio',
						'paged'          => $paged,
						'posts_per_page' => $posts_per_page,
						'tax_query' 	 => $tax_query,
					)
				);


				if ( post_type_exists( 'jetpack-portfolio' ) && $project_query -> have_posts() ) :

					while ( $project_query -> have_posts() ) : $project_query -> the_post(); ?>
						
							<figure class="enl-portfolio-item">
							    <figcaption class="enl-port-details">
						    		<h3 class="enl-port-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title() ?></a></h3>
					    			<span class="enl-port-icon"><i class="fa fa-caret-right"></i></span>
						    	</figcaption>
							    
						        <?php  
						        	if ( '' != get_the_post_thumbnail() ) { ?>
						        		<a href="<?php the_permalink() ?>" rel="bookmark"></a>
						        	 	<?php the_post_thumbnail( 'enliven-one-by-one' ); ?>
						        <?php } ?>
							</figure><!-- .enl-portfolio-item -->
						
						<?php

					endwhile;

					wp_reset_postdata();

				else :
			?>

				<div class="enl-port-no-results">
					<header>
						<h3 class="page-title"><?php _e( 'No Projects Found', 'enliven' ); ?></h3>
					</header>

					<div class="container">

						<?php if ( current_user_can( 'publish_posts' ) ) : ?>

							<p><?php printf( __( 'Ready to publish your first project? <a href="%1$s">Get started here</a>.', 'enliven' ), esc_url( admin_url( 'post-new.php?post_type=jetpack-portfolio' ) ) ); ?></p>
	
						<?php endif; ?>

					</div><!-- .container -->
				</div><!-- .enl-port-no-results -->
			<?php endif; ?>
		</div><!-- .enl-portfolio -->

	</div><!-- .enl-portfolio-container -->

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
		$defaults = array(
			'portfolio_category'	=>	'all'
		);
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
		$number_of_posts = ! empty( $instance['number_of_posts'] ) ? $instance['number_of_posts'] : 8;
		?>		
		<p>
			<label for="<?php echo $this->get_field_id( 'number_of_posts' ); ?>"><?php _e( 'Number of portfolio items:', 'enliven' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'number_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'number_of_posts' ); ?>" type="number" value="<?php echo esc_attr( $number_of_posts ); ?>">
		</p>

		<p>
			<label><?php _e( 'Select a portfolio category', 'enliven' ); ?></label>
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name('portfolio_category'), 'selected' => $instance['portfolio_category'], 'taxonomy' => 'jetpack-portfolio-type','show_option_all' => 'Show all portfolio items', 'class' => 'widefat' ) ); ?>
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
			<label for="<?php echo $this->get_field_id( 'view_all_url' ); ?>"><?php _e( 'View all link ( Normally this should be http://www.yoursite.com/portfolio/ ):', 'enliven' ); ?></label> 
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
		$instance['portfolio_category']	= $new_instance['portfolio_category'];
		$instance['number_of_posts'] = ( ! empty( $new_instance['number_of_posts'] ) && intval( $new_instance['number_of_posts'] ) ) ? strip_tags( $new_instance['number_of_posts'] ) : 4;
		$instance['view_all_text'] = ( ! empty( $new_instance['view_all_text'] ) ) ? strip_tags( $new_instance['view_all_text'] ) : '';
		$instance['view_all_url'] = ( ! empty( $new_instance['view_all_url'] ) ) ? esc_url_raw( $new_instance['view_all_url'] ) : '';		
		return $instance;
	}

} // class Enliven_Portfolio_Widget

// register Enliven_Portfolio_Widget widget
function register_enliven_portfolio_widget() {
    register_widget( 'Enliven_Portfolio_Widget' );
}
add_action( 'widgets_init', 'register_enliven_portfolio_widget' );

endif;