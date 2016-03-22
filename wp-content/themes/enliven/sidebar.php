<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Enliven
 */

if ( ! is_active_sidebar( 'main-sidebar' ) ) {
	return;
}
?>

<div id="secondary" class="enl-main-sidebar widget-area" role="complementary">
	<?php dynamic_sidebar( 'main-sidebar' ); ?>
</div><!-- #secondary -->
