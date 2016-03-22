<?php

/**
 * Adds Enliven_Blocks_Widget widget.
 */
class Enliven_Blocks_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		parent::__construct(
			'enl_blocks_widget', // Base ID
			__( 'Enliven: Icon Blocks', 'enliven' ), // Name
			array( 'description' => __( 'Adds icon boxes with descriptions to your site. Please use this widget only for "Business Template" widget area.', 'enliven' ), ) // Args
		);
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
		echo $args['before_widget'];
		?>	
			<div class="enl-blocks-widget">
				<div class="container">
					
					<?php
						if ( ! empty( $instance['title'] ) ) {
							echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
						}
						
						if( ! empty( $instance['widget_description'] ) ) { ?>
							<div class="enl-block-widget-desc">
								<p><?php echo esc_html( $instance['widget_description'] ); ?></p>
							</div>
					<?php } ?>
					
					<div class="row">
						
					<?php 
						global $post;
 						$page_array = array();

				 		for( $i=0; $i<7; $i++ ) {
				 			$page_id = isset( $instance[ 'page_id'.$i ] ) ? $instance[ 'page_id'.$i ] : '';

				 			if( !empty( $page_id ) ) {
				 				array_push( $page_array, $page_id );
				 			}
				 		}

				 		$page_args = array(
	                        'posts_per_page' => 6,
	                        'post_type' => 'page',
	                        'post__in' => $page_array,
	                        'orderby' => 'post__in'
	                    );

	                    $query = new WP_Query( $page_args );
	                    if ( $query->have_posts() ) :
	                        $i = 1;
	                        while ( $query->have_posts() ) : $query->the_post();  ?>

							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<div class="enl-block">
									<?php 
										$icon = ! empty( $instance['font_icon'.$i] ) ? $instance['font_icon'.$i] : '';
										if ( ! empty( $icon ) ) : ?>
											<div class="enl-block-icon">
												<i class="fa enl-custom-icon <?php echo esc_attr( $icon ); ?>"></i>
											</div>
									<?php endif; ?>
									<div class="enl-block-inner">
									
										<div class="enl-block-header">
											<h3 class="enl-block-title">
												<?php the_title(); ?>
											</h3>
										</div>
										<div class="enl-block-desc">
											<?php
												if ( ! empty( $post->post_excerpt ) ) {
                                                    echo the_excerpt(); 
                                                } else {
                                                    echo '<p>' . enliven_excerpt(25) . '</p>';
                                                }
											?>
										</div>
									
									</div><!-- .enl-block-inner -->
								</div><!-- .enl-block -->
							</div><!-- .bootstrap-cols -->
							<?php if( $i == 3 ) { ?>
								</div><!-- .row -->
								<div class="row">
							<?php } 
							$i++;
							endwhile;
							wp_reset_postdata();
						endif;
					?>
						
					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- .enl-blocks-widget -->
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : ''; ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'enliven' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
		$widget_description = ! empty( $instance['widget_description'] ) ? $instance['widget_description'] : ''; ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'widget_description' ); ?>"><?php _e( 'Description', 'enliven' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'widget_description' ); ?>" name="<?php echo $this->get_field_name( 'widget_description' ); ?>" type="text" value="<?php echo esc_attr( $widget_description ); ?>">
		</p>
		<p>
			<?php _e( '<b>Note:</b><br />Give the name of the font awesome icon to the Font Awesome icon input field. You can find icon names from the readme.txt file <br /> eg: fa-paper-plane', 'enliven' ); ?>
		</p>
		
		<div class="enl-drcn">
			<?php for( $i = 1; $i < 7; $i++ ) { ?>
				<div class="enl-drcn-box">
					<div class="enl-drcn-head"><a href="#">Block <?php echo $i ?></a><span class="drcn-plus">+</span><span class="drcn-minus">-</span></div>
					
					<div class="enl-drcn-cont">
						<?php $font_icon = ! empty( $instance['font_icon'.$i] ) ? $instance['font_icon'.$i] : ''; ?>					
						<p>
							<label for="<?php echo $this->get_field_id( 'font_icon'.$i ); ?>"><?php _e( 'Font Icon', 'enliven' ); ?>:</label>
							<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'font_icon'.$i ); ?>" name="<?php echo $this->get_field_name( 'font_icon'.$i ); ?>" value="<?php echo esc_attr( $font_icon ); ?>" />
						</p>
						<?php $block_page = ! empty( $instance['page_id'.$i] ) ? $instance['page_id'.$i] : ''; ?>
						<p>
							<label for="<?php echo $this->get_field_id( 'page_id'.$i ); ?>"><?php _e( 'Select Page', 'enliven' ); ?>:</label>
							<?php wp_dropdown_pages( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'page_id'.$i ), 'selected' => $block_page, 'class' => 'widefat' ) ); ?>
						</p>
					</div><!-- .enl-drcn-cont -->
				</div><!-- .enl-drcn-box -->
			<?php } ?>
		</div><!-- .enl-drcn-all -->

	<?php	
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = array();

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['widget_description'] = ( ! empty( $new_instance['widget_description'] ) ) ? strip_tags( $new_instance['widget_description'] ) : '';

		for( $i=1; $i<7; $i++ ) {
			$instance[ 'font_icon'.$i ] = strip_tags( $new_instance[ 'font_icon'.$i ] ); 
			$instance[ 'page_id'.$i ] = absint( $new_instance[ 'page_id'.$i ] );
		}
		return $instance;

	}
}

// register Blocks_Widget widget
function register_enliven_blocks_widget() {
    register_widget( 'Enliven_Blocks_Widget' );
}
add_action( 'widgets_init', 'register_enliven_blocks_widget' );