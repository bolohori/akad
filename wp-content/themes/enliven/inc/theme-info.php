<?php

/**
 * Enliven info page
 *
 * @package Enliven
 */


add_action('admin_menu', 'enliven_theme_info');

function enliven_theme_info() {
	add_theme_page('Enliven WordPress Theme Information', 'Enliven Theme Info', 'edit_theme_options', 'enliven-info', 'enliven_info_display_content');
}


function enliven_info_display_content() { ?>
	
	<div class="enliven-theme-info">
		<?php 
			$enliven_details = wp_get_theme();
			$version = $enliven_details->get( 'Version' ); 
			$name = $enliven_details->get( 'Name' ); 
			$description = $enliven_details->get( 'Description' ); 
		?>
		<div class="enliven-info-header">
			<h1 class="enliven-info-title">
				<?php echo strtoupper( $name ) . ' ' . $version; ?>
			</h1>
		</div>
		<div class="enliven-info-body">
			<div class="enliven-theme-description">
				<p>
					<?php echo $description; ?>
				</p>
			</div>
			<div class="enliven-info-blocks">
				<div class="enliven-info-block aw-n-margin">
					<span class="dashicons dashicons-visibility"></span>
					<a href="<?php echo esc_url('http://themezhut.com/demo/enliven/'); ?>" target="_blank"><?php _e( 'View Demo', 'enliven' ); ?></a>
				</div>
				<div class="enliven-info-block">
					<span class="dashicons dashicons-book-alt"></span>
					<a href="<?php echo esc_url('http://themezhut.com/enliven-wordpress-theme-documentation/'); ?>" target="_blank"><?php _e( 'Theme Setup Guide', 'enliven' ); ?></a>
				</div>
				<div class="enliven-info-block">
					<span class="dashicons dashicons-admin-generic"></span>
					<a href="<?php echo admin_url('customize.php'); ?>"><?php _e( 'Customize Site', 'enliven' ); ?></a>
				</div>
			</div>
		</div>
	</div>

<?php }