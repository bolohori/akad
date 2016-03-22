<?php

/**
 * Adds Featured_Blog_Posts_Widget widget.
 */
class Featured_Blog_Posts_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'blog_posts_widget', // Base ID
			__( 'Enliven: Featured Blog Posts', 'enliven' ), // Name
			array( 'description' => __( 'Adds recent blog posts to the front page.', 'enliven' ), ) // Args
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

		global $post;

		$category = $instance['category'];
		// Latest Posts
		$latest_posts = new WP_Query( 
			array(
				'cat'				=>	$category,
				'posts_per_page'	=>	3,
				'post_status'		=>	'publish',
				'ignore_sticky_posts'=>	'true'
			)
		);	

		
		echo $args['before_widget'];

		?>
		<div class="enl-frnt-blog-widget">
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

			<?php $i = 1; ?>
			
			<div class="row">
				
			<?php
				if( $latest_posts->have_posts() ) :
					while ( $latest_posts->have_posts() ) : $latest_posts->the_post(); ?>
					
					<div class="col-xs-12 col-md-4 col-lg-4">
						<div class="enl-bpw-block">
							<?php if( has_post_thumbnail() ) : ?>
								<div class="enl-fps-thumb">
									<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('enliven-featured'); ?></a>
								</div>
							<?php endif; ?>

							<h2 class="enl-bpw-title">	
								<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>
							<div class="enl-bpw-meta">
								<?php the_date(); ?>
							</div>
							<div class="enl-bpw-desc">
								<?php
									if ( ! empty( $post->post_excerpt ) ) {
										echo the_excerpt(); 
									} else {
										echo '<p>' . enliven_excerpt(30) . '</p>';
									}
								?>
							</div>
						</div><!--.enl-bpw-block-->
					</div><!-- bootstrap-cols -->

				<?php
					if( $i%3 == 0 ) {
						echo '</div><!-- .row --><div class="row">';
					}
					$i++;
				?>	
				<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</div><!-- .row -->
		</div><!--.container -->
		</div><!--.enl-frnt-blog-widget -->
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
			'category'	=>	'all'
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
		<p>
			<label><?php _e( 'Select a post category', 'enliven' ); ?></label>
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name('category'), 'selected' => $instance['category'], 'show_option_all' => 'Show all posts', 'class' => 'widefat' ) ); ?>
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
			<label for="<?php echo $this->get_field_id( 'view_all_url' ); ?>"><?php _e( 'View all link: This should be the url for blog posts listing page.', 'enliven' ); ?></label> 
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
		$instance['category']	= $new_instance['category'];
		$instance['view_all_text'] = ( ! empty( $new_instance['view_all_text'] ) ) ? strip_tags( $new_instance['view_all_text'] ) : '';
		$instance['view_all_url'] = ( ! empty( $new_instance['view_all_url'] ) ) ? esc_url_raw( $new_instance['view_all_url'] ) : '';

		return $instance;
	}

} // class Featured_Blog_Posts_Widget

// register Featured_Blog_Posts_Widget widget
function register_featured_blog_posts() {
    register_widget( 'Featured_Blog_Posts_Widget' );
}
add_action( 'widgets_init', 'register_featured_blog_posts' );