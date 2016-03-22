<?php

if( ! function_exists( 'enliven_slider') ) :

function enliven_slider() {

?>

    <div id="flexslider-container" class="flexslider-container">
        <div class="flexslider loading">
            <ul class="slides">
                <?php
                    $pages = array();
                    for ( $i = 1; $i <= 5; $i++ ) {
                        $mod = get_theme_mod( 'slider_page_' . $i );
                        if ( 'page-none-selected' != $mod ) {
                            $pages[] = $mod;
                        }
                    }
                    
                    $args = array(
                        'posts_per_page' => 5,
                        'post_type' => 'page',
                        'post__in' => $pages,
                        'orderby' => 'post__in'
                    );

                    $query = new WP_Query( $args );
                    if ( $query->have_posts() ) :
                        $i = 1;
                        while ( $query->have_posts() ) : $query->the_post(); 
                            
                            if ( has_post_thumbnail() ) : ?>

                                <li style="background-image: url(<?php the_post_thumbnail_url(); ?>); background-position: 50% 0px">
                                    <div class="overlay"></div>
                                    <div class="slide-outer">
                                        <div class="slide-mid">
                                            <div class="container">
                                                <div class="slide-inner">
                                                    <div class="en-slide-details">
                                                        
                                                        <?php 

                                                        if ( get_theme_mod( 'display_slider_title', 'true' ) ) { ?>
                                                            <h1 class="enliven-slider-title"><?php the_title(); ?></h1>
                                                        <?php } 

                                                        
                                                            $title_option = get_theme_mod( 'slider_content_switcher', 'display-excerpt' );

                                                            if ( $title_option == 'display-excerpt' ) { 

                                                                if ( ! empty( $post->post_excerpt ) ) {
                                                                    echo the_excerpt(); 
                                                                } else {
                                                                    echo '<p>' . enliven_excerpt(30) . '</p>';
                                                                }

                                                            } elseif ( $title_option == 'display-content' ) {
                                                                the_content();
                                                            }

                                                            $btn_text = 'slide_' . $i . '_btn_one_text';
                                                            $button_one_text = get_theme_mod($btn_text);
                                                            $btn_url = 'slide_' . $i . '_btn_one_url';
                                                            $button_one_url = get_theme_mod($btn_url);
                                                            if ( ! empty( $button_one_text ) ) {
                                                                echo '<a class="enl-slide-btn-1" href="' . ( ! empty( $button_one_url ) ? esc_url( $button_one_url ) : '#' ) . '" rel="bookmark">' . esc_html( $button_one_text ) . '</a>';
                                                            }

                                                            $btn_text = 'slide_' . $i . '_btn_two_text';
                                                            $button_two_text = get_theme_mod($btn_text);
                                                            $btn_url = 'slide_' . $i . '_btn_two_url';
                                                            $button_two_url = get_theme_mod($btn_url);
                                                            if ( ! empty( $button_two_text ) ) {
                                                                echo '<a class="enl-slide-btn-2" href="' . ( ! empty( $button_two_url ) ? esc_url( $button_two_url ) : '#' ) . '" rel="bookmark">' . esc_html( $button_two_text ) . '</a>';
                                                            }

                                                            edit_post_link( __( 'Edit slide', 'enliven' ), '<span class="edit-link">', '</span>' );

                                                        ?>
                                                        
                                                    </div><!-- .en-slide-details -->
                                                </div><!-- .slide-inner -->
                                            </div><!-- .container -->
                                        </div><!-- .slide-mid -->
                                    </div><!-- .slide-outer -->
                                </li>
                
                <?php 
                    endif;
                    $i++;
                endwhile;

            endif; 

            ?>
            </ul>
        </div><!-- .flexslider -->
    </div><!-- .flexslider-container -->

<?php
wp_reset_postdata();
}

endif;