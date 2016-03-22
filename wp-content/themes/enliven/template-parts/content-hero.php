<?php 

    $image_id = get_post_thumbnail_id();
    $imagesize = "full";
    $image_url = wp_get_attachment_image_src($image_id, $imagesize);

?>

<?php if( $image_url ) { ?>
	<div class="hero-container img-banner" style="background-image: url(<?php echo esc_url( $image_url[0] ); ?>);">
	<div class="overlay"></div>
<?php } else { ?>
	<div class="hero-container nrml-banner">
<?php } ?>

		<div class="hero-wrapper">
			<h1 class="page-title-hero"><?php the_title() ?></h1>
		</div>

</div><!-- .hero-container -->