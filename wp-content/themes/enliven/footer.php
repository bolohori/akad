<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Enliven
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		
		<?php if ( is_active_sidebar('footer-left') || is_active_sidebar('footer-mid') || is_active_sidebar('footer-right') ) : ?>
			<div class="footer-widget-area">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-md-4 col-lg-4">
							<?php if ( ! dynamic_sidebar( 'footer-left' ) ) : ?>

							<?php endif; // end sidebar widget area ?>
						</div>	
						<div class="col-xs-12 col-md-4 col-lg-4">
							<?php if ( ! dynamic_sidebar( 'footer-mid' ) ) : ?>

							<?php endif; // end sidebar widget area ?>
						</div>	
						<div class="col-xs-12 col-md-4 col-lg-4">
							<?php if ( ! dynamic_sidebar( 'footer-right' ) ) : ?>

							<?php endif; // end sidebar widget area ?>
						</div>	
					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- .footer-widget-area -->
		<?php endif; ?>
		
		<div class="site-info">
			<div class="enl-social">
				<?php get_template_part( 'template-parts/menu', 'social' ); ?>
			</div>
			<div class="container">
				<?php 
					$footer_copyright_text = get_theme_mod( 'footer_copyright_text', '' );
					if( !empty( $footer_copyright_text ) ) {
						echo wp_kses_post( $footer_copyright_text ); 
					} else { ?>
						<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'enliven' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'enliven' ), 'WordPress' ); ?></a>
						<span class="sep"> | </span>
						<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'enliven' ), 'Enliven', '<a href="http://themezhut.com/themes/enliven/" rel="designer">ThemezHut</a>' ); ?>
					<?php } ?>
			</div>
		</div><!-- .site-info -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
