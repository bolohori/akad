<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Square
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function square_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	$sq_post_type = array( 'post' ,'page' );

	if(is_singular($sq_post_type)){
		global $post;
		$sq_sidebar_layout = get_post_meta( $post->ID, 'sq_sidebar_layout', true );

		if(!$sq_sidebar_layout){
			$sq_sidebar_layout = 'right_sidebar';
		}

		$classes[] = 'sq_'.$sq_sidebar_layout;
	}

	return $classes;
}
add_filter( 'body_class', 'square_body_classes' );

if( !function_exists( 'square_excerpt' ) ){
	function square_excerpt( $content , $letter_count ){
		$content = strip_shortcodes( $content );
		$content = strip_tags( $content );
		$content = substr( $content, 0 , $letter_count );

		if( strlen( $content ) == $letter_count ){
			$content .= "...";
		}
		return $content;
	}
}

add_filter( 'wp_page_menu_args' , 'square_change_wp_page_menu_args');

if( !function_exists( 'square_change_wp_page_menu_args' ) ){
	function square_change_wp_page_menu_args( $args ){
		$args['menu_class'] = 'sq-menu sq-clearfix';	
		return $args;
	}
}

function square_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
	$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
	?>
	<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] )  ? 'parent' : '', $comment ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
					<?php echo sprintf( '<b class="fn">%s</b>', get_comment_author_link( $comment )  ); ?>
				</div><!-- .comment-author -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'square' ); ?></p>
				<?php endif; ?>
				<?php edit_comment_link( __( 'Edit', 'square' ), '<span class="edit-link">', '</span>' ); ?>
			</footer><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<div class="comment-metadata sq-clearfix">
				<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
					<time datetime="<?php comment_time( 'c' ); ?>">
						<?php
							/* translators: 1: comment date, 2: comment time */
							printf( __( '%1$s at %2$s', 'square' ), get_comment_date( '', $comment ), get_comment_time() );
						?>
					</time>
				</a>

				<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>'
				) ) );
				?>
			</div><!-- .comment-metadata -->
		</article><!-- .comment-body -->
<?php
}

if(!function_exists('kriesi_pagination')){
	function kriesi_pagination($pages = '', $range = 2){  
	     $showitems = ($range * 2)+1;  

	     global $paged;
	     if(empty($paged)) $paged = 1;

	     if($pages == '')
	     {
	         global $wp_query;
	         $pages = $wp_query->max_num_pages;
	         if(!$pages)
	         {
	             $pages = 1;
	         }
	     }   

	     if(1 != $pages)
	     {
	         echo "<div class='sq-pagination'>";
	         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
	         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

	         for ($i=1; $i <= $pages; $i++)
	         {
	             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
	             {
	                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
	             }
	         }

	         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
	         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
	         echo "</div>\n";
	     }
	}
}

function square_dynamic_style(){
	$square_page_header_bg = get_theme_mod( 'square_page_header_bg', get_template_directory_uri().'/images/bg.jpg');

	echo '<style>';
	echo '.sq-main-header{background-image: url('. $square_page_header_bg .')}';
	echo '</style>';
}

add_action( 'wp_head', 'square_dynamic_style' );